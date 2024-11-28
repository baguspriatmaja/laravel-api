<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
    return response()->json([
        "data" => [
            "errors" => $validator->invalid()
            ]
        ], 422);
    }

    $user = User::where('name', $request->name)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'name' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken("tokenName")->plainTextToken;

    return response()->json([
        "data" => [
            "token" => $token
        ]
    ]);
    
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "data" => [
                    "errors" => $validator->invalid()
                ]
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken("tokenName")->plainTextToken;

        return response()->json([
            "data" => [
                "user" => $user,
                "token" => $token
            ]
        ]);
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        // Menghapus semua token pengguna yang sedang login
        $request->user()->tokens()->delete();

        return response()->json([
            "message" => "Logged out successfully"
        ]);
    }
}
