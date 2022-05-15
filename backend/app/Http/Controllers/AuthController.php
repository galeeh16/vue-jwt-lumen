<?php 

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        try {
            if($request->username === 'galih' && $request->password === 'password') {
                $key = 'Tsd99nnmSgadgdhsagdsagdaghdksao7qwsdadsaCMdsadsa';
                $payload = [
                    'username' => $request->username,
                    'iat' => 1356999524,
                    'nbf' => 1357000000
                ];

                $jwt = JWT::encode($payload, $key, 'HS256');
                return response()->json(['token' => $jwt]);    
            } 

            return response()->json(['message' => 'Username or Password are invalid.'], 401);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function profile(Request $request)
    {
        return response()->json(['message' => 'Profile page']);
    }
}