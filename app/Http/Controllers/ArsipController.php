<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Services\ArsipService;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    private $arsipServices;

    public function __construct()
    {
        $this->arsipServices = new ArsipService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view("arsip.index",
        [
            "data" => Arsip::with("user","kategori")->get(),
            "kategori" => Kategori::all()
            
        ]);
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
        $this->arsipServices->validasi($request);
        
        if($this->arsipServices->create($request))
        {
            return redirect()->route("management-arsip.index")->with("success", "Data arsip berhasil ditambahkan");
        }
        return redirect()->route("management-arsip.index")->with("error", "Data arsip gagal ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->view("arsip.detail", [
            "data" => Arsip::with("user","kategori")->where("uuid",$id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->view("arsip.edit", [
            "data" => Arsip::all()->where("uuid",$id)->first(),
            "kategori" => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->arsipServices->validasi($request);
        if($this->arsipServices->update($request,$id))
        {
            return redirect()->route("management-arsip.index")->with("success", "Data arsip berhasil diubah");
        }
        return redirect()->route("management-arsip.index")->with("error", "Data arsip gagal diubah");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->arsipServices->delete($id))
        {
            return redirect()->route("management-arsip.index")->with("success", "Data arsip berhasil dihapus");
        }
        return redirect()->route("management-arsip.index")->with("error", "Data arsip gagal dihapus");
    }
}
