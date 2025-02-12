@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Add to Bag</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('landing_assets/img/banner/banner-img.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Add to Bag</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('landing_assets/img/banner/banner-img.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- start product Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        @foreach ($categories as $category)
            <div class="single-product-slider">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h1>{{ $category->name }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($category->products->count() == 0)
                            <div class="col-lg-12 text-center">
                                <h3>No Product</h3>
                            </div>
                        @endif
                        @foreach ($category->products->take(8) as $product)
                            <!-- single product -->
                            <div class="col-lg-3 col-md-6">
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
                                            <a href="{{ route('tambahkan-keranjang', ['product_id' => $product->id, 'qty' => 1]) }}"
                                                class="social-info">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">add to bag</p>
                                            </a>
                                            @if (in_array($product->id, $arrayWishlist))
                                                <a href="{{ route('hapus-wishlist', ['product_id' => $product->id]) }}"
                                                    class="social-info">
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Remove Wishlist</p>
                                                </a>
                                            @else
                                                <a href="{{ route('masukkan-wishlist', ['product_id' => $product->id]) }}"
                                                    class="social-info">
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Wishlist</p>
                                                </a>
                                            @endif
                                            <a href="{{ route('product-detail', ['id' => $product->id]) }}"
                                                class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">view more</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!-- end product Area -->
@endsection
