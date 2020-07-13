<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private function signin(Request $request)
    {
        $user = Users::where('username', $request->input('username'))->first();
        if($user)
            {
                if (Hash::check($request->input('password'), $user->password)) {
                    $this->setSession($user);
                    return redirect('/home')->with('sukses', 'Berhasil Login');
                }else {
                    return redirect()->back()->with('error', 'Username / Password Salah');
                }
            }else {
                return redirect()->back()->with('error', 'Akun Tidak Ada');
            }
    }

    public function setSession($user)
    {
        Session::put('userId', $user->id);
        Session::put('username',$user->username);
        Session::put('status', TRUE);
    }

    public function viewSignIn()
    {
        return view('auth.singin');
    }

    public function validateSignIn(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        return $this->signin($request);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/auth/singin');
    }
}
