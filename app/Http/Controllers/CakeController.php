<?php

namespace App\Http\Controllers;

use App\Http\Resources\CakeResource;
use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CakeController extends Controller
{
    public function createCake(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'flavor' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'number_of_people' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $cake = new Cake;
        $cake->name = $request->name;
        $cake->flavor = $request->flavor;
        $cake->number_of_people = $request->number_of_people;
        $cake->price = $request->price;
        $cake->category_id = $request->category_id;
        $cake->image = $imageName;
        $cake->save();

        return apiResponse('Cake added successfully', CakeResource::make($cake));
    }

    // Update the specified resource in storage.
    public function updateCake(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'flavor' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'number_of_people' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }

        $cake = Cake::query()->where('id', $id)->first();

        if (!$cake) {
            return apiErrors('Invalid cake ID');
        }

        if ($request->has('name')) {
            $cake->name = $request->name;
        }


        if ($request->has('flavor')) {
            $cake->flavor = $request->flavor;
        }

        if ($request->has('number_of_people')) {
            $cake->number_of_people = $request->number_of_people;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $cake->image = $imageName;
        }

        if ($request->has('price')) {
            $cake->price = $request->price;
        }


        if ($request->has('category_id')) {
            $cake->category_id = $request->category_id;
        }

        $cake->save();

        return apiResponse('Cake updated successfully', CakeResource::make($cake));
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $cake = Cake::query()->find($id);
        if (!$cake) {
            return apiErrors("Invalid cake ID");
        }
        $cake->delete();
        return apiResponse("Cake deleted successfully");
    }
}
