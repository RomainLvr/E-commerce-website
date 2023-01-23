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

    public function filter(Request $request)
    {
        $sort = $request->sort;
        $search = $request->search == '' ? '%' : $request->search;
        
        switch ($sort) {
            case 'priceAsc':
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->orderBy('price', 'asc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'priceDesc':
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->orderBy('price', 'desc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'nameAsc':
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->orderBy('name', 'asc')->get();
                return view('produits', ['produits' => $products]);
                break;
            case 'nameDesc':
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->orderBy('name', 'desc')->get();
                return view('produits', ['produits' => $products]);
                break;
                case 'new' :
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->get();
                return view('produits', ['produits' => $products]);
                break;
            default:
                $products = ProductModel::where('name', 'like', '%' . $search . '%')->get();
                return view('produits', ['produits' => $products]);
                break;
                
        }
    }

}
