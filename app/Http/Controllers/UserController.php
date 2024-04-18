<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userServices;
    public function __construct()
    {
        $this->userServices = new UserService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view("user.index",["data" => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->userServices->validasi($request);
        if($this->userServices->create($request))
        {
            return redirect()->route("management-admin.index")->with("success", "Data user berhasil ditambahkan");
        }
        return redirect()->route("management-admin.index")->with("error", "Data user gagal ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->view("user.edit",[
            "data" => User::all()->where("uuid",$id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->userServices->updateValidasi($request);
        if($this->userServices->update($request,$id))
        {
            return redirect()->back()->with("success", "Data user berhasil di Update");
        }
        return redirect()->back()->with("error", "Data user gagal di Update");
    }

    public function profile()
    {
        if(Auth::check())
        {
            $data = User::findOrFail(Auth::user()->id);
            return response()->view("profile.operator",["data" => $data]);
        }else{
            $data = Pegawai::findOrFail(Auth::guard("pegawais")->user()->id);
            return response()->view("profile.pegawai",["data" => $data]);
        }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->userServices->delete($id))
        {
            return redirect()->route("management-admin.index")->with("success", "Data user berhasil di hapus");
        }
        return redirect()->route("management-admin.index")->with("error", "Data user gagal di hapus");
    }
}
