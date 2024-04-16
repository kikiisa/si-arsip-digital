@extends('layouts.master', ['title' => 'Management Kategori'])
@section('content')
    <div class="page-heading">
        <h3>Management Kategori</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#default">
                            <i class="bi bi-plus"></i> Tambah Kategori
                        </button>
                        
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        @if ($item->name != "default")
                                            <tr>
                                                <td>{{$loop->index+=1}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>
                                                    <form action="{{ Route('kategori.destroy', $item->id) }}" method="post">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                        <a href="{{Route("kategori.edit",$item->uuid)}}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
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
                    <form action="{{ Route('kategori.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-12 col-12 col-md-6">
                                <div class="form-group">
                                     <label class="mb-2" for="exampleFormControlInput1">Nama Kategori</label>
                                     <input type="text"  class="form-control" value="{{ old('name') }}" id="exampleFormControlInput1" placeholder="Nama Kategori" name="name">
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
