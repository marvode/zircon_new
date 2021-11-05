<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends ApiController
{
    public function index()
    {
        return response()->json(['data' => Category::all()]);
    }

    public function show(Category $category)
    {
        return response()->json(['data' => $category->load('fooditems')]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['data' => $category], 201);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category->update(['name' => $request->name]);

        return response()->json(['data' => $category], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['data' => $category]);
    }
}
