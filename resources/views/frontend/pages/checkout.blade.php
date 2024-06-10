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
                        <p>Just a few more steps to complete your purchase securely!</p>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first_name">First Name<span>*</span></label>
                                    <input type="text" name="first_name" id="first_name" placeholder="" value="{{old('first_name')}}" required aria-describedby="firstNameHelp">
                                    <small id="firstNameHelp" class="form-text text-muted">Enter your first name</small>
                                    @error('first_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last_name">Last Name<span>*</span></label>
                                    <input type="text" name="last_name" id="last_name" placeholder="" value="{{old('last_name')}}" required aria-describedby="lastNameHelp">
                                    <small id="lastNameHelp" class="form-text text-muted">Enter your last name</small>
                                    @error('last_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email Address<span>*</span></label>
                                    <input type="email" name="email" id="email" placeholder="" value="{{old('email')}}" required aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">Enter your email address</small>
                                    @error('email')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number <span>*</span></label>
                                    <input type="number" name="phone" id="phone" placeholder="" required value="{{old('phone')}}" aria-describedby="phoneHelp">
                                    <small id="phoneHelp" class="form-text text-muted">Enter your phone number</small>
                                    @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country">Country<span>*</span></label>
                                    <select name="country" id="country" required aria-describedby="countryHelp">
                                        <option value="PH">Philippines</option>
                                    </select>
                                    <small id="countryHelp" class="form-text text-muted">Select your country</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="region">Region<span>*</span></label>
                                    <select name="region" id="region" class="form-control select2" required aria-describedby="regionHelp">
                                        <option value="">Select Region</option>
                                    </select>
                                    <small id="regionHelp" class="form-text text-muted">Select your region</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="province">Province<span>*</span></label>
                                    <select name="province" id="province" class="form-control select2" required aria-describedby="provinceHelp">
                                        <option value="">Select Province</option>
                                    </select>
                                    <small id="provinceHelp" class="form-text text-muted">Select your province</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city">City<span>*</span></label>
                                    <select name="city" id="city" class="form-control select2" required aria-describedby="cityHelp">
                                        <option value="">Select City</option>
                                    </select>
                                    <small id="cityHelp" class="form-text text-muted">Select your city</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="barangay">Barangay<span>*</span></label>
                                    <select name="barangay" id="barangay" class="form-control select2" required aria-describedby="barangayHelp">
                                        <option value="">Select Barangay</option>
                                    </select>
                                    <small id="barangayHelp" class="form-text text-muted">Select your barangay</small>
                                </div>
                            </div>
                            <!-- Hidden Field to store full address -->
                            <input type="hidden" name="full_address" id="full_address">

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address1">Input Your Complete Address <span>*</span></label>
                                    <input type="text" name="address1" id="address1" placeholder="" value="{{old('address1')}}" aria-describedby="addressHelp" readonly>
                                    <small id="addressHelp" class="form-text text-muted">Enter your complete address</small>
                                    @error('address1')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="post_code">Postal Code</label>
                                    <input type="text" name="post_code" id="post_code" placeholder="" value="{{old('post_code')}}" aria-describedby="postCodeHelp">
                                    <small id="postCodeHelp" class="form-text text-muted">Enter your postal code</small>
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

                                    @if(session('coupon'))
                                        <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>₱{{number_format(session('coupon')['value'],2)}}</span></li>
                                    @endif
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
                                        <input name="payment_method" type="radio" value="cod" required> <label> Cash On Delivery</label><br>
                                        <input name="payment_method" type="radio" value="gcash" required> <label> G-Cash Payment</label><br>
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
                                        <div id="gcashDetails" style="display: none;">
                                            <label for="gcashReceipt">Upload Receipt:</label>
                                            <input type="file" id="gcashReceipt" name="gcash_receipt" accept="image/*"><br>

                                            <label for="gcashReference">Reference Number:</label>
                                            <input type="text" id="gcashReference" name="gcash_reference"><br>
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
<link rel="stylesheet" href="{{ asset('frontend/js/select2/css/select2.min.css') }}">
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
<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true
        });

        // Fetch Regions on page load
        $.getJSON('{{ route("get-regions") }}', function(data) {
            $('#region').empty().append('<option value="">Select Region</option>');
            $.each(data, function(key, entry) {
                $('#region').append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
            });
        });

        // Fetch Provinces based on Region selection
        $('#region').on('change', function() {
            let regionCode = $(this).val();
            $('#province').empty().append('<option value="">Select Province</option>');
            $('#city').empty().append('<option value="">Select City</option>');
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
            if(regionCode) {
                $.getJSON('{{ route("get-provinces") }}', { region_code: regionCode }, function(data) {
                    $.each(data, function(key, entry) {
                        $('#province').append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
                    });
                });
            }
        });

        // Fetch Cities based on Province selection
        $('#province').on('change', function() {
            let provinceCode = $(this).val();
            $('#city').empty().append('<option value="">Select City</option>');
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
            if(provinceCode) {
                $.getJSON('{{ route("get-cities") }}', { province_code: provinceCode }, function(data) {
                    $.each(data, function(key, entry) {
                        $('#city').append($('<option></option>').attr('value', entry.citymun_code).text(entry.citymun_name));
                    });
                });
            }
        });

        // Fetch Barangays based on City selection
        $('#city').on('change', function() {
            let citymunCode = $(this).val();
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
            if(citymunCode) {
                $.getJSON('{{ route("get-barangays") }}', { citymun_code: citymunCode }, function(data) {
                    $.each(data, function(key, entry) {
                        $('#barangay').append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
                    });
                });
            }
        });

        // Update full address field on any selection change
        function updateFullAddress() {
            let regionText = $('#region option:selected').text();
            let provinceText = $('#province option:selected').text();
            let cityText = $('#city option:selected').text();
            let barangayText = $('#barangay option:selected').text();
            let fullAddress = `${barangayText}, ${cityText}, ${provinceText}, ${regionText}`;
            $('#full_address').val(fullAddress);
            $('#address1').val(fullAddress);
        }

        $('#region, #province, #city, #barangay').on('change', updateFullAddress);
    });
</script>
@endpush
