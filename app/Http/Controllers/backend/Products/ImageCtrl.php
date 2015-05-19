<?php

namespace App\Http\Controllers\backend\Products;

use App\Models\Products\Product;
use App\Models\Products\Gambar;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Products\ImageRequest;
use Request;
use Image;
use Storage;

class ImageCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ImageRequest $request) {
        //
        $thumb = public_path('images/products/thumb');
        $full = public_path('images/products/full');
        $input = $request->all();
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            if ($request->has('id_product')) {
                $count = Gambar::where('id_product', '=', $request->get('id_product'))->count();
                if ($count >= 5) {
                    if ($request->ajax()) {
                        return response()->json(['error' => 'Maximum file gambar adalah 5.']);
                    }
                    return redirect()->back()->withErrors('Maximum file gambar adalah 5');
                }
            }
            foreach ($images as $image) {
                $name = str_random(5) . '.' . $image->getClientOriginalExtension();
                $img = new Gambar();
                $img->img_name = $name;
                if ($request->has('id_product')) {
                    $img->id_product = $input['id_product'];
                }
                $img->path_thumb = 'images/products/thumb/' . $name;
                $img->path_full = 'images/products/full/' . $name;
                $img->save();
                Image::make($image)->save($full . '/' . $name);
                Image::make($image)->resize('100', '100')->save($thumb . '/' . $name);
            }
        }
        if ($request->ajax()) {
            return response()->json(['success' => TRUE]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        $this->data['images'] = Gambar::where('id_product', '=', $id)->get();
        return view('backend.product.image', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $gambar = Gambar::find($id);
        if (Storage::exists('products/thumb/' . $gambar->img_name)) {
            Storage::delete('products/thumb/' . $gambar->img_name);
        }
        if (Storage::exists('products/full/' . $gambar->img_name)) {
            Storage::delete('products/full/' . $gambar->img_name);
        }
        if ($gambar->delete()) {
            return response()->json(['success' => TRUE]);
        }
    }

}
