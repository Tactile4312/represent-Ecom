@extends('frontend.layouts.master')
@section('title','Ecommerce Laravel || HOME PAGE')
@section('main-content')

<!-- Slider Area -->
@if(count($banners)>0)
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($banners as $key=>$banner)
            <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </section>
@endif

<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @php
            $category_lists = DB::table('categories')->where('status', 'active')->limit(3)->get();
        @endphp
        @if($category_lists)
        @foreach($category_lists as $cat)
            @if($cat->is_parent == 1)
                <!-- Single Banner  -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-banner">
                        @if($cat->photo)
                            <img src="{{ $cat->photo }}" alt="Image of {{ $cat->title }}" class="img-fluid">
                        @else
                            <img src="https://via.placeholder.com/600x370" alt="Placeholder image">
                        @endif
                        <div class="content banner-text">
                            <h3 class="title-opacity">{{ $cat->title }}</h3>
                            <a href="{{ route('product-cat', $cat->slug) }}" class="btn btn-primary discover-now-btn">Discover Now</a>
                        </div>
                    </div>
                </div>
                <!-- /End Single Banner  -->
            @endif
        @endforeach
    @endif


        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>New Items</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            @php
                                $categories = DB::table('categories')->where('status', 'active')->where('is_parent', 1)->get();
                            @endphp
                            @if($categories)
                                <button class="btn active" style="background:black" data-filter="*">
                                    Recently Added
                                </button>
                                @foreach($categories as $key => $cat)
                                    <button class="btn" style="background:none;color:black;" data-filter=".category-{{$cat->id}}">
                                        {{$cat->title}}
                                    </button>
                                @endforeach
                            @endif
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content isotope-grid" id="myTabContent">
                        @foreach($categories as $cat)
                            @php
                                $categoryProducts = DB::table('products')
                                    ->where('cat_id', $cat->id)
                                    ->where('status', 'active')
                                    ->orderBy('created_at', 'desc')
                                    ->take(8)
                                    ->get();
                            @endphp
                            @foreach($categoryProducts as $product)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item category-{{$cat->id}}">
                                    <div class="single-product">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <a href="{{route('product-detail', $product->slug)}}">
                                                @php
                                                    $photos = explode(',', $product->photo);
                                                @endphp
                                                <img class="default-img" src="{{$photos[0]}}" alt="{{$photos[0]}}">
                                                <img class="hover-img" src="{{$photos[0]}}" alt="{{$photos[0]}}">
                                                @if($product->stock <= 0)
                                                    <span class="out-of-stock">Sold Out</span>
                                                @elseif($product->condition == 'new')
                                                    <span class="new">New</span>
                                                @elseif($product->condition == 'hot')
                                                    <span class="hot">Hot</span>
                                                @else
                                                    <span class="price-dec">{{$product->discount}}% Off</span>
                                                @endif
                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#product-modal-{{$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                                    <a title="Wishlist" href="{{route('add-to-wishlist', $product->slug)}}"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                                                </div>
                                                <div class="product-action-2">
                                                    <form id="add-to-cart-form" action="{{ route('single-add-to-cart') }}" method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                                                        <input type="hidden" name="quant[1]" value="1">
                                                    </form>
                                                    <a href="#" onclick="document.getElementById('add-to-cart-form').submit();" title="Add to cart">Add to cart</a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Product Content -->
                                        <div class="product-content">
                                            <h3><a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a></h3>
                                            @php
                                                $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                            @endphp
                                            <div class="product-price">
                                                @if($product->discount > 0)
                                                    <span>₱{{number_format($after_discount, 2)}}</span>
                                                    <del style="padding-left: 4%;">₱{{number_format($product->price, 2)}}</del>
                                                @else
                                                    <span>₱{{number_format($product->price, 2)}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->
{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}
<!-- Start Midium Banner  -->
<section class="medium-banner">
    <div class="container">
        <div class="row">
            @if($featured)
                @foreach($featured as $data)
                    <!-- Single Banner -->
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="single-banner">
                            @php
                                $photo = explode(',', $data->photo);
                            @endphp
                            <img src="{{$photo[0]}}" alt="Feature image of {{$data->title}}, {{$data->cat_info['title']}}" class="img-fluid">
                            <div class="content banner-text">
                                <p>{{$data->cat_info['title']}}</p>
                                <h3>{{$data->title}} <br> Up to <span>{{$data->discount}}%</span></h3>
                                <a href="{{route('product-detail', $data->slug)}}" class="btn btn-primary shop-now-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Banner -->
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- End Midium Banner -->

<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        @if($product->condition == 'hot')
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('product-detail', $product->slug)}}">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist', $product->slug)}}"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a href="{{route('add-to-cart', $product->slug)}}">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        @php
                                            $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                        @endphp
                                        @if($product->discount > 0)
                                            <span class="old">₱{{number_format($product->price, 2)}}</span>
                                            <span>₱{{number_format($after_discount, 2)}}</span>
                                        @else
                                            <span>₱{{number_format($product->price, 2)}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<!-- End Shop Home List  -->

<!-- Start Shop Blog  -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Blog  -->
                        <div class="shop-single-blog">
                            <img src="{{$post->photo}}" alt="{{$post->photo}}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                            </div>
                        </div>
                        <!-- End Single Blog  -->
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>



<!-- Modal -->
@if($product_lists)
    @foreach($categories as $cat)
    @php
        $categoryProducts = DB::table('products')
            ->where('cat_id', $cat->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
    @endphp
    @foreach($categoryProducts as $product)
        <div class="modal fade" id="product-modal-{{$product->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <!-- Product Slider -->
                                <div class="product-gallery">
                                    <div class="quickview-slider-active">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        @foreach($photo as $data)
                                            <div class="single-slider">
                                                <img src="{{$data}}" alt="{{$data}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    </div>
                                    <!-- End Product Slider -->
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="quickview-content">
                                            <h2>{{$product->title}}</h2>
                                            <div class="quickview-ratting-review">
                                                <div class="quickview-ratting-wrap">
                                                    <div class="quickview-ratting">
                                                        @php
                                                            $rate = DB::table('product_reviews')->where('product_id', $product->id)->avg('rate');
                                                            $rate_count = DB::table('product_reviews')->where('product_id', $product->id)->count();
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($rate >= $i)
                                                                <i class="yellow fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <a href="#"> ({{$rate_count}} customer review)</a>
                                                </div>
                                                <div class="quickview-stock">
                                                    @if($product->stock > 0)
                                                        <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                                    @else
                                                        <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @php
                                                $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                                            @endphp
                                            <h3><small><del class="text-muted">₱{{number_format($product->price, 2)}}</del></small> ₱{{number_format($after_discount, 2)}}</h3>
                                            <div class="quickview-peragraph">
                                                <p>{!! html_entity_decode($product->summary) !!}</p>
                                            </div>

                                    @if($product->size)
                                        <div class="size">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <h5 class="title">Size</h5>
                                                    <select>
                                                        @php
                                                            $sizes = explode(',', $product->size);
                                                        @endphp
                                                        @foreach($sizes as $size)
                                                            <option>{{$size}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ route('single-add-to-cart') }}" method="POST" class="mt-4">
                                        @csrf
                                        <div class="quantity">
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{ $product->slug }}">
                                                <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>
                                        <div class="add-to-cart">
                                            <button type="submit" class="btn">Add to cart</button>
                                            <a href="{{ route('add-to-wishlist', $product->slug) }}" class="btn min"><i class="ti-heart"></i></a>
                                        </div>
                                    </form>

                                    <div class="default-social">
                                        <!-- Add any social media links here if needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endforeach
@endif
<!-- Modal end -->
@endsection

@push('styles')
    <style>
    /* Banner Sliding */
    #Gslider .carousel-inner {
    background: #000000;
    color:black;
    }

    #Gslider .carousel-inner{
    height: 550px;
    }
    #Gslider .carousel-inner img{
        width: 100% !important;
        opacity: .8;
    }

    #Gslider .carousel-inner .carousel-caption {
    bottom: 60%;
    }

    #Gslider .carousel-inner .carousel-caption h1 {
    font-size: 50px;
    font-weight: bold;
    line-height: 100%;
    /* color: #F7941D; */
    color: #1e1e1e;
    }

    #Gslider .carousel-inner .carousel-caption p {
    font-size: 18px;
    color: black;
    margin: 28px 0 28px 0;
    }

    #Gslider .carousel-indicators {
    bottom: 70px;
    }

    .title-opacity {
        background-color: rgba(0, 0, 0, 0.5); /* Black background with 50% opacity */
        padding: 5px 10px; /* Add some padding */
        border-radius: 5px; /* Optional: Rounded corners */
        color: white; /* Optional: White text color */
    }
</style>
@endpush



@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

@endpush
