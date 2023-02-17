<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

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
}
