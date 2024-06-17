<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query();

        // Filter by category
        if ($request->has('category')) {
            $categoryId = $request->category;
            $productsQuery->where('cat_id', $categoryId);
        }

        // Search products
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $productsQuery->where('title', 'like', "%$searchTerm%");
        }

        $products = $productsQuery->paginate(10);
        $categories = Category::where('is_parent', 1)->get();

        return view('backend.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $brand = Brand::get();
        $category = Category::where('is_parent', 1)->get();
        return view('backend.product.create')->with('categories', $category)->with('brands', $brand);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        // This function can be used for displaying single product details
    }

    public function edit($id)
    {
        $brand = Brand::get();
        $product = Product::findOrFail($id);
        $category = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        return view('backend.product.edit')->with('product', $product)
                    ->with('brands', $brand)
                    ->with('categories', $category)->with('items', $items);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Product updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();
        if ($status) {
            request()->session()->flash('success', 'Product deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    // New methods for handling product grids by category and subcategory

    public function filterProducts(Request $request)
    {
        $products = Product::query();

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $products = $products->where('cat_id', $category->id);
            }
        }

        if ($request->filled('price_range')) {
            $priceRange = explode('-', $request->price_range);
            $products = $products->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }

        if ($request->filled('sortBy')) {
            $sortBy = $request->sortBy;
            if ($sortBy == 'title') {
                $products = $products->orderBy('title', 'asc');
            } elseif ($sortBy == 'price') {
                $products = $products->orderBy('price', 'asc');
            } elseif ($sortBy == 'category') {
                $products = $products->orderBy('cat_id', 'asc');
            }
        }

        $products = $products->paginate(9);
        $recent_products = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function productGridCat($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $recent_products = Product::orderBy('id', 'DESC')->limit(3)->get(); // Get recent products

        if ($category) {
            $products = Product::where('cat_id', $category->id)->paginate(9);
            return view('frontend.pages.product-grids', compact('products', 'recent_products'));
        } else {
            /*  *//* return redirect()->back()->with('error', 'Category not found'); */
        }
    }

    public function productGridSubCat($parentSlug, $childSlug)
    {
        $parentCategory = Category::where('slug', $parentSlug)->first();
        $childCategory = Category::where('slug', $childSlug)->first();
        $recent_products = Product::orderBy('id', 'DESC')->limit(3)->get(); // Get recent products

        if ($parentCategory && $childCategory) {
            $products = Product::where('sub_cat_id', $childCategory->id)->paginate(9);
            return view('frontend.pages.product-grids', compact('products', 'recent_products'));
        } else {
            return redirect()->back()->with('error', 'Subcategory not found');
        }
    }
}
