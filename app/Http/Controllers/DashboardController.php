<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        return response()->view("dashboard.index",[
            "arsip" => Arsip::all()->count(),
            "kategori" => Kategori::all()->count(),
            "admin" => User::all()->count()
        ]);
    }
}
