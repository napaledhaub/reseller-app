<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Good;
use App\Models\Cartgood;
use App\Models\Ordergood;

class GoodController extends Controller
{
    public function createGood() {
        $categoryList = Category::all();
        return view('owner.creategood', compact('categoryList'));
    }

    public function storeGood(Request $request) {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'price' => 'required|integer'
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('image'), $imageName);
        Good::create([
            'owner_id' => $request->user()->id,
            'category_id' => $request->category,
            'good_name' => $request->name,
            'good_description' => $request->description,
            'good_picture' => $imageName,
            'price' =>  $request->price
        ]);
        return redirect()->intended('good')->with('create', 'Success Store Good');
    }

    public function destroyGood($id) {
        $ordergood = Ordergood::where('good_id', $id);
        if ($ordergood->count() > 0) return redirect()->back()->with('delete', 'Delete Good Fail (order is in progress)');
        $cartgood = Cartgood::where('good_id', $id);
        if ($cartgood->count() > 0) $cartgood->delete();
        $good = Good::find($id);
        $good->delete();
        return redirect()->back()->with('delete', 'Success Delete Good');
    }

    public function editGood($id) {
        $good = Good::find($id);
        return view('owner.editgood', compact('good'));
    }

    public function updateGood(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer'
        ]);
        $input = $request->all();
        $good = Good::where('id', $input['id'])->first();
        if(!$request->hasFile('image')) {
            $good->update([
                'good_name' => $input['name'],
                'good_description' => $input['description'],
                'price' => $input['price']
            ]);
        }
        else {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
            $good->update([
                'good_name' => $input['name'],
                'good_description' => $input['description'],
                'price' => $input['price'],
                'good_picture' => $imageName
            ]);
        }
        return redirect()->intended('good')->with('create', 'Success Update Good');
    }
}
