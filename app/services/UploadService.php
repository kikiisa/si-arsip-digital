<?php

namespace App\services;

use Illuminate\Support\Facades\File;

class UploadService
{
    public function upload($request, $path):string
    {
        $filename = $request->file("image");
        $name = $filename->hashName();
        $filename->move($path,$name);
        $final = $path."/".$name;
        return $final;
    }

    public function deleteUpdate($request,$path,$data):string
    {
        if(File::exists($data))
        {
            File::delete($data);
        }
        $filename = $request->file("image");
        $name = $filename->hashName();
        $filename->move($path,$name);
        $final = $path."/".$name;
        return $final;
    }
}