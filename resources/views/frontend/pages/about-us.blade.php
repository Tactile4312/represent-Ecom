@extends('frontend.layouts.master')

@section('title','Ecommerce Laravel || About Us')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="javascript:void(0);">About Us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- About Us -->
<section class="about-us section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-12">
				<div class="about-content">
					@php
						$settings = DB::table('settings')->get();
					@endphp
					<h3>Welcome To <span>BJMP Ecommerce</span></h3>
					<p>
						@foreach($settings as $data)
							{!! $data->description !!}
						@endforeach
					</p>
					<div class="button">
						<a href="{{ route('blog') }}" class="btn">Our Blog</a>
						<a href="{{ route('contact') }}" class="btn primary">Contact Us</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<div class="about-img overlay">
					<div class="button">
						<a href="https://www.youtube.com/watch?v=-pUM0nJCC9E" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
					</div>
					<img src="@foreach($settings as $data) {{ asset($data->photo) }} @endforeach" alt="About Us Image">
				</div>
				<!-- Insert your image herse -->
				<img src="{{ asset('images/Artististik.png') }}" alt="Additional Image" style="margin-top: 100px;">
			</div>
		</div>
	</div>
</section>




<!-- End About Us -->





@endsection
