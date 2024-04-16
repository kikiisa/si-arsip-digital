<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Services\KategoriService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    private $serviceKategori;
    public function __construct()
    {
        $this->serviceKategori = new KategoriService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return response()->view("kategori.index", ["data" => $data]);
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
        
        $request->validate($this->serviceKategori->validasi());
        if($this->serviceKategori->create($request)){
            return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan');
        }
        return redirect()->route('kategori.index')->with('error', 'Data kategori gagal ditambahkan');
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
        return response()->view("kategori.edit", ["data" => Kategori::all()->where("uuid",$id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($this->serviceKategori->update($request, $id))
        {
            return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil di ubah');
        }
        return redirect()->route('kategori.index')->with('error', 'Data kategori gagal di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->serviceKategori->delete($id))
        {
            return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil di hapus');
        }
        return redirect()->route('kategori.index')->with('error', 'Data kategori gagal di hapus');
    }
}
