<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;


class MogitateController extends Controller
{
    public function index() {
        $products = Product::with('seasons')->paginate(6);

        return view('index', compact('products'));
    }
}
