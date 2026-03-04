<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Api\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use ApiResponse;

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30'],
        ]);

        if ($validator->fails()) {
            return $this->errorresponse($validator->errors(), 422);
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'role' => 'user'
        ]);

        $accessToken = $user->createToken('access-token', ['*'])->plainTextToken;

        $content = [
            'user' => $user,
            'accessToken' => $accessToken,
            // 'refreshToken' =>  $refreshToken
        ];

        // event(new Registered($user));

        return $this->successResponse('Register successful', new AuthResource($content), 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            // 'password' => 'required|min:6|regex:/[0-9]/|regex:/[a-zA-Z]/'
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorresponse($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->errorresponse("Your credentials have not served!", 404);
        }

        if (!Hash::check($validatedData['password'], $user->password)) {
            return $this->errorresponse('Your credentials is wrong!', 401);
        }

        if (!$user->is_active) {
            return $this->errorresponse('Your account is suspended by admin!', 401);
        }

        // try {
        //     $accessToken = $user->createToken('access-token', ['*'], now()->addHour())->plainTextToken;

        //     $refreshToken = Str::random(64);

        //     $user->update([
        //         'refresh_token' => hash('sha256', $refreshToken),
        //         'refresh_token_expires_at' => Carbon::now()->addDays(15),
        //     ]);

        //     $content = [
        //         'user' => $user,
        //         'accessToken' => $accessToken,
        //         // 'refreshToken' =>  $refreshToken
        //     ];

        //     return $this->successResponse('Login success', new AuthResource($content), 200)->withCookie(cookie(
        //         'refreshToken',                 // cookie name
        //         $refreshToken,                   // cookie value
        //         60 * 24 * 15,                    // minutes (15 days)
        //         '/',                             // path
        //         null,                            // domain
        //         app()->isLocal() ? false : true, // secure => local false
        //         true,                            // httpOnly
        //         false,                           // raw
        //         'Strict'                         // SameSite           // SameSite option (Strict / Lax / None)
        //     ));
        // } catch (\Exception $e) {
        // }
        $accessToken = $user->createToken('access-token', ['*'])->plainTextToken;

        $content = [
            'user' => $user,
            'accessToken' => $accessToken,
            // 'refreshToken' =>  $refreshToken
        ];

        return $this->successResponse('Login success', new AuthResource($content), 200);
    }


    public function logout(Request $request)
    {
        if (!auth('sanctum')->check()) {
            return $this->errorResponse('You have already loggouted', 200);
        } else {
            $request->user('sanctum')->tokens()->delete();
            return $this->successResponse('Loggout', null, 200);
        }
    }
}
