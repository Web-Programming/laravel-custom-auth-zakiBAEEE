<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'requiredEmail',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role' => 'required'
        ]);

    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User Register Berhasil');
        } else {
            return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
        }
    }
}
