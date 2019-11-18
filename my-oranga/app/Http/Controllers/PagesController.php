<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PagesController extends Controller
{

    public function results()
    {
        $activity_type = DB::table('activities')->select('type', DB::raw('COUNT(type) AS occurrences'))
        ->groupBy('type')
        ->orderBy('occurrences', 'DESC')
        ->limit(5)
        ->get();
        $activity_type_array[] = ['type', 'occurrences'];
        foreach($activity_type as $key => $value)
        {
            $activity_type_array[++$key] = [$value->type, $value->occurrences];
        }

        return view('results')->with('activity_type', json_encode($activity_type_array));
    }
}
