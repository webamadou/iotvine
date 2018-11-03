<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // Get contest paginated
        $user_id    = Auth::user()->id;
        $contests   = Contest::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(6);

        return view('home', compact('contests'));
    }
}
