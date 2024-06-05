<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $category = new Category;
        $category->title = $request->title;
        $category->image = $imageName;
        $category->save();

        return apiResponse('Category added successfully', CategoryResource::make($category));
    }

    // Update the specified resource in storage.
    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return apiErrors($validator->errors());
        }

        $category = Category::query()->where('id', $id)->first();

        if (!$category) {
            return apiErrors('Invalid category ID');
        }

        if ($request->has('title')) {
            $category->title = $request->title;
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }


        $category->save();

        return apiResponse('Category updated successfully', CategoryResource::make($category));
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $cake = Category::query()->find($id);
        if (!$cake) {
            return apiErrors("Invalid category ID");
        }
        $cake->delete();
        return apiResponse("Category deleted successfully");
    }
}
