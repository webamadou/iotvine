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
        $this->middleware('auth',['except' => 'contest_public']);
    }

    public function index(){
        $user = Auth::user() ;
        $contests   = Contest::where(['user_id'=>2,'status'=>1])
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return view('home', compact('contests'));
    }

    public function create() {
        $user       = Auth::user();
        $contest    = new Contest();
        return view('contests.create', compact('contest', 'user'));
    }
    public function contest_public($slug){
        //$this->authorize('contest_public');
        $contest = Contest::where('slug',$slug)->first();
        return view('contests.contest_public', compact('contest'));
    }
    public function store(Request $request){
        //
    }

    public function show($slug) {
        $contest = Contest::where('slug',$slug)->first();
        return view('contests.show', compact('contest'));
    }

    public function edit($slug) {
        $contest = Contest::where('slug',$slug)->first();
        return view('contests.update', compact('contest'));
    }

    public function editPageTwo($slug){
        $contest    = Contest::where('slug', $slug)->with('entries')->first();
        $networks   = Network::where('status',1)->with('entries')->get();
        return view('contests.pageTwo', compact('contest','networks'));
    }

    public function editPageThree($slug){
        $user       = Auth::user();
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
            'start' => 'required|date_format:Y-m-d',
            'end'   => 'required|date_format:Y-m-d',
            'images' => 'nullable|image'
        ]);
        $contest->name          = $request->input('name');
        $contest->start         = $request->input('start');
        $contest->end           = $request->input('end');
        $contest->description   = $request->input('description');
        $contest->user_id       = Auth::user()->id;

        if ($request->hasFile('images')){
            $contest->images    = $request->images->store('public/images/contests');
        }
        if ($contest->save()) {
            return ['response' => 'SUCCESS','data' => $contest];
        } else {
            return ['response' => 'ERROR'];
        }
    }

    /**
     * This method will help save a contest. It will receive the data from the first form. It will be used to save or update the data
     * @param Request $request
     * @return array
     */
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
        } else {
            return ['response' => 'ERROR', 'message' => [__('No entry were selected. You need to define at least an entry')]];
        }
        return ['response' => 'ERROR', 'message' => $contest->error];
    }

    /**
     * This method will save the second form of the contest saving.
     * @param Request $request
     * @return array
     */
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

    /**
     * This method delete a contest
     * @param $id
     * @return ArticleResource
     */
    public function destroy($id) {
        $contest = Contest::findOrFail($id);

        if($contest->delete()) {
            return redirect()->route('home');
        }
    }

    public function fileUpload(){
        return view('contests.uploadfile');
    }
    public function fileUploadPost(Request $request){
        $request->validate([
            'file' => 'image',
        ]);
        $path = $request->file->store('images/contests');
        dd($path);
        $request->file->store('logos');
        /*$fileName = time().'.'.request()->file->getClientOriginalExtension();
        request()->file->move(public_path('files'),$fileName);*/
        return response()->json(['success' => 'You have successfully uploadfile']);
    }
}