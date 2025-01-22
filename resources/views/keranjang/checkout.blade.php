@extends('layouts.app')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Keranjang</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/keranjang">Keranjang</a>
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
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('update-keranjang') }}" method="post">
                                @csrf
                                @php
                                    $subtotal = 0;
                                @endphp
                                @if (count($cart->cartItems) == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Keranjang masih kosong</td>
                                    </tr>
                                @else
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart->cartItems as $item)
                                        @php
                                            if ($item->product->discount && $item->product->discount != 0) {
                                                $total_potongan =
                                                    $item->product->price -
                                                    ($item->product->price * $item->product->discount) / 100;
                                                $total = $total_potongan * $item->quantity;
                                                $subtotal += $total;
                                            } else {
                                                $total = $item->product->price * $item->quantity;
                                                $total_potongan = $item->product->price;
                                                $subtotal += $total;
                                            }
                                        @endphp
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
                                                <h5>Rp{{ number_format($total_potongan, 0, '.', '.') }}</h5>
                                            </td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>
                                                <h5>Rp{{ number_format($total, 0, '.', '.') }}
                                                </h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </form>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>Rp{{ number_format($subtotal, 0, '.', '.') }}</h5>
                                </td>
                            </tr>
                            <form action="{{ route('processCheckout') }}" method="post">
                                @csrf
                                <tr class="shipping_area">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <h5>Payment Method</h5>
                                    </td>
                                    <td>
                                        <select class="shipping_select" name="payment_method">
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="out_button_area">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <button type="submit" class="primary-btn">Proceed</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
