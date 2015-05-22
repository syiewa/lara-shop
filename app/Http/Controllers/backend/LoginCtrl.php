<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Http\Requests\backend\LoginRequest;
use App\AuthenticateUser;
use Request,
    Auth,
    Exception,
    Entrust,
    Socialize;

class LoginCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        if(Auth::check()){
            if(Entrust::can(['backend'])){
                return redirect()->route('admin.product.index');
            }
        }
    }

    public function index() {
        //
        return view('backend.login');
    }

    public function doLogin(LoginRequest $request) {
        $message = '';
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $check = User::where('email', '=', $email)->get();
        try {
            if (!count($check) > 0) {
                throw new Exception("Email Tidak Terdaftar");
            }
            if (!Auth::validate(['email' => $email, 'password' => $password, 'status' => 1])) {
                throw new Exception("Email atau Password Salah");
            } elseif ($remember) {
                if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1, $remember])) {
                    return redirect('backend/product');
                }
            } else {
                if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
                    return redirect('backend/product');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect('login')->withInput()->withErrors(['message' => $message]);
    }

    public function redirect($provider) {
        return Socialize::with($provider)->redirect();
    }

    // to get authenticate user data
    public function account($provider) {
        $user = Socialize::with($provider)->user();
        // Do your stuff with user data.
        print_r($user);
        die;
    }

    public function auth(AuthenticateUser $authenticateUser, $provider = null) {
        return $authenticateUser->execute(Request::all(), $this, $provider);
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
    public function store() {
        //
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
    }

}
