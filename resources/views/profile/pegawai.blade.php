@extends('layouts.master', ['title' => 'Edit Pegawai'])
@section('content')
    <div class="page-heading">
        <h3>Edit Pegawai</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('management-pegawai.update',$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="mb-2" for="exampleFormControlInput1">Nip</label>
                                    <input type="text"  class="form-control" value="{{ $data->nip }}" id="exampleFormControlInput1" placeholder="Nip " name="nip">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="mb-2" for="exampleFormControlInput2">Username</label>
                                    <input type="text"  class="form-control" value="{{ $data->username }}" id="exampleFormControlInput2" placeholder="Username" name="username">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="mb-2" for="exampleFormControlInput3">Nama Pegawai</label>
                                    <input type="text"  class="form-control" value="{{ $data->name }}" id="exampleFormControlInput3" placeholder="Nama" name="name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="mb-2" for="exampleFormControlInput4">Email</label>
                                    <input type="text"  class="form-control" value="{{ $data->email }}" id="exampleFormControlInput4" placeholder="Email " name="email">
                                </div>
                                
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput2">Password</label>
                                    <input type="password"  class="form-control"  id="exampleFormControlInput3" placeholder="password " name="password">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput2">Konfirmasi Password</label>
                                    <input type="password"  class="form-control"  id="exampleFormControlInput3" placeholder="Konfirmasi Password " name="confirm">
                                </div>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
@endsection
