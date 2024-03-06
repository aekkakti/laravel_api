<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'products' => 'required',
            'address' => 'required',
            'order_cost' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }

        $order = Order::create([
            'products' => $request->products,
            'address' => $request->address,
            'order_cost' => $request->order_cost,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Заказ успешно создан', 'product' => $order], 201);
    }

    public static function deleteOrder(Order $order) {
        $order->delete();
        return response()->json(['message' => 'Заказ успешно удалён'], 201);
    }

    public function showOrders(){
        return Order::all();
    }

    public function updateOrder(Request $request, Order $order) {
        $order->update([
            'products' => $request->products,
            'address' => $request->address,
            'order_cost' => $request->order_cost,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Заказ успешно изменён', 'product' => $order], 201);
    }
}
