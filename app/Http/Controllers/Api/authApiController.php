<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class authApiController extends Controller
{
    //
    public function login(Request $request)
    {
        $data =     $request->validate([
            // 'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        // dd(Hash::check($request->password, $user->password));

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('token')->plainTextToken;
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['success' => 'anda berhasil logout']);
    }
}
