<?php 

namespace App\services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException as Valid;

class LoginService
{
    public function validasi($request)
    {
        return $request->validate([
            "username" => "required",
            "password" => "required"
        ],[
            "username.required" => "Username harus diisi",
            "password.required" => "Password harus diisi"
        ]);
    }
}