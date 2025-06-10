<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $dbuserLogin=DB::table('users')->where('email', $request->email)->first();

        if ($dbuserLogin && Hash::check($request->password, $dbuserLogin->password) &&$dbuserLogin->ROLE==1){
            $user=User::find($dbuserLogin->id);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/home');
        }

        return back()->withErrors([
            'email'=>'Tài khoản không hợp lệ hoặc không có quyền truy cập.'
        ])->withInput();
    }
}