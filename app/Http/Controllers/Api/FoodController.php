<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $food = Food::all();
            return [
                "status" => 200,
                "message" => "Success",
                "data" => $food
            ];
        } catch(\Exception $e){
            return [
                "status" => 400,
                "message" => "Bad Request",
                "error" => $e
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "name" => "required|string",
                "description" => "required|string",
                "type" => "required|string",
                "price" => "required|integer",
            ]);
    
            $food = Food::create([
                "name" => $request->name,
                "description" => $request->description,
                "type" => $request->type,
                "price" => $request->price,
            ]);

            return [
                "status" => 200,
                "message" => "Success",
                "data" => $food
            ];
        } catch(\Exception $e){
            return [
                "status" => 400,
                "message" => "Bad Request",
                "error" => $e
            ];
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $food = Food::find($id);
             return [
                "status" => 200,
                "message" => "Success",
                "data" => $food
            ];
        }catch(\Exception $e){
             return [
                "status" => 400,
                "message" => "Bad Request",
                "error" => $e
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $food = Food::find($id);
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'type' => 'nullable|string|max:255',
                'price' => 'nullable|numeric',
            ]);

             if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ], 400);
            }

            if ($request->has('name')) {
                $food->update(['name' => $request->name]);
            }

            if ($request->has('description')) {
                $food->update(['description' => $request->description]);
            }

            if ($request->has('type')) {
                $food->update(['type' => $request->type]);
            }

            if ($request->has('price')) {
                $food->update(['price' => $request->price]);
            }
            
            return [
                "status" => 200,
                "message" => "Success",
                "data" => $food
            ];
        } catch(\Exception $e){
            return [
                "status" => 400,
                "message" => "Bad Request",
                "error" => $e
            ];
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $food = Food::find($id);
            if($food){
                $food->delete();
                return [
                    "status" => 200,
                    "message" => "Success Delete Data",
                ];
            } else{
                return [
                    "status" => 400,
                    "message" => "No Data",
                ];
            }
        }catch(\Exception $e){
              return [
                "status" => 400,
                "message" => "Bad Request",
                "error" => $e
            ];
        }
    }
}
