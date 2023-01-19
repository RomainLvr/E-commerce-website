<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;

class ProductsController extends Controller
{

    public function showProducts()
    {
        $products = ProductModel::all();
        return view('produits', ['produits' => $products]);
    }
}
