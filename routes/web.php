<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GCashController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register'=>false]);
Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');


//locations

// web.php
Route::get('/get-regions', [LocationController::class, 'getRegions'])->name('get-regions');
Route::get('/get-provinces', [LocationController::class, 'getProvinces'])->name('get-provinces');
Route::get('/get-cities', [LocationController::class, 'getCities'])->name('get-cities');
Route::get('/get-barangays', [LocationController::class, 'getBarangays'])->name('get-barangays');
Route::post('message/{id}/reply', [MessageController::class, 'reply'])->name('message.reply');
//newlu implements
Route::post('/user/order/requestCancel/{id}', [OrderController::class, 'requestCancel'])->name('user.order.requestCancel');
Route::patch('/admin/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
Route::delete('/category/bulkDelete', [CategoryController::class, 'bulkDelete'])->name('category.bulkDelete');



// routes/web.php
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');

// routes/web.php
Route::get('/product-grids/{slug}', 'ProductController@productGridCat')->name('product-grid-cat');
Route::get('/product-grids/{parent}/{child}', 'ProductController@productGridSubCat')->name('product-grid-sub-cat');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('single-add-to-cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('single-add-to-cart');
Route::post('/shop/filter', [ProductController::class, 'filterProducts'])->name('shop.filter');
// web.php
Route::post('/single-add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::get('password/reset', 'FrontendController@showResetRequestForm')->name('password.request');
Route::post('password/email', 'FrontendController@sendOtp')->name('password.email');
Route::get('password/otp', 'FrontendController@showVerifyForm')->name('password.otpForm');
Route::post('password/verify-otp', 'FrontendController@verifyOtp')->name('password.verifyOtp');
Route::get('password/reset-form', 'FrontendController@showResetForm')->name('password.resetForm');
Route::post('password/reset', 'FrontendController@reset')->name('password.update');

// Socialite
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@home')->name('home');
Route::get('order/{id}/pdf', 'OrderController@generatePDF')->name('order.pdf');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
Route::get('product-detail/{slug}','FrontendController@productDetail')->name('product-detail');
Route::post('/product/search','FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}','FrontendController@productSubCat')->name('product-sub-cat');
Route::get('/product-brand/{slug}','FrontendController@productBrand')->name('product-brand');
Route::get('/faq', 'FrontendController@faq')->name('faq');
// Cart section
Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart','CartController@singleAddToCart')->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}','CartController@cartDelete')->name('cart-delete');
Route::post('cart-update','CartController@cartUpdate')->name('cart.update');



Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');

Route::get('/checkout','CartController@checkout')->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}','WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}','WishlistController@wishlistDelete')->name('wishlist-delete');
Route::post('cart/order','OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');
// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids','FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists','FrontendController@productLists')->name('product-lists');
Route::get('/product-grids', 'FrontendController@productFilter')->name('product-grids')->defaults('view', 'grid');
Route::get('/product-lists', 'FrontendController@productFilter')->name('product-lists')->defaults('view', 'list');

Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');
// Order Track
Route::get('/product/track','OrderController@orderTrack')->name('order.track');
Route::post('product/track/order','OrderController@productTrackOrder')->name('product.track.order');
// Blog
Route::get('/blog','FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}','FrontendController@blogDetail')->name('blog.detail');
Route::get('/blog/search','FrontendController@blogSearch')->name('blog.search');
Route::post('/blog/filter','FrontendController@blogFilter')->name('blog.filter');
Route::get('blog-cat/{slug}','FrontendController@blogByCategory')->name('blog.category');
Route::get('blog-tag/{slug}','FrontendController@blogByTag')->name('blog.tag');

// NewsLetter
Route::post('/subscribe','FrontendController@subscribe')->name('subscribe');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('product/{slug}/review','ProductReviewController@store')->name('review.store');

// Post Comment
Route::post('post/{slug}/comment','PostCommentController@store')->name('post-comment.store');
Route::resource('/comment','PostCommentController');
// Coupon
Route::post('/coupon-store','CouponController@couponStore')->name('coupon-store');
// Payment
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
// Backend section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::resource('/order','OrderController');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    Route::get('gcash', [GCashController::class, 'index'])->name('admin.gcash.index');
    Route::post('gcash', [GCashController::class, 'update'])->name('admin.gcash.update');
    // user route
    Route::resource('users','UsersController');
    // Banner
    Route::resource('banner','BannerController');
    // Brand
    Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','CategoryController');
    // Product
    Route::resource('/product','ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    Route::resource('/post','PostController');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');

    // Order
    Route::resource('/order','OrderController');
    // Shipping
    Route::resource('/shipping','ShippingController');
    // Coupon
    Route::resource('/coupon','CouponController');
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});

// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    // Product Review
    Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
