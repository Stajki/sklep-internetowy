<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'query' => ['string'],
            'limit' => ['integer'],
        ]);

        $builder = Product::query();
        if ($request->filled('query')) {
            $query = $request->get('query');
            $builder->whereRaw('lower(name) like (?)' ,["%{str_replace(' ', '_', $query)}%"])->get();
        }

        $cart = session()->get('cart');
        if ($cart == null) {
            $cart = [];
        }

        return view('product.index', [
            'products' => $builder->get(),
            'cart' => $cart,
        ]);
    }
}
