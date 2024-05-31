<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string',
        ]);


        if ($validator->fails()) {
            return apiErrors($validator->errors(), 422);
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'image' => "profile.jpg",
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        Cart::create([
            'user_id' => $user->id,
        ]);

        return apiResponse("User registered successfully", new UserResource($user, $token), 201);
    }




    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if ($validator->fails()) {
            return apiErrors($validator->errors(), 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {

            return apiErrors('Invalid login credentials', 422);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->accessToken;

        return apiResponse("User logged in successfully", new UserResource($user, $token), 200);
    }

    public function updateUser(Request $request): JsonResponse
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone_number' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        if ($request->has('full_name')) {
            $user->full_name = $request->input('full_name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('phone_number')) {
            $user->phone_number = $request->input('phone_number');
        }

        $user->save();
        return apiResponse('User info updated successfully', $user);
    }


    public function getUserInfo(Request $request): JsonResponse
    {
        $user = Auth::user();
        return apiResponse('User information', $user);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return apiResponse('Logged out successfully');
    }
}
