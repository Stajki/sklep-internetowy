<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Money\Currency;
use Money\Money;

class OrderController extends Controller
{
    public function store()
    {
        $totalPriceNett = new Money(0, new Currency('PLN'));
        $totalPriceGross = new Money(0, new Currency('PLN'));
        $cart = session()->get('cart');
        foreach ($cart as $product) {
            $priceNett = (new Money($product['price_nett'], new Currency('PLN')))->multiply($product['quantity']);
            $priceGross = (new Money($product['price_gross'], new Currency('PLN')))->multiply($product['quantity']);
            $totalPriceNett->add($priceNett);
            $totalPriceGross->add($priceGross);
        }

        $order = Order::make([

        ]);
    }
}
