<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
