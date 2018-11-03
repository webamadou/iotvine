<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Resources\ContestsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ContestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        // Get contest paginated
        $contests   = Contest::orderBy('created_at', 'desc')->paginate(6);

        return view('contests/index', compact('contests'));
    }

    public function create(){
        $user = Auth::user()->id;
        return view();
    }

    public function store(Request $request){
        //
    }

    public function show(Contest $contest) {
        //
    }

    public function edit($slug) {
        $contest = Contest::where('slug',$slug)->first();
        return view('contests.update', compact('contest'));
    }

    public function editPageTwo($slug){
        $contest = Contest::where('slug', $slug)->first();
        return view('contests.pageTwo', compact('contest'));
    }

    public function update(Request $request, Contest $contest) {
        //
    }

    public function updatePageOne(Request $request) {
        $contest = Contest::find($request->id);
        if ($request->input('step') === 'one'){
            $this->validate($request, [
                'name'  => 'required',
                'start' => 'required',
                'end'   => 'required'
            ]);
            $contest->name          = $request->input('name');
            $contest->start         = $request->input('start');
            $contest->end           = $request->input('end');
            $contest->description   = $request->input('description');
        }
        //return response()->json(['success'=>'Got Simple Ajax Request.','request'=>$contest->description]);
        if ($contest->save()) {
            return ['response' => 'SUCCESS','data' => $contest];
        } else {
            return ['response' => 'ERROR'];
        }
    }

    public function destroy(Contest $contest) {
        //
    }
}
