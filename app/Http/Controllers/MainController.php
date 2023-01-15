<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\DropshipperCategory;
use App\Models\Good;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class MainController extends Controller
{   
    //Register Controller---------------------------------------------------------------------------
    public function registerOwner() {
        return view('auth.registerowner');
    }

    public function registerDropshipper() {
        return view('auth.registerdropshipper');
    }

    public function registerOwnerAttempt(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:50|confirmed'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 1;
        User::create($validatedData);
        $user = User::where('email', $validatedData['email'])->first();

        Auth::login($user);
        return redirect()->intended('ownerhome')->with('create', 'Welcome New User');
    }

    public function registerDropshipperAttempt(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users',
            'address' => 'required|min:3|max:100',
            'phone' => 'required|integer',
            'ktp' => 'required|integer',
            'description' => 'required|min:3|max:100',
            'password' => 'required|min:5|max:50|confirmed',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 2;
        User::create($validatedData);
        $user = User::where('email', $validatedData['email'])->first();

        Auth::login($user);
        return redirect()->intended('dropshipperhome')->with('create', 'Welcome New User');
    }

    //Login Controller---------------------------------------------------------------------------
    public function login() {
        return view('auth.login');
    }

    public function loginAttempt(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($request->login_as == "1") {
            $user = User::where('role', '1')->where('email', $request->email)->first();
            $redirectTo = 'ownerhome';
        }
        if($request->login_as == "2") {
            $user = User::where('role', '2')->where('email', $request->email)->first();
            $redirectTo = 'dropshipperhome';
        }
        if($request->login_as == "3") {
            $user = User::where('role', '3')->where('email', $request->email)->first();
            $redirectTo = 'adminhome';
        }

        if($user != null) {
            if(Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($redirectTo);
            }
            else return redirect()->back()->with('loginError', 'Wrong Password');
        }
        else return redirect()->back()->with('loginError', 'User Not Found');
    }

    //Logout Controller---------------------------------------------------------------------------
    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
