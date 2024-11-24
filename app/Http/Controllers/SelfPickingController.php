<?php

namespace App\Http\Controllers;

use App\Models\SelfPicking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SelfPickingController extends Controller
{
    //farmer starts self picking
    public function create(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|integer|min:10000|max:99999',
            'end_time' => 'required|date',
        ]);
        $user = auth()->user();

        SelfPicking::create([
            'end_time' => $request->end_time,
            'address' => $request->address,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Self-picking event created.');
    }

    //user can subscribe on self picking
    public function subscribe($id)
    {
        $user = Auth::user();

        $selfPicking = SelfPicking::where('id', $id)
            ->where('end_time', '>', now())
            ->first();
        //check end time
        if (!$selfPicking) {
            return redirect()->back()->with('error', 'This self-picking is not available.');
        }

        //check if user is already subscribed
        $alreadySubscribed = DB::table('self_picking_user')
            ->where('self_picking_id', $id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadySubscribed) {
            return redirect()->back()->with('info', 'You are already subscribed to this self-picking.');
        }

        //add to db
        DB::table('self_picking_user')->insert([
            'self_picking_id' => $id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully subscribed to this self-picking.');
    }
}
