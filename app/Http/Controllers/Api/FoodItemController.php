<?php

namespace App\Http\Controllers\Api;

use App\Models\Fooditem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FoodItemController extends Controller
{
    public function index()
    {
        $foodItems = Fooditem::all();

        return response()->json([
            'data' => $foodItems
        ]);
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

        return response()->json([
            'data' => $foodItem
        ], 201);
    }

    public function show(Fooditem $foodItem)
    {
        return response()->json([
            'data' => $foodItem
        ]);
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
            'description' => $request->description,,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'data' => $foodItem
        ], 200);
    }

    public function destroy($id)
    {
        $foodItem = Fooditem::find($id);

        $foodItem->delete();

        return response()->json([
            'data' => $foodItem
        ], Response::HTTP_NO_CONTENT);
    }
}
