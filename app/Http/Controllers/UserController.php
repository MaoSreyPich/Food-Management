<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }
    public function add(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'email'=>'required',
            'password'=>'required|min:6'
        ]);
        $data['password']=Hash::make($request->password);
        $insert=User::create($data);
        if($insert){
            return redirect('/');
        }else{
            return redirect('/register');
        }
    }
    public function checkLogin(Request $request){
        $email=$request->email;
        $password=$request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            if(Auth::user()->role==0){
                return redirect('/user');
            }else{
                return redirect('/admin');
             }
            }else{
                return redirect('/');
            }
    }
    public function admin(){
        if(Auth::user()->role==1){
        return view('admin.admin');
    }else{
        return redirect('/user');
    }
  }
}
