<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::query()->where([['email', $request->email]])->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['The provided email is incorrect.'],
            ]);
        }

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password is incorrect.'],
            ]);
        }

        $role = Role::findById($user->id);

        return [
            'role' => $role,
            'token' => $user->createToken(time()),
            'user' => new UserResource($user),
        ];





    }

    public function register(StoreUserRequest $request)
    {


        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);

//        event(new Registered($user));


        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Registered',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );


    }

//    public function register(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => ['required', 'confirmed', Password::defaults()],
//        ]);

//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);





//
//
//    }


//    public function login(LoginRequest $request)
//    {
//
//
//
//        $token = $request->user()->createToken('authtoken');
//
//        return response()->json(
//            [
//                'message'=>'Logged in baby',
//                'data'=> [
//                    'user'=> $request->user(),
//                    'token'=> $token->plainTextToken
//                ]
//            ]
//        );
//    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );

    }



}
