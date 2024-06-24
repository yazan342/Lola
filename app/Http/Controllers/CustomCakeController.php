<?php

namespace App\Http\Controllers;

use App\Http\Resources\ColorResource;
use App\Http\Resources\CustomCakeResource;
use App\Http\Resources\FlavorResource;
use App\Http\Resources\ShapeResource;
use App\Http\Resources\ToppingResource;
use App\Models\Color;
use App\Models\CustomCake;
use App\Models\Flavor;
use App\Models\Shape;
use App\Models\Topping;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomCakeController extends Controller
{
    public function getColors()
    {
        try {
            $colors = Color::all();
            return apiResponse('Colors retrieved successfully', ColorResource::collection($colors));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }


    public function getFlavors()
    {
        try {
            $flavors = Flavor::all();
            return apiResponse('Flavors retrieved successfully', FlavorResource::collection($flavors));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }


    public function getShapes()
    {
        try {
            $shapes = Shape::all();
            return apiResponse('Shapes retrieved successfully', ShapeResource::collection($shapes));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }


    public function getToppings()
    {
        try {
            $toppings = Topping::all();
            return apiResponse('Toppings retrieved successfully', ToppingResource::collection($toppings));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }


    public function createCustomCake(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'flavor_id' => 'required|exists:flavors,id',
            'color_id' => 'required|exists:colors,id',
            'topping_id' => 'required|exists:toppings,id',
            'shape_id' => 'required|exists:shapes,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'text' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }




        $custom_cake = new CustomCake();
        $custom_cake->flavor_id = $request->flavor_id;
        $custom_cake->color_id = $request->color_id;
        $custom_cake->shape_id = $request->shape_id;
        $custom_cake->topping_id = $request->topping_id;


        $colorPrice = Color::query()->where('id', $request->color_id)->first();
        $flavorPrice = Flavor::query()->where('id', $request->flavor_id)->first();
        $shapePrice = Shape::query()->where('id', $request->shape_id)->first();
        $toppingPrice = Topping::query()->where('id', $request->topping_id)->first();
        $totalPrice = $colorPrice->price + $flavorPrice->price + $shapePrice->price + $toppingPrice->price;
        $custom_cake->price = strval($totalPrice);
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $custom_cake->image = $imageName;
        }
        if ($request->has('text')) {
            $custom_cake->text = $request->text;
        }
        $custom_cake->save();

        return apiResponse('Custom Cake added successfully', CustomCakeResource::make($custom_cake));
    }
}
