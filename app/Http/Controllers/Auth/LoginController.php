<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider(){
        return Socialite::driver('facebook')->redirect();
    }
    public function redirectToTwitterProvider(){
        return Socialite::driver('twitter')->redirect();
    }
    public function redirectToGoogleProvider(){
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return void
     */
    public function handleProviderFacebookCallback(){
        $user = Socialite::driver('facebook')->user(); // Fetch authenticated user
        dd($user);
    }
    public function  handleProviderTwitterCallback(){
        $user = Socialite::driver('twitter')->user() ;
        dd($user) ;
    }
    public function  handleProviderGoogleCallback(){
        $user = Socialite::driver('google')->user() ;
        //$accessTokenResponseBody = $user->accessTokenResponseBody;
        dd($user) ;
    }
}
