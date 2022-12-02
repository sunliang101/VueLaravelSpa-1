<?php

namespace App\Http\Controllers;

use App\ActionHis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActionHisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Log::debug($request);
        
        foreach ($request->all() as $v) {
            ActionHis::create($v);
        }

        return  response()->json([]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActionHis  $actionHis
     * @return \Illuminate\Http\Response
     */
    public function show(ActionHis $actionHis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActionHis  $actionHis
     * @return \Illuminate\Http\Response
     */
    public function edit(ActionHis $actionHis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActionHis  $actionHis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActionHis $actionHis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActionHis  $actionHis
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionHis $actionHis)
    {
        //
    }
}
