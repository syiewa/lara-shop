<?php

namespace App;

// AuthenticateUser.php 
use Illuminate\Contracts\Auth\Guard;
use Socialize;
use App\UserRepository;
use Request;
use Auth;

class AuthenticateUser {

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialize $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider) {
        if (!$request)
            return $this->getAuthorizationFirst($provider);
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider));
        $this->auth->login($user, true);
        return redirect()->route('backend.product.index');
    }

    private function getAuthorizationFirst($provider) {
        return Socialize::with($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return Socialize::with($provider)->user();
    }

}
