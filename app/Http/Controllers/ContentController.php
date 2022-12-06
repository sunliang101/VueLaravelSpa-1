<?php

namespace App\Http\Controllers;

use App\ActionHis;
use App\Content;
use App\UpdHis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LengthException;
use SebastianBergmann\Environment\Console;

class ContentController extends Controller
{
    //
    public function index(Request $request)
    {
        $r = [];
        Log::debug("12");
        Log::debug($request["q"]);

        $l = $request["q"];
        $para = explode(" ", $l);
        

        $paraAry = [];
        foreach ($para as $p) {

            $pary =  explode(":", $p);
            if  (count($pary) !== 2) {
                continue;
            }
            $k = trim($pary[0]);
            $v = trim($pary[1]);
            switch ($k) {
                case "c":
                    $k = "category";
                    break;
                case "l":
                    $k = "lvl";
                    break;
            }
            $paraAry[$k] = $v;
        }
        Log::debug("<><><>");
        Log::debug($paraAry);

        $category = isset($paraAry["category"]) ? $paraAry["category"]: "";
        $days = isset($paraAry["d"]) ? $paraAry["d"]: "";
        $cs =[];

        if (isset($days)) {

            $cSrch = ActionHis::Where('updated_at', '>=', date("Y-m-d",strtotime("-" . $days . " day")))->get();
           
            foreach ($cSrch as $c) {
                $cs[]=$c->content;
            }
            $cs = array_unique($cs);
        } else {
            //　検索条件
            $cs = Content::when($category, function ($query, $category) {
                return $query->where('category', $category);
            })->get();
        }

        //　検索語の絞り込み
        foreach ($cs as $c) {
            $wkary = json_decode($c["vue"], true);
            $wkary["idreal"] =  $c["id"];
            if (Empty($wkary["lvl"])) {
                $wkary["lvl"] = 3;
            }

            if (isset($paraAry["lvl"])) {
                if (isset($wkary["lvl"]) && strstr($paraAry["lvl"], strval($wkary["lvl"])) !== false) {
                    $r[] = $wkary;
                }
            } else {
                $r[] = $wkary;
            }
        }

        //　ページの範囲
        if ( isset($paraAry["p"])) {
            $from = 0;
            $from  =  explode(",", $paraAry["p"])[0]-1;
            $getCnt  = isset(explode(",", $paraAry["p"])[1]) ? explode(",", $paraAry["p"])[1]:count($r) - $from;
            if ($from >0) {
                $r = array_slice($r, $from, $getCnt);
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

        $before = $Content["vue"];
        $wkary = json_decode($Content["vue"], true);
        $wkary["lvl"] = $request["lvl"];

        $s = [];
        $s["vue"] = json_encode($wkary);
        $after = $s["vue"] ;

        $Content->update( $s);

        UpdHis::create(
            [
                "uid"=>"sun",
                "target"=>"Content",
            "logickey"=>$Content["id"],
            "before"=>$before,
            "after"=>$after, 
            "ext"=>'', 
                    
            ]

        );

        return $Content;
    }

}
