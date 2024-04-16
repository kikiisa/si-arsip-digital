<?php

namespace App\Services;

use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserService 
{

    public function validasi($request)
    {
        return $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ],[
            'username.required' => 'Username harus diisi',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password_confirm.same' => 'Konfirmasi password tidak sesuai',
            'password_confirm.required' => 'Konfirmasi password harus diisi',
        ]);
    }

    public function create($request)
    {
        $existingUser = User::where('username', $request->username)->first();
        // Jika username sudah terpakai, kembalikan false
        if($existingUser) {
            return false;
        }
        return User::create([
            "uuid" => Uuid::uuid4()->toString(),
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }




}