@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="POST" action="{{route('cart.order')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Complete Your Purchase</h2>
                        <p>Just a few more steps to complete your purchase securely!!</p>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>First Name<span>*</span></label>
                                    <input type="text" name="first_name" placeholder="" value="{{ auth()->user()->first_name ?? old('first_name') }}" required>
                                    @error('first_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Last Name<span>*</span></label>
                                    <input type="text" name="last_name" placeholder="" value="{{ auth()->user()->last_name ?? old('last_name') }}" required>
                                    @error('last_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input type="email" name="email" placeholder="" value="{{ auth()->user()->email ?? old('email') }}" required>
                                    @error('email')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                    @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Country<span>*</span></label>
                                    <select name="country" id="country" required>
                                        <option value="PH">Philippines</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Input Your Complete Address <span>*</span></label>
                                    <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                    @error('address1')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                    @error('post_code')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>CART TOTAL</h2>
                            <div class="content">
                                <ul>
                                    @php
                                        $subtotal = 0;
                                        foreach(Helper::getAllProductFromCart() as $cart) {
                                            $subtotal += $cart->price * $cart->quantity;
                                        }
                                        $total_amount = $subtotal;
                                        if(session('coupon')) {
                                            $total_amount -= session('coupon')['value'];
                                        }
                                    @endphp
                                    <li class="order_subtotal" data-price="{{ $subtotal }}">Cart Subtotal<span>₱{{ number_format($subtotal, 2) }}</span></li>
                                    <li class="last" id="order_total_price">Total<span>₱{{number_format($total_amount,2)}}</span></li>
                                </ul>
                            </div>
                        </div>
                        <!--/ End Order Widget -->
                         <!-- Order Widget Card Payment -->
                         <div class="single-widget">
                            <h2>Payment Methods</h2>
                            <div class="content">
                                <div class="checkbox">
                                    <form-group>
                                        {{-- <input name="payment_method" type="radio" value="cod" required> <label> Cash On Delivery</label><br> --}}
                                        <input name="payment_method" type="radio" value="gcash" required> <label> G-Cash Payment</label><br>
                                        <input name="payment_method" type="radio" value="onsite_payment" required> <label> Onsite Payment</label><br>
                                        {{-- <input name="payment_method" type="radio" value="paypal"> <label> PayPal</label><br>
                                        <input name="payment_method" type="radio" value="cardpay" required> <label> Card Payment</label><br>
 --}}
                                        <!-- Credit Card Details -->
                                        <div id="creditCardDetails" style="display: none;">
                                            <label for="cardNumber">Card Number:</label>
                                            <input type="text" id="cardNumber" name="card_number" maxlength="16"><br>

                                            <label for="cardName">Name on Card:</label>
                                            <input type="text" id="cardName" name="card_name"><br>

                                            <label for="expirationDate">Expiration Date:</label>
                                            <input type="text" id="expirationDate" name="expiration_date" maxlength="5"><br>

                                            <label for="cvv">CVV:</label>
                                            <input type="text" id="cvv" name="cvv" maxlength="3"><br>
                                        </div>

                                        <!-- G-Cash Details -->
                                        @php
                                            $gcash = App\Models\GCashDetail::first();
                                        @endphp
                                        <div id="gcashDetails" style="display: none;">
                                            <label for="gcashReceipt">Upload Receipt:</label>
                                            <input type="file" id="gcashReceipt" name="gcash_receipt" accept="image/*"><br>

                                            <label for="gcashReference">Reference Number:</label>
                                            <input type="text" id="gcashReference" name="gcash_reference"><br>

                                            @if(isset($gcash->qr_code_path))
                                                <label>Scan QR Code:</label>
                                                <img src="{{ $gcash->qr_code_path }}" alt="GCash QR" style="max-width: 150px;">
                                            @endif
                                            @if(isset($gcash->number))
                                                <p>GCash Number: {{ $gcash->number }}</p>
                                            @endif
                                        </div>
                                    </form-group>
                                </div>
                            </div>

                        </div>
                        <!--/ End Order Widget -->
                        <!-- Button Widget -->
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <button type="submit" class="btn">Proceed to Checkout</button>
                                </div>
                            </div>
                        </div>
                        <!--/ End Button Widget -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/ End Checkout -->

@endsection

@push('styles')
<style>
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
</style>
@endpush

@push('scripts')
<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("select.select2").select2();
    });
    $('select.nice-select').niceSelect();

    $('input[name="payment_method"]').change(function() {
        if ($(this).val() === 'cardpay') {
            $('#creditCardDetails').show();
            $('#gcashDetails').hide();
        } else if ($(this).val() === 'gcash') {
            $('#gcashDetails').show();
            $('#creditCardDetails').hide();
        } else {
            $('#creditCardDetails').hide();
            $('#gcashDetails').hide();
        }
    });

    $('.shipping select[name=shipping]').change(function() {
        let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
        let subtotal = parseFloat($('.order_subtotal').data('price'));
        let coupon = parseFloat($('.coupon_price').data('price')) || 0;
        $('#order_total_price span').text('₱' + (subtotal + cost - coupon).toFixed(2));
    });
</script>
@endpush
