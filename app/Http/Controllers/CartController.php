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
        $cart = $user->cart()->with('cartCakes.cake', 'cartCustomCakes.custom_cakes')->first();

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
                if ($quantity < 0) {
                    $cartCake->quantity += $quantity;
                    if ($cartCake->quantity <= 0) {
                        $cartCake->delete();
                        $message = "Cake removed from cart";
                    } else {
                        $cartCake->save();
                        $message = "Cake quantity decreased";
                    }
                } else {
                    $cartCake->quantity += $quantity;
                    $cartCake->save();
                    $message = "Cake quantity updated";
                }
            } else {
                if ($quantity > 0) {
                    $cart->cartCakes()->create([
                        'cake_id' => $cakeId,
                        'quantity' => $quantity,
                    ]);
                    $message = "Cake added to cart successfully";
                } else {
                    return apiErrors("Quantity must be greater than zero to add a new cake to the cart");
                }
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



    public function addCustomCakeToCart(Request $request): JsonResponse
    {
        $message = '';

        $validator = Validator::make($request->all(), [
            'custom_cake_id' => 'required|exists:custom_cakes,id',
            'quantity' => 'sometimes|integer'
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }

        try {
            $user = Auth::user();
            $cart = Cart::query()->where('user_id', $user->id)->first();
            $cartCustomCake = $cart->cartCustomCakes()->where('custom_cake_id', $request->custom_cake_id)->first();
            $customCakeId = $request->input('custom_cake_id');
            $quantity = $request->input('quantity', 1);

            if ($cartCustomCake) {
                if ($quantity < 0) {
                    $cartCustomCake->quantity += $quantity;
                    if ($cartCustomCake->quantity <= 0) {
                        $cartCustomCake->delete();
                        $message = "Custom Cake removed from cart";
                    } else {
                        $cartCustomCake->save();
                        $message = "Custom Cake quantity decreased";
                    }
                } else {
                    $cartCustomCake->quantity += $quantity;
                    $cartCustomCake->save();
                    $message = "Custom Cake quantity updated";
                }
            } else {
                if ($quantity > 0) {
                    $cart->cartCustomCakes()->create([
                        'custom_cake_id' => $customCakeId,
                        'quantity' => $quantity,
                    ]);
                    $message = "Custom Cake added to cart successfully";
                } else {
                    return apiErrors("Quantity must be greater than zero to add a new custom cake to the cart");
                }
            }

            return apiResponse($message);
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }


    public function removeCustomCakeFromCart($custom_cake_id)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {

            return apiErrors('Cart not found');
        }

        $cartCustomCake = $cart->cartCustomCakes()->where('custom_cake_id', $custom_cake_id)->first();

        if (!$cartCustomCake) {

            return apiErrors('Custom Cake not found in cart');
        }

        $cartCustomCake->delete();

        return apiResponse('Custom Cake removed from cart successfully');
    }
}
