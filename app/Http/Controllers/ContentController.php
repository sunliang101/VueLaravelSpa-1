<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    //
    public function index(Request $request)
    {
        $r = [];
        Log::debug("12");
        Log::debug($request["q"]);

        $l = $request["q"];
        $cs = Content::all();
        foreach ($cs as $c) {
            $wkary = json_decode($c["vue"], true);
            $wkary["idreal"] =  $c["id"];

            if (isset($l)) {
                if (isset($wkary["lvl"]) && strstr($l, strval($wkary["lvl"])) !== false) {
                    $r[] = $wkary;
                }
            } else {
                $r[] = $wkary;
            }

        }


        return  response()->json($r);
    }

    public function index2(Request $request)
    {
        $r = [];
        Log::debug($request);
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
