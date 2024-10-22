<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function create(Request $request){
        
        $request -> validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email; 
        $user->password = Hash::make($request->password); 

        $user->save();

        return response($user, Response::HTTP_CREATED);

    }

    public function login(Request $request) {
        
        if(!Auth::attempt($request->only('email','password')))
        {
            return response()
                ->json(['message'=> 'Unuathorized'], 401);
    
        }
        $user = User::where('email',$request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response ()
            ->json([
                'message'=> 'Hi '.$user->name,
                'token'=> $token,
                'bearer_token'=> 'Bearer ',
                'user'=> $user,

            ]);

    }

}
