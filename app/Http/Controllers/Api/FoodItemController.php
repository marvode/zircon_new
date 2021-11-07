<?php

namespace App\Http\Controllers\Api;

use App\Models\Fooditem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Api\ApiController;

class FoodItemController extends ApiController
{
    public function index()
    {
        $foodItems = Fooditem::get();

        return $this->showAll($foodItems);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required'
        ]);

        $image = '';

        $foodItem = Fooditem::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
        ]);

        return $this->showOne($foodItem, 201);
    }

    public function show(Fooditem $fooditem)
    {
        return $this->showOne($fooditem);
    }

    public function update(Request $request, Fooditem $foodItem)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            // 'image' => 'required|image',
            'category_id' => 'required'
        ]);

        $foodItem->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return $this->showOne($foodItem);
    }

    public function destroy($id)
    {
        $foodItem = Fooditem::find($id);

        $foodItem->delete();

        return $this->showOne($foodItem);
    }
}
