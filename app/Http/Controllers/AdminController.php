<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAttempt(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if($user->isAdmin()) {
            if(Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended('adminhome');
            }
            else return redirect()->back()->with('loginError', 'Wrong username or password');
        }
        else return redirect()->back()->with('loginError', 'Wrong username or password');
    }

    public function showHome() {
        $orderList = Order::where('status', 'Waiting Payment Approval')->get();
        $doneList = Order::where('status', 'Done')->get();
        return view('admin.adminhome', compact('orderList', 'doneList'));
    }

    public function showOrdersDone(){
        $doneOrderList = Order::where('status', 'Done')->get();
        $complainedOrderList = Order::where('status', 'Complained')->get();
        return view('admin.adminOrdersDone', compact('doneOrderList', 'complainedOrderList'));
    }

    public function rejectReceipt($id) {
        $order = Order::find($id);
        $order->update([
            'status' => 'Payment Rejected'
        ]);
        $orderList = Order::where('status', 'Waiting Payment Approval')->get();
        return redirect()->back()->with('cancel', 'Payment Rejected');
    }

    public function approveReceipt($id) {
        $order = Order::find($id);
        $order->update([
            'status' => 'Payment Approved'
        ]);
        $orderList = Order::where('status', 'Waiting Payment Approval')->get();
        return redirect()->back()->with('create', 'Payment Approved');
    }
}
