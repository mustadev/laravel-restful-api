<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    // register user

    // public function register(Request $request){

    //     // validate password email name password_confirmation
    //     // $this->validate($request, [
    //     //     'name' => ['required'],
    //     //     'email' => ['required'],
    //     //     'password' => ['required'],
    //     //     'password_confirmation' => ['required'],
    //     // ]);
    //     $this->valida
    //     // triger any relevent observers
    //     event(new Registered($user = $this->create($request));

    //     // login user
    //     $this->guard()->login($user);

    //     return $this->registered($request, $user)
    //         ?: redirect($this->redirectPath());
    // }

    protected function registered(Request $request, $user){
        $user->generateToken();

        return response()->json([ 'date' => $user->toArray()], 201);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create($request){
        return User::create($request);
    }
}
