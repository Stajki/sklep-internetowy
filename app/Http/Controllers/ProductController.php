<?php

namespace App\Http\Controllers;

use App\Constants\AccountTypes;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = User::findCurrent();
        $builder = Product::query();
        if ($request->filled('query')) {
            $query = $request->get('query');
            $builder->whereRaw('lower(name) like (?)', ['%' . str_replace(' ', '_', $query) . '%']);
        }

        if ($user->account_type == AccountTypes::USER) {
            return view('product.index', [
                'products' => $builder->get(),
            ]);
        }

        return view('product.admin.index', [
            'products' => $builder->withTrashed()->get(),
        ]);
    }
}
