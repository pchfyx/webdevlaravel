@extends('layouts.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Wishlist</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/wishlist">Wishlist</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('update-keranjang') }}" method="post">
                                @csrf
                                @php
                                    $subtotal = 0;
                                @endphp
                                @if (count($wishlistItems) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">Keranjang masih kosong</td>
                                    </tr>
                                @else
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($wishlistItems as $item)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            width="120px" alt="">
                                                    </div>
                                                    <div class="media-body">
                                                        <p>{{ $item->product->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>Rp{{ number_format($item->product->price, 0, '.', '.') }}</h5>
                                            </td>
                                            <td>
                                                <a class="icon_btn text-danger"
                                                    href="{{ route('hapus-wishlist', ['product_id' => $item->product->id]) }}">
                                                    <i class="lnr lnr-trash"></i>
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
