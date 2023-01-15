<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DropshipperController extends Controller
{
    public function getGoods() {
        $goodList = Good::all();
        $categoryList = Category::all();
        return view('dropshipper.dropshipperhome', compact('goodList', 'categoryList'));
    }

    public function showGoodCategory($id) {
        $goodList = Good::where('category_id', $id)->get();
        $goodCategory = Category::where('id', $id)->first();
        $categoryList = Category::all();
        return view('dropshipper.goodcategory', compact('goodList', 'categoryList', 'goodCategory'));
    }

    public function goodDetail($id) {
        $good = Good::find($id);
        $categoryList = Category::all();
        return view('dropshipper.gooddetail', compact('good', 'categoryList'));
    }


    public function showDropshiperProfile(Request $request) {
        $dropshipper = User::where('id', $request->user()->id)->first();
        $categoryList = Category::all();
        return view('dropshipper.dropshipperprofile', compact('dropshipper', 'categoryList'));
    }

    public function updateDropshipperProfile(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:25',
            'password' => 'required|min:5|max:50|confirmed',
            'address' => 'required|min:3|max:25',
            'phone' => 'required',
            'description' => 'required|min:3|max:25'
        ]);
        $request->password = Hash::make($validatedData['password']);
        $dropshipper = User::where('id', $request->user()->id)->first();
        if(!$request->hasFile('image')) {
            $dropshipper->update([
                'name' => $request->name,
                'password' => $request->password,
                'address' => $request->address,
                'phone' => $request->phone,
                'description' => $request->description
            ]);
        }
        else {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
            $dropshipper->update([
                'name' => $request->name,
                'password' => $request->password,
                'address' => $request->address,
                'phone' => $request->phone,
                'description' => $request->description,
                'picture' => $imageName
            ]);
        }
        return redirect()->back()->with('message', 'Success Update Profile');
    }

    public function getOwner(Request $request) {
        $ownerList = User::join('partners', 'partners.owner_id', '=', 'users.id')
            ->where('users.role', '1')
            ->where('partners.dropshipper_id', $request->user()->id)
            ->get('users.*');
        $categoryList = Category::all();
        return view('dropshipper.owner', compact('ownerList', 'categoryList'));
    }

    public function getOwnerDetail($id) {
        $goodList = Good::where('owner_id', $id)->get();
        $categoryList = Category::all();
        return view('dropshipper.ownerdetail', compact('goodList', 'categoryList'));
    }
}
