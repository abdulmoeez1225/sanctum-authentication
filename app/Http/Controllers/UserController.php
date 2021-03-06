<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return new UserResource($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {


        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);

        event(new Registered($user));


        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message' => 'User Registered',
                'data' => ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user->post);
    }

    public function show_many_record($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user->post);
    }

    public function many_to_many_roles($id){
        $user = User::find($id);
        return $user->user_roles;
    }

    public function many_to_many_users($id){
        $user = UserRole::find($id);
         return $user->users;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $update_user = User::findOrFail($id);
        $update_user->update($request->all());
        return new UserResource($update_user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::destroy($id);

        return "data has been deleted";
    }
}
