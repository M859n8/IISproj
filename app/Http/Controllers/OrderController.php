<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //user(customer) orders product
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();

        if (!$userId) {
            return redirect()->back()->with('error', 'User not logged in.');
        }

        $order = Order::create([
            'product_id' => $validated['product_id'],
            'user_id' => $userId,
            'quantity' => $validated['quantity'],
            'status' => 'processing', 
        ]);

        return redirect()->back()->with('success', 'Product added to your order list!');
    }

    //show orders/selfPickings in user profile
    public function showOrdersSelfPickings()
    {
        $user = auth()->user(); 

        if ($user->role === 'Farmer') {
            
            $products = $user->products; 
            foreach ($products as $product) {
                if ($product->selfPicking) {
                    // check time
                    if ($product->selfPicking->end_time < Carbon::now()->setTimezone('Europe/Prague')) {
                        $product->selfPicking->delete(); 
                    }
                }
            }
            $orders = Order::with('product')  
                ->whereHas('product', function ($query) use ($user) {  
                    $query->where('user_id', $user->id);  //check if current user (farmer) created this product
                })
                ->orderBy('created_at', 'desc')  //sort by date of creation
                ->get(); 
            //fasrmer does not have planned self picking section in profile: 'selfPickings' => null
            return view('profile', ['orders' => $orders, 'userRole' => $user->role, 'products' => $products, 'selfPickings' => null]);



        } else if ($user->role === 'Customer') {
            //get orders for this customer
            $orders = Order::with('product')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            //get planned selfpickings for this customer
            $selfPickings = $user->events()
                ->where('end_time', '>',  Carbon::now()->setTimezone('Europe/Prague'))
                ->with('product')
                ->get();

            return view('profile', ['orders' => $orders, 'userRole' => $user->role, 'selfPickings' => $selfPickings]);

        }else if ($user->role === 'Admin') {
            //admin does not have orders or selfpicking section in profile
            return view('profile', ['orders' => null, 'userRole' => $user->role, 'selfPickings' => null]);
        }

    }

    //farmer changes status of the order
    public function statusPrepeared($id)
    {
        $order = Order::findOrFail($id);

        $product = Product::findOrFail($order->product_id);
        //update product quantity after prepearing order 
        $product->quantity -= $order->quantity;
        $product->save();

        $order->update(['status' => 'prepared']);

        return redirect()->back()->with('success', 'Order marked as ready.');
    }

    //user changes status of the order
    public function rate(Request $request, $id)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $order = Order::findOrFail($id);
        //update status, validate product and delete order 
        $order->update(['status' => 'completed']);
        $product = $order->product;

        $product->rating_sum += $validated['rating'];
        $product->rating_count += 1;

        $product->save();
        $order->delete();

        return redirect()->back()->with('success', 'Rating was successful!');
    }



}

