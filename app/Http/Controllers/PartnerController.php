<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Owner;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function getOwnerPartners(){
        $id = Auth::user()->id;
        $owner = User::find($id);
        $partnerships = $owner->getOwnerPartner();
        $categoryList = Category::all();
        return view('owner.mypartners', compact("partnerships","categoryList"));
    }

    public function destroyPartner($dropshipperId){
        $ownerId = Auth::user()->id;
        $partnership = Partner::where([
            ['owner_id','=',$ownerId],
            ['dropshipper_id','=',$dropshipperId]
        ]);

        $partnership->delete();
        return redirect()->back()->with('delete', 'Partner Removed');
    }

    public function addPartner($dropshipperId){
        $ownerId = Auth::user()->id;
        Partner::create([
            'owner_id' => $ownerId,
            'dropshipper_id' => $dropshipperId,
        ]);
        return redirect()->back()->with('create', 'Success Add Partner');
    }
}
