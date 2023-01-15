<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function getDropshipper(){
        $dropshipperList = User::where('role', 2)->get();
        return view('owner.ownerhome', compact('dropshipperList'));
    }

    public function showGood(Request $request) {
        $goodList = Good::where('owner_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
        return view('owner.good', compact('goodList'));
    }

    public function showProfile(Request $request) {
        $owner = User::where('id', $request->user()->id)->first();
        return view('owner.ownerprofile', compact('owner'));
    }

    public function updateOwnerProfile(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:25',
            'password' => 'required|min:5|max:50|confirmed'
        ]);
        $request->password = Hash::make($validatedData['password']);
        $owner = User::where('id', $request->user()->id)->first();
        if(!$request->hasFile('image')) {
            $owner->update([
                'name' => $request->name,
                'password' => $request->password
            ]);
        }
        else {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
            $owner->update([
                'name' => $request->name,
                'password' => $request->password,
                'picture' => $imageName
            ]);
        }
        return redirect()->back()->with('message', 'Success Update Profile');
    }
}
