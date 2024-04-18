<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCountArsipByYear()
    {
        $arsip = Arsip::select("id","created_at")->whereYear("created_at",Carbon::now()->year)->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->format("m");
        });
        $usermcount = [];
        $userArr = [];
    
        foreach ($arsip as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
    
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i]['count'] = $usermcount[$i];
            } else {
                $userArr[$i]['count'] = 0;
            }
            $userArr[$i]['month'] = $month[$i - 1];
        }
        return response()->json(array_values($userArr));
    }

}
