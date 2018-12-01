<?php

namespace App\Http\Controllers;

use App\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $prize = Prize::find($request->id)==null? new Prize():Contest::find($request->id);

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required'
        ]);
        $prize->name = $request->input('name');
        $prize->description = $request->input('description');
        $prize->type = $request->input('type');
        $prize->prize_value = $request->input('prize_value');
        $prize->currency_id = $request->input('currency_id');
        $prize->user_id = $request->input('user_id');
        if ($prize->save()){
            return ['response' => 'SUCCESS', 'data' => $prize];
        } else {
            return ['response' => 'ERROR', 'message' => $prize->error];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize){
        //
    }
}
