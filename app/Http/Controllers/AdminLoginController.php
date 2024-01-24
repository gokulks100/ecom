<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{


    protected $redirectTo = '/admin/dashboard';
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function index()
    {

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'is_active'=>1], $request->get('remember'))) {
            // $request->session()->regenerate();
            return redirect()->intended('/admin/products');

        }

        return redirect()->back()->with('msg', 'Credentials do not match!');
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect()->intended('/admin/login');
    }


}
