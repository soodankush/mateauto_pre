<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'required|email|unique:users|min:5',
            'password'  => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name']  = $user->name;

        $response = [
            'success' => true,
            'data'     => $success,
            'message'   => 'User registered successfully.'
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            $response = [
                'success' => false,
                'message' => 'Invalid credentials'
            ];
            return response()->json($response, 400);
        }

        if(!Hash::check($request->password, $user->password))
        {
            $response = [
                'success' => false,
                'message' => 'Invalid credentials'
            ];
            return response()->json($response, 400);   
        }

        return response()->json([
            'success' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("MyApp")->plainTextToken
        ], 200);
    }
}
