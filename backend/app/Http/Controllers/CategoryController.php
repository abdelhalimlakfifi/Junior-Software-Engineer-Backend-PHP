<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {

        try {
            //code...
            $categories = Category::with('children')->get();

            return response()->json($categories, 201);
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;

            abort(500);
        }
        return ["hey"];
    }



    public function store(Request $request)
    {
        // validates inputs

        $rules = [
            'name' => 'required|unique:categories|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        try {
            //code...
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
        }  catch (\Throwable $th) {
            throw $th;

            abort(500);
        }

    }



    public function show($id)
    {
        try {
            $category = Category::with('children')->find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            return response()->json($category, 200);
        } catch (\Throwable $th) {
            abort(500);
        }
    }



    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:categories|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $parent = null;

            if($request->parentName != null)
            {
                $parent = Category::where('name', $request->parentName)->first();

                if(!$parent)
                {
                    return response()->json(['message' => 'Category parent name not found'], 404);
                }
            }

            $category->update([
                'name' => $request->name,
                'parent_category_id' => $parent != null ? $parent->id : null,
            ]);

            return response()->json($category, 200);
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
