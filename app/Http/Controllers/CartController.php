<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartCake;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Exception;


class CartController extends Controller
{

    public function getUserCart()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('cartCakes.cake')->first();

        return apiResponse('User cart retrieved successfully', new CartResource($cart));
    }




    public function addToCart(Request $request): JsonResponse
    {
        $message = '';

        $validator = Validator::make($request->all(), [
            'cake_id' => 'required|exists:cakes,id',
            'quantity' => 'sometimes|integer'
        ]);



        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }


        try {
            $user = Auth::user();
            $cart = Cart::query()->where('user_id', $user->id)->first();
            $cartCake = $cart->cartCakes()->where('cake_id', $request->cake_id)->first();
            $cakeId = $request->input('cake_id');
            $quantity = $request->input('quantity', 1);
            if ($cartCake) {
                $cartCake->quantity += $quantity;
                $cartCake->save();
                $message = "Cake quantity updated";
            } else {

                $cart->cartCakes()->create([
                    'cake_id' => $cakeId,
                    'quantity' => $quantity,
                ]);
                $message = "Cake added to cart successfully";
            }


            return apiResponse($message);
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }

    public function removeCakeFromCart($cake_id)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {

            return apiErrors('Cart not found');
        }

        $cartCake = $cart->cartCakes()->where('cake_id', $cake_id)->first();

        if (!$cartCake) {

            return apiErrors('Cake not found in cart');
        }

        $cartCake->delete();

        return apiResponse('Cake removed from cart successfully');
    }
}
