<?php

namespace App\Http\Controllers\backend\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Role;
use App\Models\Users\Permission;
use Request;
use App\Http\Requests\backend\User\RoleRequest;

class RoleCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->data['title'] = 'Roles';
    }

    public function index() {
        //
        $this->data['sub_title'] = 'List Role';
        $this->data['roles'] = Role::all();
        return view('backend.user.roles.index', $this->data);
    }

    public function getPerm() {
        $this->data['modul'] = ['page', 'product', 'slideshow', 'category', 'user'];
        $this->data['roles'] = Role::all();
        return view('backend.user.permissions.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $this->data['sub_title'] = 'Create Role';
        return view('backend.user.roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RoleRequest $request) {
        //
        $role = new Role();
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        if ($role->save()) {
            return redirect()->route('backend.user.index');
        }
    }

    public function storePerm() {
        $input = Request::except('_token');
        if (count($input) > 0) {
            foreach ($input as $key => $val) {
                $role = Role::where('name', '=', $key)->first();
                $role->perms()->sync([]);
                foreach ($val as $name) {
                    $checkperm = Permission::where('name', '=', $name)->first();
                    if (count($checkperm) > 0) {
                        $role->attachPermission($checkperm);
                    } else {
                        $perm = new Permission();
                        $perm->name = $name;
                        $perm->save();
                        $role->attachPermission($perm);
                    }
                }
            }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $this->data['sub_title'] = 'Edit Role';
        $this->data['role'] = Role::find($id);
        return view('backend.user.roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(RoleRequest $request, $id) {
        //
        $role = Role::find($id);
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        if ($role->update()) {
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
        $role = Role::find($id);
        if ($role->delete()) {
            return response()->json(['success' => TRUE]);
        }
    }

}
