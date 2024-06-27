@extends('frontend.layouts.master')

@section('title','Ecommerce Laravel || Register Page')

@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shop Register -->
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Register</h2>
                    <!-- Error Summary -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Form -->
                    <form class="form" method="post" action="{{route('register.submit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first_name">First Name<span>*</span></label>
                                    <input type="text" id="first_name" name="first_name" placeholder="" required="required" value="{{old('first_name')}}" autofocus>
                                    <small class="form-text text-muted">Enter your first name (<span style="color: red;">ex. Juan</span>).</small>
                                    @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" placeholder="" value="{{old('middle_name')}}">
                                    <small class="form-text text-muted">Enter your middle name (<span style="color: red;">optional</span>).</small>
                                    @error('middle_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="last_name">Last Name<span>*</span></label>
                                    <input type="text" id="last_name" name="last_name" placeholder="" required="required" value="{{old('last_name')}}">
                                    <small class="form-text text-muted">Enter your last name (<span style="color: red;">ex. De la cruz</span>).</small>
                                    @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Your Email<span>*</span></label>
                                    <input type="email" id="email" name="email" placeholder="" required="required" value="{{old('email')}}">
                                    <small class="form-text text-muted">Enter a valid email address (<span style="color: red;">ex. Juan_Delacruz@gmail.com</span>).</small>
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password">Your Password<span>*</span></label>
                                    <input type="password" id="password" name="password" placeholder="" required="required">
                                    <small class="form-text text-muted">Password must be at least 8 characters long.</small>
                                    <div id="password-strength-meter"></div>
                                    <small id="password-strength-text" class="form-text text-muted"></small>
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password<span>*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="" required="required">
                                    <small class="form-text text-muted">Re-enter your password for confirmation.</small>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Register</button>
                                    <a href="{{route('login.form')}}" class="btn btn-google">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Register -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn {
        margin-right: 0;
    }
    .btn-facebook {
        background: #39579A;
    }
    .btn-facebook:hover {
        background: #073088 !important;
    }
    .btn-github {
        background: #444444;
        color: white;
    }
    .btn-github:hover {
        background: black !important;
    }
    .btn-google {
        background: #ea4335;
        color: white;
    }
    .btn-google:hover {
        background: rgb(243, 26, 26) !important;
    }
    .alert-danger {
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .text-danger {
        color: #ff0000;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    .form-text {
        margin-top: 5px;
        font-size: 12px;
        color: #6c757d;
    }
    #password-strength-meter {
        height: 5px;
        margin-top: 5px;
    }
</style>
@endpush

@push('scripts')
<!-- Include zxcvbn library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const meter = document.getElementById('password-strength-meter');
    const text = document.getElementById('password-strength-text');

    passwordInput.addEventListener('input', function () {
        const val = passwordInput.value;
        const result = zxcvbn(val);

        // Update the password strength meter
        meter.style.width = (result.score + 1) * 20 + '%';
        meter.style.backgroundColor = ['#ff4b47', '#ffa534', '#ffec3d', '#c5ff37', '#0be881'][result.score];

        // Update the text indicator
        const strength = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        text.textContent = 'Strength: ' + strength[result.score];
    });
});
</script>
@endpush
