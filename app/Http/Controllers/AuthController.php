<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    // Handles user registration
    public function register(UserRegisterRequest $request){
        $validatedData = $request->validated();
        // Create a new user using validated data 
        $user = User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>bcrypt($validatedData['password']) // hash the password
        ]);

         // Generate JWT token for the newly created user
        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }

    // Handles user login
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        //Attempt the login with credentials
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    //Get the profile of current user
    public function profile()
    {
        return response()->json(auth('api')->user());
    }

    // Helper method to structure the token response
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    // Handles user logout
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


}