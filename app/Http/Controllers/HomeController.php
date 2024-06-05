<?php

namespace App\Http\Controllers;

use App\Http\Resources\CakeResource;
use App\Http\Resources\CategoryResource;
use App\Models\Cake;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function getCategories(Request $request): JsonResponse
    {
        try {

            $categories = Category::with('cakes')->get();
            return apiResponse('Categories retrieved successfully', CategoryResource::collection($categories));
        } catch (Exception $e) {
            return apiErrors($e->getMessage())->setStatusCode(500);
        }
    }


    public function getCakesByCategory($id): JsonResponse
    {
        try {
            $cakes = Cake::query()->where('category_id', '=', $id)->get();

            return apiResponse('Cakes retrieved successfully', CakeResource::collection($cakes));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }



    public function getCakeById($id): JsonResponse
    {
        try {
            $cake = Cake::query()->where('id', '=', $id)->first();


            if (!$cake) {
                return apiErrors('Invalid cake ID');
            }

            return apiResponse('Cake retrieved successfully', CakeResource::make($cake));
        } catch (Exception $e) {
            return apiErrors($e->getMessage());
        }
    }
}
