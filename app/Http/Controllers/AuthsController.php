<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthsController extends Controller
{
    /**
     * Register a new user
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $fields['password'] = bcrypt($fields['password']);

       $user = User::create($fields);

       $token = $user->createToken('myAppToken')->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];

       return response($response, 201);
    }

    /**
     * Login a user 
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user=$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
       if(auth()->attempt($user)){
           session()->regenerate();
           return 'success';
       }; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
