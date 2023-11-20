<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                "name" => 'required|string|max:255',
                "email" => 'required|email|max:255|unique:users',
                "password" => 'required|min:6',
                "confirm_password" => "required|same:password"
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors());
        }
        $password = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            "password" => $password,

        ]);
        $success['token'] = $user->createToken('RestApi')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, "user register success");
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "email" => 'required|email|max:255',
                "password" => 'required|min:6',
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('RestApi')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'user login in success');
        }
        else{
            return $this->sendError('Unauthorizes', ['error' => 'Unauthorized' ]);
        }
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return $this->sendResponse([], "user logout");

    }
}
