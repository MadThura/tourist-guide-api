<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponse;

    public function me(Request $request)
    {
        $user = $request->user('sanctum');

        return $this->successResponse('Profile reterived successfully', new UserResource($user));
    }

    public function update(Request $request)
    {
        $user = $request->user('sanctum');

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:50'],
            'profile_img' => ['nullable', 'image']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
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

        return $this->successResponse('User profile updated successful.', $user);
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
            return $this->errorResponse($validator->errors(), 422);
        };

        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Invalid credentials!', 422);
        }

        if ($request->newPassword !== $request->confirmPassword) {
            return $this->errorResponse('Password confirmation does not match.', 422);
        }

        if ($request->password === $request->newPassword) {
            return $this->errorResponse('New password must be different from the current password.', 400);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return $this->successResponse("Password changed successful.");
    }
}
