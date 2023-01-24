<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;

class ProductController extends Controller
{
    public function showProduct($id)
    {
        $product = ProductModel::find($id);
        return view('produit', ['produit' => $product]);
    }

}
