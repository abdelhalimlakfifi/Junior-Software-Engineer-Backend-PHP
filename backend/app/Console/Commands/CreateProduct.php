<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\File;


class CreateProduct extends Command
{
    protected $signature = 'app:create-product';

    protected $description = 'Command description';

    public function handle()
    {
        $name = $this->ask('Enter the product name:');
        $price = $this->ask('Enter the product price:');
        $description = $this->ask('Enter the product description:');
        $path = $this->ask('Enter the online path to the image file:');
        $categoryName = $this->ask('Enter the category name:');


        if($name == null){
            $this->error('Product name required!');
            return;
        }
        if($price == null){
            $this->error('Product price required!');
            return;
        }
        if($description == null){
            $this->error('Product description required!');
            return;
        }
        if($categoryName == null){
            $this->error('category name required!');
            return;
        }

        $categories = Category::where('name', $categoryName)->first();

        if(!$categories){
            $this->error('category name not found!');
            return;
        }



        // Create the product
        $product = Product::create([
            'name'          =>  $name,
            'price'         =>  $price,
            'description'   =>  $description,
            'image'         =>  $path,
        ]);

        $categoryProduct = ProductCategory::create([
            'product_id'    =>  $product->id,
            'category_id'   =>  $categories->id
        ]);




        $this->info('Product created successfully!');
        $this->info('Product Name: ' . $name);
        $this->info('Product Price: ' . $price);
        $this->info('Product Image Path: ' . $path);
    }
}
