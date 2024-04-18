<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Services\PegawaiService;
class PegawaiController extends Controller
{
    private $servicePegawai;
    public function __construct()
    {
        $this->servicePegawai = new PegawaiService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view("pegawai.index",["data" => Pegawai::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->servicePegawai->validasi($request);
        if($this->servicePegawai->created($request)){
            return redirect()->route('management-pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
        }
        return redirect()->route('management-pegawai.index')->with('error', 'Data pegawai gagal ditambahkan');
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
        return response()->view("pegawai.edit", ["data" => Pegawai::all()->where("uuid",$id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->servicePegawai->update($request, $id);
        $this->servicePegawai->validasi_update($request);
        if($this->servicePegawai->update($request,$id))
        {
            return redirect()->back()->with('success', 'Data pegawai berhasil di ubah');
        }
        return redirect()->back()->with('error', 'Data pegawai gagal di ubah');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->servicePegawai->delete($id))
        {
            return redirect()->route('management-pegawai.index')->with('success', 'Data pegawai berhasil di hapus');
        }
        return redirect()->route('management-pegawai.index')->with('error', 'Data pegawai gagal di hapus');
    }
}
