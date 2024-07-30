@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12 text-center mb-4">
        <h1>SmartPhone Shop</h1>
        <p>Belanja SmartPhone murah, aman dan nyaman dari berbagai toko SmartPhone di Indonesia.</p>
    </div>
    <div class="col-md-12">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" loading="lazy"
                        onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}';">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($product['description'], 100) }}</p>
                        <a href="{{ route('product', $product['id']) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <p class="text-center">Tidak ada produk yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection