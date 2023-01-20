<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function showProducts()
    {
        $products = ProductModel::all();
        return view('produits', ['produits' => $products]);
    }

    public function sort(Request $request)
    {
        $sort = $request->sort;

        switch ($sort) {
            case 'priceAsc':
                $products = ProductModel::orderBy('price', 'asc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'priceDesc':
                $products = ProductModel::orderBy('price', 'desc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'nameAsc':
                $products = ProductModel::orderBy('name', 'asc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'nameDesc':
                $products = ProductModel::orderBy('name', 'desc')->get();
                return view('produits', ['produits' => $products]);
                break;
            default:
                $products = ProductModel::all();
                return view('produits', ['produits' => $products]);
                break;
        }
    }
}
