<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $field = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => ''
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field['password']),
        ]);

        $token = $user->CreateToken('tokensepaturezalu')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        
        return response($response, 201);
    }

    public function login(Request $request){
         $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
         ]);

        
        $user = User::where('email', $fields['email'])->first();        

        $token = $user->CreateToken('tokensepaturezalu')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        
        return response($response, 201);
    }

    public function logout(Request $request){
        $request ->user()->currentAccessToken()->delete();

        return [
            'message' => 'logged out'
        ];
    }

    public function alluser()
    {
        $user = User::all();
        if($user) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' =>404,
                'message' => 'Belum terdapat user'
            ], 404);
        }
    }

    public function showuser ($id){
        $user = User::find($id);
        if($user) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' =>404,
                'message' => 'id atas ' . $id .'tidak ditemukan'
            ], 404);
        }
    }
}
