<?php

namespace App\Http\Controllers;

use App\services\LoginService;
use FFI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as Valid;
use PhpParser\Node\Expr\FuncCall;

class LoginController extends Controller
{
    private $loginServices;
    public function __construct()
    {
        $this->loginServices = new LoginService();
    }
    public function index()
    {
        return response()->view("auth.login");
    }

    public function store(Request $request)
    {
        $this->loginServices->validasi($request);
        $credential = $request->only("username","password");
        if(Auth::attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->route("account.dashboard")->with("success", "Selamat datang ".Auth::user()->name);
        }elseif(Auth::guard("pegawais")->attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->route("account.dashboard")->with("success", "Selamat datang ".Auth::guard("pegawais")->user()->name);
        }
        throw Valid::withMessages(['message' => 'Maaf Email dan Password anda tidak terdaftar']);   
    }

    public function logout()
    {
        if(Auth::guard("pegawais")->check()){
            Auth::guard("pegawais")->logout();
            return redirect()->route("account.login")->with("success","Anda Telah Logout");
        }
        if(Auth::check()){
            Auth::logout();
            return redirect()->route("account.login")->with("success","Anda Telah Logout");
        }
        return redirect()->route("account.login")->with("success","Anda Telah Logout");
    }
}
