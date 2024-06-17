@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cartItems = Helper::getAllProductFromCart();
                            @endphp
                            <form action="{{ route('cart.update') }}" method="POST" id="cart-update-form">
                                @csrf
                                @if($cartItems && count($cartItems) > 0)
                                    @foreach($cartItems as $key => $cart)
                                        <tr>
                                            @php
                                                $photo = explode(',', $cart->product['photo']);
                                                $price = $cart->product['price'] - ($cart->product['price'] * $cart->product['discount'] / 100);
                                            @endphp
                                            <td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
                                            <td class="product-des" data-title="Description">
                                                <p class="product-name"><a href="{{ route('product-detail', $cart->product['slug']) }}" target="_blank">{{$cart->product['title']}}</a></p>
                                                <p class="product-des">{!! $cart['summary'] !!}</p>
                                            </td>
                                            <td class="price" data-title="Price"><span>₱{{ number_format($price, 2) }}</span></td>
                                            <td class="qty" data-title="Qty">
                                                <div class="input-group">
                                                    <input type="number" name="quant[{{$key}}]" class="input-number" data-min="1" data-max="100" value="{{$cart->quantity}}" onchange="this.form.submit()">
                                                    <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
                                                </div>
                                            </td>
                                            <td class="total-amount cart_single_price" data-title="Total"><span class="money">₱{{ number_format($price * $cart->quantity, 2) }}</span></td>
                                            <td class="action" data-title="Remove"><a href="{{ route('cart-delete', $cart->id) }}"><i class="ti-trash remove-icon"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            You don't have any items in your cart. <a href="{{ route('home') }}" style="color:blue;">Continue shopping</a>
                                        </td>
                                    </tr>
                                @endif
                            </form>
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount flex-container">
                        <div class="left flex-child">
                            <!-- You can add more content to the left side if needed -->
                        </div>
                        <div class="right flex-child">
                            <ul>
                                <li class="order_subtotal" data-price="{{ Helper::getTotalCartPrice() }}">Cart Subtotal<span> ₱{{ number_format(Helper::getTotalCartPrice(), 2) }}</span></li>
                                @if(session()->has('coupon'))
                                    <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">You Save<span>₱{{ number_format(Session::get('coupon')['value'], 2) }}</span></li>
                                @endif
                                @php
                                    $total_amount = Helper::getTotalCartPrice();
                                    if(session()->has('coupon')){
                                        $total_amount = $total_amount - Session::get('coupon')['value'];
                                    }
                                @endphp
                                <li class="last" id="order_total_price">You Pay<span>₱{{ number_format($total_amount, 2) }}</span></li>
                            </ul>
                            <div class="button5">
                                <a href="{{ route('checkout') }}" class="btn {{ !$cartItems || count($cartItems) == 0 ? 'disabled' : '' }}">Checkout</a>
                                <a href="{{ route('product-grids') }}" class="btn">Continue shopping</a>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
@endsection

@push('styles')
<style>
    .flex-container {
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
    }

    .flex-child {
        margin: 10px;
    }

    .total-amount .right {
        text-align: right;
    }

    li.shipping {
        display: inline-flex;
        width: 100%;
        font-size: 14px;
    }

    li.shipping .input-group-icon {
        width: 100%;
        margin-left: 10px;
    }

    .input-group-icon .icon {
        position: absolute;
        left: 20px;
        top: 0;
        line-height: 40px;
        z-index: 3;
    }

    .form-select {
        height: 30px;
        width: 100%;
    }

    .form-select .nice-select {
        border: none;
        border-radius: 0px;
        height: 40px;
        background: #f6f6f6 !important;
        padding-left: 45px;
        padding-right: 40px;
        width: 100%;
    }

    .list li {
        margin-bottom: 0 !important;
    }

    .list li:hover {
        background: #F7941D !important;
        color: white !important;
    }

    .form-select .nice-select::after {
        top: 14px;
    }

    .btn.disabled {
        pointer-events: none;
        background-color: #ccc;
        color: #666;
    }
</style>
@endpush
