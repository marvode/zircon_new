<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends ApiController
{
    public function index()
    {
        return $this->showAll(Category::get());
    }

    public function show(Category $category)
    {
        $category = $category->load('fooditems');
        return $this->showOne($category);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return $this->showOne($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category->update(['name' => $request->name]);

        return $this->showOne($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->showOne($category);
    }
}
