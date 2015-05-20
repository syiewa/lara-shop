<?php

namespace App\Http\Controllers\backend\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use App\Http\Requests\backend\Products\CategoryRequest;
use Illuminate\Support\Str;
use Storage,Request,Image,Entrust;

class CategoryCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->data['title'] = 'Category';
    }

    public function getCat() {
        if (Request::isMethod('post')) {
            //
            $data = Request::get('data');
            foreach ($data as $key => $val) {
                $page = Category::find($val['id']);
                $page->order = $key;
                !isset($val['children']) ? $page->parent = 0 : '';
                $page->save();
                if (isset($val['children'])) {
                    foreach ($val['children'] as $childkey => $childval) {
                        $child = Category::find($childval['id']);
                        $child->slug = str_slug($page->name) . '/' . str_slug($child->name);
                        $child->parent = $val['id'];
                        $child->order = $childkey;
                        $child->save();
                    }
                }
            }
        }
        $this->data['category'] = Category::getNested();
        return view('backend.category.lists', $this->data);
    }

    public function index() {
        //
        if (!Entrust::can('category-read')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'List Category';
        return view('backend.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (!Entrust::can('category-create')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Create Category';
        $this->data['parent'] = Category::where('parent', '=', 0)->lists('name', 'id');
        return view('backend.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CategoryRequest $request) {
        //
        $thumb = public_path('images/categories/thumb');
        $full = public_path('images/categories/full');
        $input = $request->except('image');
        $input['status'] = $request->get('status') == 'on' ? 1 : 0;
        if ($request->get('parent')) {
            $parent_slug = Category::find($input['parent'])->slug;
            $input['slug'] = $parent_slug . '/' . str_slug($input['name']);
        } else {
            $input['slug'] = str_slug($input['name']);
        }
        $input['order'] = Category::max('order') + 1;
        $cat = new Category($input);
        if ($request->hasFile('image')) {
            $name = $input['slug'] . '.' . $request->file('image')->getClientOriginalExtension();
            $cat->image = $name;
            Image::make($request->file('image'))->save($full . '/' . $name);
            Image::make($request->file('image'))->resize('200', '200')->save($thumb . '/' . $name);
        }
        if ($cat->save()) {
            return redirect()->route('backend.category.index');
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
        if (!Entrust::can('category-update')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Edit Category';
        $this->data['category'] = Category::find($id);
        $this->data['parent'] = Category::where('id', '!=', $id)->where('parent', '=', 0)->lists('name', 'id');
        return view('backend.category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id) {
        //
        $thumb = public_path('images/categories/thumb');
        $full = public_path('images/categories/full');
        $input = $request->all();
        $input['status'] = $request->get('status') == 'on' ? 1 : 0;
        if ($request->get('parent')) {
            $parent_slug = Category::find($input['parent'])->slug;
            $input['slug'] = $parent_slug . '/' . str_slug($input['name']);
        } else {
            $input['slug'] = str_slug($input['name']);
        }
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            if (Storage::exists('categories/thumb/' . $category->image)) {
                Storage::delete('categories/thumb/' . $category->image);
            }
            if (Storage::exists('categories/full/' . $category->image)) {
                Storage::delete('categories/full/' . $category->image);
            }
            $name = $input['slug'] . '.' . $request->file('image')->getClientOriginalExtension();
            $input['image'] = $name;
            Image::make($request->file('image'))->save($full . '/' . $name);
            Image::make($request->file('image'))->resize('200', '200')->save($thumb . '/' . $name);
        }
        $category->update($input);
        return redirect()->route('backend.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        if (!Entrust::can('category-delete')) {
            $this->data['category'] = Category::getNested();
            return view('backend.category.lists', $this->data);
        }
        $category = Category::find($id);
        if ($category->delete()) {
            $category->where('parent', $id)->update(['parent' => 0]);
            $this->data['category'] = Category::getNested();
            return view('backend.category.lists', $this->data);
        }
    }

}
