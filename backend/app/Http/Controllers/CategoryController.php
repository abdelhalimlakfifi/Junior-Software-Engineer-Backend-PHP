<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return ["hey"];
    }



    public function store(Request $request)
    {

        dd($request->all());
    }
}
