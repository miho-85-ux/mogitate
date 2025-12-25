<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;


class MogitateController extends Controller
{
    public function index(Request $request) {
        $query = Product::with('seasons');
        
        if ($request->filled('name')) {
            $query -> where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('price')) {
            if ($request->price === 'high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->price === 'low') {
                $query->orderBy('price', 'asc');
            }
        }
        
        $products = $query->paginate(6)->withQueryString();

        return view('index', compact('products'));
    }

    public function edit($product) {
        $product = Product::with('seasons')->find($product);
        $seasons = Season::all();

        return view('detail', compact('product', 'seasons'));
    }

    public function update(Request $request) {
        $product = Product::find($request->key);
        $product->update($request->only(['name', 'price', 'image', 'description']));
    //    季節の登録処理必要

        return redirect('/products');
    }
}
