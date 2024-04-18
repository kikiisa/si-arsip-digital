@extends('layouts.master', ['title' => 'Edit Admin'])
@section('content')
    <div class="page-heading">
        <h3>Edit Admin</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('management-admin.update',$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput1">Username</label>
                                    <input type="text"  class="form-control" value="{{ $data->username }}" id="exampleFormControlInput1" placeholder="Username" name="username">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput2">Nama Lengkap</label>
                                    <input type="text"  class="form-control" value="{{ $data->name }}" id="exampleFormControlInput2" placeholder="Nama" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput3">Email</label>
                                    <input type="text"  class="form-control" value="{{ $data->email }}" id="exampleFormControlInput3" placeholder="Email " name="email">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput4">Password</label>
                                    <input type="password"  class="form-control" id="exampleFormControlInput4" placeholder="password " name="password">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2" for="exampleFormControlInput5">Konfirmasi Password</label>
                                    <input type="password"  class="form-control"  id="exampleFormControlInput5" placeholder="Konfirmasi Password " name="password_confirm">
                                </div>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
   
@endsection
