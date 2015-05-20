<?php

namespace App\Http\Controllers\backend\Products;

use App\Http\Requests\backend\Products\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Models\Products\Gambar;
use App\Models\Products\Category;
use App\Models\Products\Attribute;
use DB,Request,Image,Storage,Entrust;

class ProductCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->data['title'] = 'Product';
    }

    public function index() {
        //
        if (!Entrust::can('product-read')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'List Product';
        return view('backend.product.index', $this->data);
    }

    public function getProduct() {
        $data = Product::DtProduct();
        return response()->json($data);
//        $aaData = Product::with('category', 'image')->get();
//        return response()->json(compact('aaData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (!Entrust::can('product-create')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Create Product';
        $this->data['category'] = Category::where('status', 1)->lists('name', 'id');
        return view('backend.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProductRequest $request) {
        //
        $thumb = public_path('images/products/thumb');
        $full = public_path('images/products/full');
        try {
            $input = $request->except('image');
            $input['product_price'] = str_replace('.', '', $input['product_price']);
            $cat_slug = Category::find($input['id_category'])->slug;
            $input['slug'] = $cat_slug . '/' . str_slug($input['product_name']);
            $input['status'] = $request->get('status') == 'on' ? 1 : 0;
            $attr = array_filter($input['name']);
            $product = new Product($input);
            $product->save();
            $pro_id = $product->id;
            if (!empty($attr)) {
                Attribute::SaveAttribute($pro_id, $input['name'], $input['value']);
            }
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $image) {
                    $name = str_random(5) . '.' . $image->getClientOriginalExtension();
                    $img = new Gambar();
                    $img->img_name = $name;
                    $img->id_product = $pro_id;
                    $img->path_thumb = 'images/products/thumb/' . $name;
                    $img->path_full = 'images/products/full/' . $name;
                    $img->save();
                    Image::make($image)->save($full . '/' . $name);
                    Image::make($image)->resize('100', '100')->save($thumb . '/' . $name);
                }
            }
        } catch (Exception $exc) {
            $message = $e->getMessage();
        }
        if (isset($message)) {
            return redirect()->back()->withInput()->withErrors(['message' => $message]);
        }
        return redirect()->route('backend.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        dd(1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        if (!Entrust::can('product-update')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Edit Product';
        $this->data['product'] = Product::find($id);
        $this->data['category'] = Category::where('status', 1)->lists('name', 'id');
        return view('backend.product.edit', $this->data);
    }

    public function metaProduct() {
        $input = Request::except('_token');
        $meta = \App\Models\Products\MetaProduct::firstOrNew(['id_product' => Request::get('id_product')]);
        $meta->meta_title = $input['meta_title'];
        $meta->meta_description = $input['meta_description'];
        $meta->meta_keyword = $input['meta_keyword'];
        if ($meta->save()) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ProductRequest $request, $id) {
        //
        $product = Product::find($id);
        $input = $request->all();
        $input['product_price'] = str_replace('.', '', $input['product_price']);
        $input['slug'] = str_slug($input['product_name']);
        $input['status'] = $request->get('status') == 'on' ? 1 : 0;
        $attr = array_filter($input['name']);
        $product->attribute()->delete();
        if (!empty($attr)) {
            Attribute::SaveAttribute($id, $input['name'], $input['value']);
        }
        if ($product->update($input)) {
            return redirect()->route('backend.product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        if (!Entrust::can('product-delete')) {
            return response()->json(['success' => FALSE]);
        }
        $product = Product::find($id);
        $product->attribute()->delete();
        if (count($product->image) > 0) {
            foreach ($product->image as $image) {
                if (Storage::exists('products/thumb/' . $image->img_name)) {
                    Storage::delete('products/thumb/' . $image->img_name);
                }
                if (Storage::exists('products/full/' . $image->img_name)) {
                    Storage::delete('products/full/' . $image->img_name);
                }
            }
            $product->image()->delete();
        }
        if ($product->delete()) {
            return response()->json(['success' => TRUE]);
        }
    }

}
