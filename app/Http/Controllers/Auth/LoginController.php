<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/';

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
        $avatar = explode('?',$user->avatar);
        $userDetails = [
            'email'         => $user->email,
            'name'          => $user->name,
            'token'         => $user->token,
            'fullname'      => $user->name,
            'image'         => @$avatar[0],
            'service_api'   => 'twitter'
        ];
        return $this->handleProviderOAuth($userDetails);
    }
    public function  handleProviderTwitterCallback(){
        $user = Socialite::driver('twitter')->user() ;
        $userDetails = [
            'email'         => $user->email,
            'name'          => $user->nickname,
            'token'         => $user->tokenSecret,
            'fullname'      => $user->name,
            'image'         => $user->avatar,
            'service_api'   => 'twitter'
        ];
        return $this->handleProviderOAuth($userDetails);
    }
    public function  handleProviderGoogleCallback(){
        $user = Socialite::driver('google')->user() ;
        $userDetails = [
            'email'         => $user->email,
            'name'          => $user->user['name']['givenName'],
            'token'         => $user->token,
            'fullname'      => $user->user['name']['givenName'].' '.$user->user['name']['familyName'],
            'image'         => $user->avatar_original,
            'service_api'   => 'google'
        ];
        return $this->handleProviderOAuth($userDetails);
    }
    protected function handleProviderOAuth($data = []){
        if (!empty($data)){
            $user = User::where('email', @$data['email'])->first() ;//Searching a user with this email
            if(!$user){//If user doesnt exist we create it
                $user = User::create($data);
            }
            Auth::login($user, true);
        }
        return redirect()->to('/');
    }
}
