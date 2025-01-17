@extends('layouts.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/products">Product</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @if (count($categories) == 0)
                            <li class="main-nav-list child text-center">
                                No Data
                            </li>
                        @endif
                        @foreach ($categories as $category)
                            <li class="main-nav-list child"><a
                                    href="/products?category_id='{{ $category->id }}'">{{ $category->name }}<span
                                        class="number">({{ $category->products->count() }})</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <form action="/products">
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting text-white">
                            <label for="keyword">Keyword</label>
                            <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}">
                        </div>
                        <div class="sorting text-white">
                            <label for="start_price">Start Price</label>
                            <input type="number" name="start_price" id="start_price">
                        </div>
                        <div class="sorting text-white">
                            <label for="end_price">End Price</label>
                            <input type="number" name="end_price" id="end_price">
                        </div>
                        <div class="sorting text-white">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @if (count($products) == 0)
                            <div class="col-lg-12 col-md-12 text-center">
                                No Data
                            </div>
                        @endif
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="">
                                    <div class="product-details">
                                        <h6>{{ $product->name }}</h6>
                                        <div class="price">
                                            @if ($product->discount && $product->discount != 0)
                                                @php
                                                    $total_potongan =
                                                        $product->price - ($product->price * $product->discount) / 100;
                                                @endphp
                                                <h6>Rp{{ number_format($total_potongan, 0, '.', '.') }}</h6>
                                                <h6 class="l-through">Rp{{ number_format($product->price, 0, '.', '.') }}
                                                </h6>
                                            @else
                                                <h6>Rp{{ number_format($product->price, 0, '.', '.') }}</h6>
                                            @endif
                                        </div>
                                        <div class="prd-bottom">

                                            <a href="" class="social-info">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">add to bag</p>
                                            </a>
                                            <a href="" class="social-info">
                                                <span class="lnr lnr-heart"></span>
                                                <p class="hover-text">Wishlist</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
