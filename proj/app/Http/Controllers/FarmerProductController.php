<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FarmerProductController extends Controller
{
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // // Перевірка, чи це продукт користувача
        // if ($product->user_id !== Auth::id()) {
        //     return redirect()->route('profile')->with('error', 'You are not authorized to edit this product.');
        // }

        return view('editproduct', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        // Перевірка, чи це продукт користувача
        // if ($product->user_id !== Auth::id()) {
        //     return redirect()->route('profile')->with('error', 'You are not authorized to update this product.');
        // }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('profile')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Перевірка, чи це продукт користувача
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('profile')->with('error', 'You are not authorized to delete this product.');
        }

        // Видалення зв'язків
        $product->categories()->detach();

        // Видалення продукту
        $product->delete();

        return redirect()->route('profile')->with('success', 'Product deleted successfully!');
    }


}
