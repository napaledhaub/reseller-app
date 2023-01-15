<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartgood;
use App\Models\Category;
use App\Models\Good;
use App\Models\Order;
use App\Models\Ordergood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart() {
        $user = Auth::user();
        $carts = $user->carts;
        $categoryList = Category::all();
        return view('dropshipper.cart', compact('categoryList','carts'));
    }

    public function addToCart(Request $request, $id) {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $good = Good::find($id);
        $owner = $good->owner;

        $cart = $user->getCartWithOwner($owner->id);
        $validatedData = $request->validate([
            'quantity' => 'required|min:1',
        ]);
        $good = Good::where('id',$id)->first();

        //if no cart with owner: create new cart
        if($cart  == null) {
            $newCart = [
                'user_id' => $user->id,
                'owner_id' => $owner->id,
                'address' => NULL,
            ];
            $cart = Cart::create($newCart);
        }
        $cartgood = $cart->cartgoodWithGood($id);

        //Good already exist in cart?
        if($cartgood != null) {
            $cartgood->quantity += $request->quantity;
            $cartgood->save();
        }

        else {
            //create cartgood
            $newCartgood = [
                'cart_id' => $cart->id,
                'good_id' => $good->id,
                'quantity' => $request->quantity,
            ];
            Cartgood::create($newCartgood); 
        }
        return redirect()->intended('cart')->with('create','Good added to cart');
    }

    public function destroyCart($id) {
        $cartgood = Cartgood::find($id);
        $cartgood->delete();
        return redirect()->intended('cart')->with('delete','Success delete from cart');
    }

    public function checkout(Request $request, $id) {
        $user = Auth::user();
        $cart = Cart::find($id);
        $cartgoods = $cart->cartgoods;
        $validatedData = $request->validate([
            'address' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('image'), $imageName);
        $order = Order::create([
            'dropshipper_id' => $user->id,
            'owner_id' => $cart->owner_id,
            'total' => $cart->total(),
            'status' => 'Waiting Payment Approval',
            'address' => $request->address,
            'picture' => $imageName
        ]);

        foreach($cartgoods as $cartgood) {
            Ordergood::create([
                'order_id' => $order->id,
                'good_id' => $cartgood->good_id,
                'quantity' => $cartgood->quantity,
                'total' => $cartgood->total()
            ]);
            $cartgood->delete();
        }
        $cart->delete();
        return redirect()->intended('dropshipperOrder')->with('create', 'Succesful Checkout');
    }
}
