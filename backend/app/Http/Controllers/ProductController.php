<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('categories')->get();

        return response()->json(['products' => $products, 'categories' => $categories], 201);
    }

    public function store(Request $requrest)
    {
        $domain = request()->getHttpHost();


        $imagePath = uploadFile($requrest->image, 'productsImage');

        $product = new Product();
        $product->name = $requrest->title;
        $product->price = $requrest->price;
        $product->description = $requrest->description;
        $product->image = $domain.'/'.$imagePath;
        $product->save();

        $productCategory = new ProductCategory();
        $productCategory->product_id    =   $product->id;
        $productCategory->category_id   = $requrest->category;
        $productCategory->save();



        return response()->json($product, 201);
    }
}
