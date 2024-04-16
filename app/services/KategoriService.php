<?php

namespace App\Services;

use App\Models\Arsip;
use App\Models\Kategori;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class KategoriService
{
    public function validasi()
    {
        return [
            'name' => 'required'
        ];
    }
    public function create($request)
    {
        
        return Kategori::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
    }

    public function delete($id)
    {      
        Arsip::where("kategori_id",$id)->update([
            "kategori_id" => 3
        ]); 
        return Kategori::find($id)->delete();
    }

    public function update($request, $id)
    {
        return Kategori::find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        
    }
}