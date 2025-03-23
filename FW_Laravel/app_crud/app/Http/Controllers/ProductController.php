<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'tags'])
            ->latest('id')
            ->paginate(1);

        return view('product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view('product.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->category_id = $request->category;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;

            if ($request->hasFile('image_path')) {
                $product['image_path'] = Storage::put('products', $request->file('image_path'));
            }

            $product->save();

            foreach ($request->galleries as $image) {
                $gallery = new Gallery();
                $gallery->product_id = $product->id;
                $gallery->image_path = Storage::put('galleries', $image);

                $gallery->save();
            }

            $product->tags()->attach($request->tags);

            DB::commit();

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load(['category', 'tags', 'galleries']);
        $productTags = $product->tags()->pluck('id')->all();

        $categories = Category::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view('product.update', compact('categories', 'tags', 'product', 'productTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->category_id = $request->category;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;

            if ($request->hasFile('image_path')) {
                $product['image_path'] = Storage::put('products', $request->file('image_path'));
            }

            $product->save();

            foreach ($request->galleries ?? [] as $id => $image) {
                $gallery = Gallery::query()->find($id);
                $gallery->image_path = Storage::put('galleries', $image);

                $gallery->save();
            }

            $product->tags()->sync($request->tags);

            DB::commit();

            return back()->with('success', 'Thao tác thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->tags()->sync([]);

            $product->galleries()->delete();

            $product->delete();
            DB::commit();

            if ($product->image_path && Storage::exists($product->image_path)) {
                Storage::delete($product->image_path);
            }

            return redirect()->route('products.index')->with('success', 'Thao tác thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withErrors($th->getMessage());
        }
    }
}
