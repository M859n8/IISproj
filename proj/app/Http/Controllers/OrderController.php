<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Отримання ID користувача з cookies (якщо використовуєте сесію)
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->back()->with('error', 'User not logged in.');
        }

        // Створення замовлення
        $order = Order::create([
            'product_id' => $validated['product_id'],
            'user_id' => $userId,
            'quantity' => $validated['quantity'],
            'status' => 'processing', // Статус замовлення
        ]);

        return redirect()->back()->with('success', 'Product added to your order list!');
    }

}

