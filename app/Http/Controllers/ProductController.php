<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    //shows information about product, buttons for creating an order/selfPicking
    public function showProduct($id)
    {
        $product = Product::with(['category', 'selfPicking'])->find($id);

        if (!$product) {
            return response()->view('product.notfound', ['id' => $id], 404);
        }

        $selfPicking = $product->selfPicking()
            ->where('end_time', '>',  Carbon::now()->setTimezone('Europe/Prague'))
            ->first();

        return response()->view('product', [
            'product' => $product,
            'categories' => $product->category,
            'selfPicking' => $selfPicking, 
        ]);
    }


     //farmer creates product
    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1255',
            'category_id' => 'nullable|exists:categories,id', 
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',

        ]);

        $user = auth()->user();

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'] ?? null;
        $product->user_id = $user->id;
        $product->quantity = $validated['quantity'];
        $product->unit = $validated['unit'];

        $product->created_at = now();
        $product->updated_at = now();
        $product->save();
        //assign all parent categories of the selected category
        if (!empty($validated['category_id'])) {
            $category = Category::find($validated['category_id']);

            $allCategories = $this->getParentCategories($category);

            $product->category()->sync($allCategories);
        }

        //redirect to the new product page
        return redirect()->route('productPage', ['id' => $product->id])
            ->with('success', 'Product created successfully!');

    }

    //function that gets all parent categories
    private function getParentCategories(Category $category)
    {
        $categories = [];
        while ($category) {
            $categories[] = $category->id;
            $category = $category->parent; 
        }
        return $categories;
    }

    //function that shows form for creating product
    public function showCreateForm()
    {
        $categories = Category::where('status', 'Approved')->get();
        return view('addproduct', compact('categories'));
    }


}
