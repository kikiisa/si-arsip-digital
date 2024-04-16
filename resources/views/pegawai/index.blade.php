@extends('layouts.master', ['title' => 'Management Pegawai'])
@section('content')
    <div class="page-heading">
        <h3>Management Pegawai</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#default">
                            <i class="bi bi-plus"></i> Tambah Pegawai
                        </button>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Email</th>
                                        <th>Status Pegawai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{$loop->index+=1}}</td>
                                        <td>{{$item->nip}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ Route('management-pegawai.destroy', $item->id) }}" method="post">
                                                @method("DELETE")
                                                @csrf
                                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                <a href="{{Route("management-pegawai.edit",$item->uuid)}}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ Route('management-pegawai.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput1">Nip</label>
                                <input type="text"  class="form-control" value="{{ old('nip') }}" id="exampleFormControlInput1" placeholder="Nip " name="nip">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput1">Username</label>
                                <input type="text"  class="form-control" value="{{ old('username') }}" id="exampleFormControlInput1" placeholder="Username" name="username">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput2">Nama Pegawai</label>
                                <input type="text"  class="form-control" value="{{ old('name') }}" id="exampleFormControlInput2" placeholder="Nama" name="name">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput2">Email</label>
                                <input type="text"  class="form-control" value="{{ old('email') }}" id="exampleFormControlInput3" placeholder="Email " name="email">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput2">Password</label>
                                <input type="password"  class="form-control" value="{{ old('password') }}" id="exampleFormControlInput3" placeholder="password " name="password">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput2">Konfirmasi Password</label>
                                <input type="password"  class="form-control" value="{{ old('confirm') }}" id="exampleFormControlInput3" placeholder="Konfirmasi Password " name="confirm">
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
