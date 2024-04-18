<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    CONST bulan = array([
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
    ]);
    public function index()
    {
           
        return response()->view("dashboard.index",[
            "arsip" => Arsip::all()->count(),
            "kategori" => Kategori::all()->count(),
            "admin" => User::all()->count()
        ]);
    }
}
