<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    //
    public function index()
    {


        $r = [];

        $cs = Content::all();
        foreach ($cs as $c) {
            $wkary = json_decode($c["vue"], true);
            $wkary["idreal"] =  $c["id"];
            $r[] = $wkary;
        }

        return  response()->json($r);
    }

    public function update(Request $request, Content $Content)
    {

        Log::debug($request);

        $wkary = json_decode($Content["vue"], true);
        $wkary["lvl"] = $request["lvl"];

        $s = [];
        $s["vue"] = json_encode($wkary);


        $Content->update( $s);

        return $Content;
    }

}
