<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function showProduct($id){
           // Знайти продукт за його ID
           $product = Product::find($id);

           // Якщо продукт не знайдений, показати сторінку з повідомленням
           if (!$product) {
               return response()->view('product.notfound', ['id' => $id], 404);
           }

           // Показати сторінку продукту з переданими даними
           return response()->view('product', ['product' => $product]);
    }
}
