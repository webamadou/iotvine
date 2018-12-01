<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Currency;
use App\Entry;
use App\Http\Resources\ContestsResource;
use App\Network;
use App\Prize;
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
        $user_id = Auth::user()->id ;
        $contests   = Contest::where(['user_id'=>$user_id,'status'=>1])
                                ->orderBy('created_at', 'desc')
                                ->paginate(6);
        return view('home', compact('contests'));
    }

    public function create() {
        $user       = Auth::user();
        $contest    = new Contest();
        return view('contests.create', compact('contest', 'user'));
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
        $contest    = Contest::where('slug', $slug)->with('entries')->first();
        $networks   = Network::where('status',1)->get();
        return view('contests.pageTwo', compact('contest','networks'));
    }

    public function editPageThree($slug){
        $user    = Auth::user();
        $contest    = Contest::where('slug', $slug)->with('entries')->first();
        $prizes     = Prize::where('user_id',$user->id)->get();
        //dd($contest->entries->contains(1),@$prizes[0]->contests[0]->pivot->quantity);
        $currencies = Currency::where('status',1)->pluck('name','id');
        return view('contests.pageThree', compact('contest','prizes','currencies','user'));
    }

    public function update(Request $request, Contest $contest) {
        //
    }

    public function updatePageOne(Request $request) {
        $contest = Contest::find($request->id)==null? new Contest():Contest::find($request->id);

        $this->validate($request, [
            'name'  => 'required',
            'start' => 'required',
            'end'   => 'required'
        ]);
        $contest->name          = $request->input('name');
        $contest->start         = $request->input('start');
        $contest->end           = $request->input('end');
        $contest->description   = $request->input('description');
        $contest->user_id       = Auth::user()->id;

        if ($contest->save()) {
            return ['response' => 'SUCCESS','data' => $contest];
        } else {
            return ['response' => 'ERROR'];
        }
    }

    public function updatePageTwo(Request $request){
        $synchronises = [];
        $contest = Contest::findOrFail($request->input('id'));
        $entries = $request->input('entry') ;
        if (!empty($entries)){
            foreach ($entries as $id){
                $synchronises[$id] = [
                                        'entry_link' => $request->input('entry_'.$id.'_link'),
                                        'description' => $request->input('entry_'.$id.'_description'),
                                        'point_per_entry' => $request->input('entry_'.$id.'_point_per_entry'),
                                        'configs' => $request->input('entry_'.$id.'_config'),
                                     ];
            }
            $saving = $contest->entries()->sync($synchronises);
            if($saving){
                return ['response' => 'SUCCESS','data' => $contest];
            }
        }
        return ['response' => 'ERROR', 'message' => $contest->error];
    }

    public function updatePageThree(Request $request){
        $errors     = [];
        $contest    = Contest::findOrFail($request->input('id'));
        $prizes     = $request->input('prizes');
        if (!empty($prizes)){
            $sync_prize = [];
            foreach ($prizes as $prize){$sync_prize[$prize] = ['quantity' => 1,'status' => 1];}
            if($contest->prizes()->sync($sync_prize)) {
                return ['response' => 'SUCCESS', 'data' => $contest];
            } else {
                return ['response' => 'ERROR', 'message' => $contest->error];
            }
        } else {
            $errors[] = 'You have to pick one prize at least';
            return ['response' => 'ERROR', 'messages' => $errors];
        }
    }

    public function destroy(Contest $contest) {
        //
    }
}
