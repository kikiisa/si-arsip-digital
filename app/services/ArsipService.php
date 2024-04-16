<?php

namespace App\Services;

use App\Models\Arsip;
use App\services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class ArsipService 
{

    private $uploadServices;
    private $path = "data/arsip";
    public function __construct()
    {
        $this->uploadServices = new UploadService();
    }

    public function validasi($request)
    {
        return $request->validate([
            "title" => "required",
            "keterangan" => "required",
            "kategori_id" => "required",
            "status" => "required",
            "image" => "sometimes|required|mimes:pdf|max:2048",
        ],[
            "title.required" => "Judul harus diisi",
            "deskripsi.required" => "Deskripsi harus diisi",
            "kategori_id.required" => "Kategori harus diisi",
            "status.required" => "Status harus diisi",
            "image.required" => "Gambar harus diisi",
            "image.mimes" => "File harus berupa PDF",
     
            "image.max" => "File tidak boleh lebih dari 2MB"

        ]);
    }

    public function create($request)
    {
        return Arsip::create([
            "uuid" => Uuid::uuid4()->toString(),
            "title" => $request->title,
            "deskripsi" => $request->keterangan,
            "kategori_id" => $request->kategori_id,
            "user_id" =>Auth::user()->id,
            "file_pdf" => $this->uploadServices->upload($request, $this->path),
            "status" => $request->status
        ]);           

    }

    public function delete($id)
    {
        $data = Arsip::findOrFail($id);
        if(File::exists($data->file_pdf))
        {
            File::delete($data->file_pdf);
        }
        return $data->delete();
    }

    public function update($request,$id)
    {
        $data = Arsip::findOrFail($id);
        $data->update([
            "title" => $request->title,
            "deskripsi" => $request->keterangan,
            "kategori_id" => $request->kategori_id,
            "user_id" =>Auth::user()->id,
            "file_pdf" => $request->hasFile("image") ? $this->uploadServices->deleteUpdate($request, $this->path,$data->file_pdf) : $data->file_pdf,
            "status" => $request->status
        ]);
        return $data;
    }
}