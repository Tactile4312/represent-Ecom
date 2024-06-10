@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <i class="fas fa-lock"></i> {{ __('Enter OTP') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verifyOtp') }}" id="otp-form">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8 d-flex justify-content-center mb-3">
                                <input type="text" class="form-control otp-input mx-1 text-center" name="otp" maxlength="6" required style="width: 100%; font-size: 2rem; height: 4rem;">
                                @error('otp')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Verify OTP') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .otp-input:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        border-color: #80bdff;
    }
</style>
@endsection
