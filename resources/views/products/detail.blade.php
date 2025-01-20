@extends('layouts.app')
@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product Details Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/product/{{ $product->id }}">product details</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="product_image_area mb-3">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="">
                        </div>
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $product->name }}</h3>
                        <span>
                            <s>Rp{{ number_format($product->price, 0, '.', '.') }}</s>
                        </span>
                        <h2>Rp{{ number_format($product->price - ($product->discount * $product->price) / 100, 0, '.', '.') }}
                        </h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : {{ $product->category->name }}</a>
                            </li>
                        </ul>
                        <p>{{ $product->description }}</p>
                        <form action="{{ route('tambahkan-keranjang') }}" method="get">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                    title="Quantity:" class="input-text qty">
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                            </div>
                            <div class="card_area d-flex align-items-center">
                                <button class="primary-btn" type="submit">Add to Cart</button>
                                @if (in_array($product->id, $arrayWishlist))
                                    <a class="icon_btn"
                                        href="{{ route('hapus-wishlist', ['product_id' => $product->id]) }}">
                                        <i class="lnr lnr lnr-heart"></i>
                                    </a>
                                @else
                                    <a class="icon_btn"
                                        href="{{ route('masukkan-wishlist', ['product_id' => $product->id]) }}">
                                        <i class="lnr lnr lnr-heart"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
