<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');
        $users = DB::table('users')->where('email', $request->input('email'))->first();

        if (!$users) {
            return response()->json(['msg' => 'Email Not found'], 404);
        }

        if(!Hash::check($request->input('password'), $users->password)) {
            return response()->json(['msg' => 'Wrong Password'], 403);
        }
        
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        $data = compact('token');
        return response()->json(compact('token'));
    }
}
