<?php

namespace App\Http\Controllers\backend\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\Role;
use App\Http\Requests\backend\User\UserRequest;
use Entrust;

class UserCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->data['title'] = 'Users';
    }

    public function index() {
        //
        if (!Entrust::can('user-read')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'List User';
        $this->data['users'] = User::all();
        return view('backend.user.index', $this->data);
    }

//    public function getUser() {
//        $data = User::DtUser();
//        return response()->json($data);
////        $aaData = Product::with('category', 'image')->get();
////        return response()->json(compact('aaData'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (!Entrust::can('user-create')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Create User';
        $this->data['roles'] = Role::lists('name', 'id');
        return view('backend.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request) {
        //
        $input = $request->all();
        $input['status'] = $request->get('status') == 'on' ? 1 : 0;
        $input['password'] = bcrypt($input['password']);
        $user = new User($input);
        if ($user->save()) {
            $user->attachRole($request->get('role'));
            return redirect()->route('backend.user.index');
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
        if (!Entrust::can('user-update')) {
            return redirect('');
        }
        $this->data['sub_title'] = 'Edit User';
        $this->data['user'] = User::find($id);
        $this->data['roles'] = Role::lists('name', 'id');
        return view('backend.user.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id) {
        //
        $input = $request->all();
        $input['status'] = $request->get('status') == 'on' ? 1 : 0;
        if ($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }
        $user = User::find($id);
        if ($user->update($input)) {
            $user->roles()->sync([]);
            $user->attachRole($request->get('role'));
            return redirect()->route('backend.user.index');
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
        if (!Entrust::can('user-delete')) {
            return response()->json(['success' => FALSE]);
        }
        $user = User::find($id);
        if ($user->delete()) {
            return response()->json(['success' => TRUE]);
        }
    }

}
