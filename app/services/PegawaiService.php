<?php
namespace App\Services;
use App\Models\Pegawai;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
class PegawaiService
{

    public function validasi($request)
    {
        return $request->validate([
            'nip' => 'required|unique:pegawais',
            'name' => 'required',
            'username' => 'required|unique:pegawais',
            'email' => 'required|unique:pegawais',
            'password' => 'required|sometimes|min:8',
            'confirm' => 'required|same:password|sometimes',
            
            
        ],[
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'confirm.same' => 'Konfirmasi password tidak sama',
            'confirm.required' => 'Konfirmasi password harus diisi',
        ]);
    }

    public function validasi_update($request)
    {
        return $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'sometimes',
            'confirm' => 'sometimes|same:password',
            'status' => 'required'
            
        ],[
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'confirm.same' => 'Konfirmasi password tidak sama',
            'confirm.required' => 'Konfirmasi password harus diisi',
        ]);
    }

    public function created($request)
    {
        return Pegawai::create([
            'uuid' => Uuid::uuid4()->toString(),
            'nip' => $request->nip,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

    public function update($request,$id)
    {

        $data = Pegawai::find($id);
        return $data->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password == null ? $data->password : bcrypt($request->password),
            'status' => $request->status,
        ]);
    }
    public function delete($id)
    {
        $data = Pegawai::find($id);
        if(File::exists($data->profile))
        {
            File::delete($data->profile);
        }
        return $data->delete();
    }
}
