@extends('layouts.app')
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
@section('content')
<body class="">
    <div class="flex items-center justify-center w-full mt-12">
        <div class="flex grid lg:grid-cols-2 gap-20 mx-auto">
            <div class="row">
                @foreach($products as $key => $product)
                    <div class="col-md-3 col-sm-1">
                        <div class="d-flex justify-content-center container mt-5">
                            <div class="card p-3 bg-white">
                                <div class="about-product text-center mt-2">
                                    @if($file = $product->image)
                                        <img src="{{ asset('storage/' .  $file->file_name) }}" width="300">
                                    @else
                                        <img src="{{ asset('storage/default_image.png') }}" width="300">
                                    @endif
                                    <p></p>
                                    <div>
                                        <h4>{{ $product->name }}</h4>
                                        <h6 class="mt-0 text-black-50">Available stock: {{ $product->available_stock }}</h6>
                                    </div>
                                </div>
                                <div class="stats mt-2">
                                    <div class="d-flex justify-content-between p-price"><span>Price nett</span><span>{{number_format(($product->price_nett->getAmount()) / 100, 2, '.', ' ')}} {{$product->price_nett->getCurrency()}}</span></div>
                                    <div class="d-flex justify-content-between p-price"><span>Price gross</span><span>{{number_format(($product->price_gross->getAmount()) / 100, 2, '.', ' ')}} {{$product->price_gross->getCurrency()}}</span></div>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                    <input type="number" id="quantity" name="quantity" value="{{ request('count') ?? 0 }}" min="1" max="{{ $product->available_stock }}">
                                    <button class="add-to-cart" type="button" class="btn btn-sm btn-outline-secondary"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price_nett->getAmount() / 100 }}">Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($key % 3 === 0 && $key !== 0)
                        </div>
                        <div class="row">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
@endsection