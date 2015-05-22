<?php

namespace App\Http\Controllers\backend\Widget;

use App\Models\Widget\Slideshow;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Widget\SlideshowRequest;
use Entrust,Storage,Image,Request;

class SlideshowCtrl extends Controller {

    public function __construct() {
        $this->data['title'] = 'Slideshow';
    }

    public function getSlide() {
        if (Request::isMethod('post')) {
            //
            $data = Request::get('data');
            foreach ($data as $key => $val) {
                $page = Slideshow::find($val['id']);
                $page->ss_order = $key;
                $page->save();
            }
        }
        $this->data['slideshow'] = Slideshow::all();
        return view('backend.slideshow.lists', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        if (!Entrust::can('slideshow-read')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'List Slideshow';
        return view('backend.slideshow.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (!Entrust::can('slideshow-create')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Create Slideshow';
        return view('backend.slideshow.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SlideshowRequest $request) {
        //
        $thumb = public_path('images/slideshow/thumb');
        $full = public_path('images/slideshow/full');
        $input = $request->except('image');
        $input['ss_status'] = $request->get('ss_status') == 'on' ? 1 : 0;
        $input['ss_order'] = Slideshow::max('ss_order') + 1;
        $cat = new Slideshow($input);
        if ($request->hasFile('ss_image')) {
            $name = str_slug($input['ss_name']) . '.' . $request->file('ss_image')->getClientOriginalExtension();
            $cat->ss_image = $name;
            Image::make($request->file('ss_image'))->save($full . '/' . $name);
            Image::make($request->file('ss_image'))->resize('484', '441')->save($thumb . '/' . $name);
        }
        if ($cat->save()) {
            return redirect()->route('backend.slideshow.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        if (!Entrust::can('slideshow-update')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Edit Slideshow';
        $this->data['slide'] = Slideshow::find($id);
        return view('backend.slideshow.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SlideshowRequest $request, $id) {
        //
        $thumb = public_path('images/slideshow/thumb');
        $full = public_path('images/slideshow/full');
        $input = $request->except('image');
        $input['ss_status'] = $request->get('ss_status') == 'on' ? 1 : 0;
        $input['ss_order'] = Slideshow::max('ss_order') + 1;
        $cat = Slideshow::find($id);
        if ($request->hasFile('ss_image')) {
            if (Storage::exists('slideshow/thumb/' . $cat->ss_image)) {
                Storage::delete('slideshow/thumb/' . $cat->ss_image);
            }
            if (Storage::exists('slideshow/full/' . $cat->ss_image)) {
                Storage::delete('slideshow/full/' . $cat->ss_image);
            }
            $name = str_slug($input['ss_name']) . '.' . $request->file('ss_image')->getClientOriginalExtension();
            $input['ss_image'] = $name;
            Image::make($request->file('ss_image'))->save($full . '/' . $name);
            Image::make($request->file('ss_image'))->resize('484', '441')->save($thumb . '/' . $name);
        }
        if ($cat->update($input)) {
            return redirect()->route('backend.slideshow.index');
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
        if (!Entrust::can('slideshow-delete')) {
            $this->data['slideshow'] = Slideshow::all();
            return view('backend.slideshow.lists', $this->data);
        }
        $slideshow = Slideshow::find($id);
        if (Storage::exists('slideshows/thumb/' . $slideshow->ss_image)) {
            Storage::delete('slideshows/thumb/' . $slideshow->ss_image);
        }
        if (Storage::exists('slideshows/full/' . $slideshow->ss_image)) {
            Storage::delete('slideshows/full/' . $slideshow->ss_image);
        }
        if ($slideshow->delete()) {
            $this->data['slideshow'] = Slideshow::all();
            return view('backend.slideshow.lists', $this->data);
        }
    }

}
