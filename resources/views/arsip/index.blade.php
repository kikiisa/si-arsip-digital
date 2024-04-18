@extends('layouts.master',["title" => "Arsip | Manajement Arsip"])
@section('content')
    <div class="page-heading">
        <h3>Managament Arsip</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        @if (Auth::check())
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#default">
                                <i class="bi bi-plus"></i> Tambah Arsip
                            </button>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Status Arsip</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{$loop->index+=1}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->kategori->name}}</td>
                                        <td>
                                            @if ($item->status == "active")
                                                <span class="badge bg-success">Publish</span>
                                            @else
                                                <span class="badge bg-danger">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <form action="{{ Route('management-arsip.destroy', $item->id) }}" method="post">
                                                @method("DELETE")
                                                @csrf
                                                @if (Auth::check())
                                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    <a href="{{Route("management-arsip.edit",$item->uuid)}}" class="btn btn-warning"><i class="bi bi-pen"></i></a>    
                                                @endif
                                                <a href="{{Route("management-arsip.show",$item->uuid)}}" class="btn btn-info"><i class="bi bi-display"></i></a>
                                            </form>
                                        </td>
                                    </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                <form action="{{ Route('management-arsip.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-12 col-12 col-md-6">
                            <div class="form-group">
                                 <label class="mb-2" for="exampleFormControlInput1">Nama File</label>
                                 <input type="text"  class="form-control" value="{{ old('name') }}" id="exampleFormControlInput1" placeholder="Nama File" name="title">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput2">Kategori</label>
                                <select name="kategori_id" id="exampleFormControlInput2" class="form-control">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput3">Keterangan</label>
                                <textarea name="keterangan" id="exampleFormControlInput3" placeholder="Keterangan" name="keterangan" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput4">File PDF</label>
                                <br>
                                <input type="file" name="image" id="exampleFormControlInput4" class="form-contorl">
                            </div>
                            <div class="form-group">
                                <label class="mb-2" for="exampleFormControlInput5">Status Arsip</label>
                                <select name="status" id="exampleFormControlInput5" class="form-control">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="active">Publish</option>
                                    <option value="inactive">Draft</option>
                                </select>
                            </div>
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
