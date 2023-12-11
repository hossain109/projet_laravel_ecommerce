<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\RedisHandler;

class AuthController extends Controller
{
    public function loginAdmin(){
        
        if(!empty(Auth::check()) && Auth::user()->id_admin == 1){
            return redirect('admin/dashboard');
        }
        // User::create([
        //     'name'=>'admin',
        //     'email'=>'admin@gmail.com',
        //     'password'=>Hash::make(1234),
        //     'id_admin'=>0
        // ]);

        //dd(Hash::make(1234));
        return view('admin.auth.login');
    }

    public function authLoginAdmin(LoginRequest $request){

         $request->validated();

        $remember = !empty($request->remember)?true:false;

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'id_admin'=>1,'status'=>1],$remember)){
            redirect('admin/dashboard');
        }

        // if(Auth::attempt($credential))
        // {
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.dashboard');
        // }

        return redirect()->back()->with('error',"Please insert correct user and password");
 
    }

    public function logoutAdmin(){
        Auth::logout();
        return redirect('admin');
    }
}
