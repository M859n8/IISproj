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

//     public function customerOrders()
//     {
//         // Отримати ідентифікатор автентифікованого користувача
//         $userId = auth()->id();
//
//         // Отримати всі замовлення цього користувача з пов'язаними продуктами
//         $orders = Order::with('product')
//             ->where('user_id', $userId)
//             ->orderBy('created_at', 'desc')
//             ->get();
//
//         // Повернути в'юху з передачею замовлень
//         return view('profile', ['orders' => $orders]);
//     }

    public function userOrders()
    {
        $user = auth()->user(); // Отримати поточного користувача

        if ($user->role === 'Farmer') {
            // Отримати замовлення для продуктів, створених фермером
            $orders = Order::with('product')  // Завантажує замовлення та відповідні продукти.
                ->whereHas('product', function ($query) use ($user) {  // Фільтрує замовлення за умовами, що продукт належить конкретному фермеру.
                    $query->where('user_id', $user->id);  // Перевіряє, що продукт належить фермеру з $user->id.
                })
                ->orderBy('created_at', 'desc')  // Сортує замовлення за датою створення в порядку спадання (найновіші перші).
                ->get();  // Отримує всі замовлення, які відповідають критеріям.

        } else if ($user->role === 'Customer') {
            // Отримати замовлення, зроблені користувачем
            $orders = Order::with('product')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('profile', ['orders' => $orders, 'userRole' => $user->role]);
    }


}

