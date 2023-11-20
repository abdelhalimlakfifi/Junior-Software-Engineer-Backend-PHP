<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return ["hey"];
    }



    public function store(Request $request)
    {

        // validates inputs
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $parent = null;

        if($request->parentName != null)
        {
            $parent = Category::where('name', $request->parentName)->first();


            if(!$parent)
            {
                return response()->json(['message' => 'Category parent name not found'], 404);
            }
        }



        $category = Category::create([
            'name' => $request->name,
            'parent_category_id'    =>  $parent != null ? $parent->id : null,
        ]);


        return response()->json($category, 201);

    }
}
