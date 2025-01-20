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
                                @if (count($cart ? $cart->cartItems : []) == 0)
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
                                                <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                                                <div class="product_count">
                                                    <input type="text" name="quantity[]" id="sst" maxlength="12"
                                                        value="{{ $item->quantity }}" title="Quantity:"
                                                        class="input-text qty">
                                                    <button
                                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                        class="increase items-count" type="button"><i
                                                            class="lnr lnr-chevron-up"></i></button>
                                                    <button
                                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                        class="reduced items-count" type="button"><i
                                                            class="lnr lnr-chevron-down"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <h5>Rp{{ number_format($total, 0, '.', '.') }}
                                                </h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" class="text-right">
                                        <button class="btn gray_btn" type="submit">Update Cart</button>
                                    </td>
                                </tr>
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
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="/products">Continue Shopping</a>
                                        <a class="primary-btn" href="/checkout">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
