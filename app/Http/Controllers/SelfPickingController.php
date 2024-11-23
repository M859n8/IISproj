<?php

namespace App\Http\Controllers;

use App\Models\SelfPicking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SelfPickingController extends Controller
{
    public function create(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // Перевірка, чи вже є зв'язок з SelfPicking
        if ($product->selfPicking && $product->selfPicking->end_time < now()) {
            $product->selfPicking->delete();
        }

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

    public function subscribe($id)
    {
        // Отримуємо поточного користувача
        $user = Auth::user();

        // Перевіряємо, чи самозбір існує і ще не завершився
        $selfPicking = SelfPicking::where('id', $id)
            ->where('end_time', '>', now())
            ->first();

        if (!$selfPicking) {
            return redirect()->back()->with('error', 'This self-picking is not available.');
        }

        // Перевіряємо, чи користувач вже підписався
        $alreadySubscribed = DB::table('self_picking_user')
            ->where('self_picking_id', $id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadySubscribed) {
            return redirect()->back()->with('info', 'You are already subscribed to this self-picking.');
        }

        // Додаємо запис у таблицю
        DB::table('self_picking_user')->insert([
            'self_picking_id' => $id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully subscribed to this self-picking.');
    }
}
