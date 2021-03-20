<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_number = $request->mobile_number;
            $user->password = $request->password;
            if($user->save()){
                Auth::login($user);
                return redirect(RouteServiceProvider::HOME);
            }else{
                throw new \Exception("Sorry! something goes wrong. try again!");
            }
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        try {
            if(Auth::attempt($credentials)){
                return redirect(RouteServiceProvider::HOME);
            }else{
                return back()->with('message','Invalid credentials');
            }
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}
