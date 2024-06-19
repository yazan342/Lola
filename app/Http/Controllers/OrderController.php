<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderCake;
use App\Models\OrderCustomCake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || (!$cart->cartCakes->count() && !$cart->cartCustomCakes->count())) {
            return apiErrors('Cart is empty');
        }

        // Calculate total price
        $totalPrice = 0;

        foreach ($cart->cartCakes as $cartCake) {
            $totalPrice += $cartCake->quantity * $cartCake->cake->price;
        }

        foreach ($cart->cartCustomCakes as $cartCustomCake) {
            $totalPrice += $cartCustomCake->quantity * $cartCustomCake->custom_cakes->price;
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        // Create order cakes
        foreach ($cart->cartCakes as $cartCake) {
            OrderCake::create([
                'order_id' => $order->id,
                'cake_id' => $cartCake->cake_id,
                'quantity' => $cartCake->quantity,
                'price' => $cartCake->cake->price,
            ]);
        }

        // Create order custom cakes
        foreach ($cart->cartCustomCakes as $cartCustomCake) {
            OrderCustomCake::create([
                'order_id' => $order->id,
                'custom_cake_id' => $cartCustomCake->custom_cake_id,
                'quantity' => $cartCustomCake->quantity,
                'price' => $cartCustomCake->custom_cakes->price,
            ]);
        }

        // Clear the cart
        $cart->cartCakes()->delete();
        $cart->cartCustomCakes()->delete();

        return apiResponse('Order created successfully', $order);
    }

    public function orderHistory(Request $request)
    {
        $user = Auth::user();
        $orders = $user->orders()
            ->with(['orderCakes.cake', 'orderCustomCakes.customCake'])
            ->get();
        return OrderResource::collection($orders);
    }
}
