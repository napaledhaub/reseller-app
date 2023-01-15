<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function showOrder(Request $request) {
        $orderList = Order::where('owner_id', $request->user()->id)
            ->whereIn('status', ['Payment Approved', 'Goods Sent', 'Canceled by Owner', 'Canceled by Dropshipper', 'Done'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('owner.ownerorder', compact('orderList'));
    }

    public function showDropshipperOrder(Request $request) {
        $orderList = Order::where('dropshipper_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
        $categoryList = Category::all();
        return view('dropshipper.dropshipperorder', compact('orderList', 'categoryList'));
    }

    public function storeOrder(Request $request, $id) {
        $validatedData = $request->validate([
            'quantity' => 'required|min:1',
            'address' => 'required',
        ]);
        Order::create([
            'dropshipper_id' => $request->user()->id,
            'good_id' => $id,
            'address' => $request->address,
            'status' => 'Pending',
            'quantity' => $request->quantity
        ]);
        return redirect()->back()->with('create', 'Success Create Order');
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
        $order->status = "Canceled by Owner";
        $order->save();
        return redirect()->back()->with('cancel', 'Success Cancel Order');
    }

    public function sentOrder($id) {
        $order = Order::find($id);
        $order->status = "Goods Sent";
        $order->save();
        return redirect()->back()->with('success', 'Success Update Order Status');
    }

    public function rejectOrder($id) {
        $order = Order::find($id);
        $order->status = "Rejected";
        $order->save();
        return redirect()->back()->with('cancel', 'Success Reject Order');
    }

    public function endOrder($id){
        $order = Order::find($id);
        $order->status = "Done";
        $order->save();
        return redirect()->back()->with('create', 'Order Ended');
    }

    public function cancelOrderByDropshipper($id) {
        $order = Order::find($id);
        $order->status = "Canceled by Dropshipper";
        $order->save();
        return redirect()->back()->with('cancel', 'Success Cancel Order');
    }
    
    public function updatePayment(Request $request, $id) {
        if(!$request->hasFile('image')) {
            return redirect()->back()->with('cancel', 'No File Uploaded');
        }
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('image'), $imageName);
        $order = Order::find($id);
        $order->status = "Waiting Payment Approval";
        $order->picture = $imageName;
        $order->save();
        return redirect()->back()->with('create', 'Success Upload Receipt');
    }

    public function complaint(Request $request, $id) {
        if(!$request->hasFile('image')) {
            return redirect()->back()->with('cancel', 'No File Uploaded');
        }
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('image'), $imageName);
        $order = Order::find($id);
        $order->status = "Complained";
        $order->complain_picture = $imageName;
        $order->complain_desc = $request->desc;
        $order->save();
        return redirect()->back()->with('cancel', 'Success Send Report');
    }
}
