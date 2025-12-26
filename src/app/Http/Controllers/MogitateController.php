<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\MogitateRequest;


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
    
    public function create() {
        $seasons = Season::all();
        
        return view('store', compact('seasons'));
    }
    
    public function store(MogitateRequest $request) {
        $validated = $request->validated();
        $path = $request->file('image')->store('products', 'public');
        $product = Product::create([
            'name' => $validated['name'], 
            'price' => $validated['price'], 
            'image' => $path, 
            'description' => $validated['description'], 
        ]);
        
        $product->seasons()->attach($validated['seasons']);
        return redirect('/products');
    }
    
    public function update(MogitateRequest $request) {
        $validated = $request->validated();
        
        $product = Product::find($request->id);

        $product -> name = $validated['name'];
        $product -> price = $validated['price'];
        $product -> description = $validated['description'];

        if ($request->hasFile('image')){
            $product->image = $request->file('image') -> store('products', 'public');
        }

        $product->save();
        $product->seasons()->sync($validated['seasons'] ?? []);
        return redirect('/products');
    }

    public function destroy (Product $product) {
        $product -> delete();

        return redirect('/products');
    }
}
