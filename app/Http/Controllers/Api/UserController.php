<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user('sanctum');

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'role' => 'user'
        ]);

        // event(new Registered($user));
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function update(Request $request)
    {
        $user = $request->user('sanctum');

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:50'],
            'profile_img' => ['nullable', 'image']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ]);
        }

        $user->name = $request->name;

        if ($request->hasFile('profile_img')) {
            $newImage = $request->file('profile_img');
            $newHash = md5_file($newImage->getRealPath());

            $currentHash = null;
            if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
                $currentHash = md5(Storage::disk('public')->get($user->profile_img));
            }

            if ($newHash !== $currentHash) {
                if ($user->profile_img) {
                    Storage::disk('public')->delete($user->profile_img);
                }

                $path = $newImage->store('images/profiles', 'public');
                $user->profile_img = $path;
            }
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User profile updated successfully',
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user('sanctum');

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:6', 'max:30'],
            'newPassword' => ['required', 'min:6', 'max:30'],
            'confirmPassword' => ['required', 'min:6', 'max:30']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        };

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid credentials.'
            ]);
        }

        if ($request->newPassword !== $request->confirmPassword) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Password confirmation does not match.'
            ], 422);
        }

        if ($request->password === $request->newPassword) {
            return response()->json([
                'status' => 'fail',
                'message' => 'New password must be different from the current password.'
            ], 400);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully.'
        ], 200);
    }

    public function forgotPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password reset link sent to your email.'
            ]);
        }

        return response()->json([
            'status' => 'fail',
            'message' => 'Unable to send reset link.'
        ], 500);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password has been reset successfully.'
            ]);
        }

        return response()->json([
            'status' => 'fail',
            'message' => 'Invalid token or email.'
        ], 422);
    }

    public function login()
    {
        $validator = validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', request('email'))->first();

        if (!$user->is_active) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Your account has been suspended.'
            ]);
        }

        if (!$user->role !== 'user') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Forbidden: You are not allowed to access this route.'
            ], 403);
        }

        if (!$user || !Hash::check(request('password'), $user->password)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ],);
    }


    public function logout(Request $request)
    {
        $request->user('sanctum')->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ]);
    }
}
