<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\User;
use Newsletter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserRegistered;
class FrontendController extends Controller
{

    public function index(Request $request)
    {
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured=Product::where('status','active')->where('is_featured',1)->orderBy('price','DESC')->limit(2)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        // return $category;
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('product_lists',$products)
                ->with('category_lists',$category);
    }

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }


    public function productGrids(){
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category


        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists(){
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }

        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category


        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }


    public function productFilter(Request $request){
    $query = Product::query();

    // Apply category filter
    if ($request->category) {
        $category = Category::where('slug', $request->category)->first();
        if ($category) {
            $query->where('cat_id', $category->id);
        }
    }

    // Apply price range filter
    if ($request->price_range) {
        [$min_price, $max_price] = explode('-', $request->price_range);
        $query->whereBetween('price', [(float)$min_price, (float)$max_price]);
    }

    // Apply sort filter
    if ($request->sortBy) {
        if ($request->sortBy == 'title') {
            $query->orderBy('title', 'asc');
        } elseif ($request->sortBy == 'price') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sortBy == 'category') {
            $query->orderBy('cat_id', 'asc');
        }
    }

    // Apply show filter
    $products = $query->paginate($request->show ?? 9);

    // Fetch recent products
    $recent_products = Product::orderBy('created_at', 'desc')->take(5)->get();

    // Determine which view to return
    if ($request->view == 'grid') {
        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    } else {
        return view('frontend.pages.product-lists', compact('products', 'recent_products'));
    }
}





    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog(){
        $post=Post::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if the remember me checkbox is checked
        $remember = $request->has('remember');

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'], $remember)) {
            Session::put('user',$data['email']);
            request()->session()->flash('success','Logged in successfully!');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logged out successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // Validation and user creation logic...
        $this->validate($request, [
            'first_name' => 'string|required|min:2',
            'middle_name' => 'string|nullable|max:191',
            'last_name' => 'string|required|min:2',
            'email' => 'string|required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $data = $request->all();
        $data['name'] = $data['first_name'] . ' ' . ($data['middle_name'] ? $data['middle_name'] . ' ' : '') . $data['last_name'];

        $user = $this->create($data);

        if ($user) {
            Session::put('user', $data['email']);
            Mail::to($user->email)->send(new UserRegistered($user)); // Send registration email
            request()->session()->flash('success', 'Registered successfully');
            return redirect()->route('home');
        } else {
            request()->session()->flash('error', 'Please try again!');
            return back();
        }
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    // Reset password

    /* public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    } */
    public function showResetRequestForm()
    {
        return view('auth.passwords.email');
    }
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $otp = random_int(100000, 999999); // Generate a 6-digit OTP
        $email = $request->input('email');

        // Store the OTP and email in the session with an expiration time
        Session::put('otp', $otp);
        Session::put('otp_email', $email);
        Session::put('otp_expires_at', Carbon::now()->addMinutes(10));

        // Send OTP in the email
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)
                    ->subject('Your OTP for Password Reset');
        });

        return redirect()->route('password.otpForm')->with('status', 'OTP sent to your email!');
    }





    public function showVerifyForm()
    {
        return view('auth.passwords.otp');
    }

    public function verifyOtp(Request $request) {
        $request->validate(['otp' => 'required|numeric']);

        $otp = $request->input('otp');
        $email = Session::get('otp_email');
        $storedOtp = Session::get('otp');
        $expiresAt = Session::get('otp_expires_at');

        if (!$storedOtp || $storedOtp != $otp || Carbon::now()->greaterThan($expiresAt)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP is valid, redirect to password reset form
        return redirect()->route('password.resetForm', ['email' => $email]);
    }


        public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset', ['email' => $request->email]);
    }

    public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Find the user by email
    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return back()->withErrors(['email' => 'No user found with this email address.']);
    }

    // Update the user's password
    $user->password = Hash::make($request->input('password'));
    $user->save();

    // Log the user in
    Auth::login($user);

    // Redirect to home
    return redirect()->route('home')->with('status', 'Password reset successful!');
}

}
