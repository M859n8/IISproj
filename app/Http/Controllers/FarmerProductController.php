<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

/*
* Controller for change and delete farmer`s product
*/
class FarmerProductController extends Controller
{
    // Get the product we will editing
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('editproduct', compact('product'));
    }

    // Update value of product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('profile')->with('success', 'Product updated successfully!');
    }

    // Delete product from DB
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete connections
        $product->categories()->detach();

        // Delete product
        $product->delete();

        return redirect()->route('profile')->with('success', 'Product deleted successfully!');
    }


}
