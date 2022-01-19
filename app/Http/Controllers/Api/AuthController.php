<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthUserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        $access_token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'data' => [
                'access_token' => $access_token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have been logged out'
        ]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'old_password' => 'required'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The provided credentials are incorrect'],
            ]);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => 'Password changed successfully'
        ]);
    }

    public function user()
    {
        return new AuthUserResource(Auth::user());
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|confirmed',
            'email' => 'required|email|unique:users',
            'device_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'user')->first()->id
        ]);

        $access_token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'data' => [
                'access_token' => $access_token
            ]
        ]);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'phone_no' => 'required|string',
        ]);

        Auth::user()->update([
            'phone_no' => $request->phone_no,
        ]);

        return response()->json([
            'success' => 'Profile updated successfully'
        ]);
    }
}
