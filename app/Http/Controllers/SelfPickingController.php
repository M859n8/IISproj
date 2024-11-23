<?php

namespace App\Http\Controllers;

use App\Models\SelfPicking;
use App\Models\Product;
use Illuminate\Http\Request;

class SelfPickingController extends Controller
{
    public function create(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Створення нової події SelfPicking
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
}
