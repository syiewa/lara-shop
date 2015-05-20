<?php

namespace App\Http\Controllers\backend\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\Page\PageRequest;
use App\Models\Page\Page;
use DB,Request,Entrust;

class PageCtrl extends Controller {

    public function __construct() {
        $this->data['title'] = 'Pages';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        if (!Entrust::can('page-read')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Page List';
        return view('backend.page.index', $this->data);
    }

    public function getPage($position = '') {
        if (Request::isMethod('post')) {
            //
            $data = Request::get('data');
            $position = Request::get('position');
            foreach ($data as $key => $val) {
                $page = Page::find($val['id']);
                $page->page_order = $key;
                !isset($val['children']) ? $page->page_parent = 0 : '';
                $page->save();
                if (isset($val['children'])) {
                    foreach ($val['children'] as $childkey => $childval) {
                        $child = Page::find($childval['id']);
                        $child->page_parent = $val['id'];
                        $child->page_order = $childkey;
                        $child->save();
                    }
                }
            }
            return response()->json(['success' => TRUE]);
        }
        $this->data['pages'] = Page::getNested($position);
        return view('backend.page.lists', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (!Entrust::can('page-create')) {
            return redirect('');
        }
        $this->data['sub_title'] = "Create " . ucfirst(Request::get('position')) . " Page";
        $this->data['position'] = Request::get('position');
        $this->data['parent'] = Page::where('page_position', Request::get('position'))
                ->where('page_parent', '=', 0)
                ->lists('page_name', 'id');
        return view('backend.page.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PageRequest $request) {
        //
        $input = $request->all();
        $input['page_status'] = $request->get('page_status') == 'on' ? 1 : 0;
        $page = new Page($input);
        if ($page->save()) {
            return redirect()->route('backend.page.index');
        };
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
        if (!Entrust::can('page-update')) {
            return redirect('');
        }
        $this->data['sub_title'] = "Edit " . ucfirst(Request::get('position')) . " Page";
        $this->data['position'] = Request::get('position');
        $this->data['page'] = Page::find($id);
        $this->data['parent'] = Page::where('id', '!=', $id)->where('page_position', Request::get('position'))
                ->where('page_parent', '=', 0)
                ->lists('page_name', 'id');
        return view('backend.page.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PageRequest $request, $id) {
        //
        $input = $request->all();
        $input['page_status'] = $request->get('page_status') == 'on' ? 1 : 0;
        $page = Page::find($id);
        if ($page->update($input)) {
            return redirect()->route('backend.page.index');
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
        if (!Entrust::can('page-delete')) {
            return response()->json(['success' => FALSE]);
        }
        $page = Page::find($id);
        if ($page->delete()) {
            $page->where('page_parent', $id)->update(['page_parent' => 0]);
            return response()->json(['success' => TRUE]);
        }
    }

}
