@extends('layouts.master', ['title' => 'Detail | Manajement Arsip'])
@section('content')
    <div class="page-heading">
        <h3>Detail Arsip</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-6">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                       <div class="form-group">
                            <label class="mb-2" for="exampleFormControlInput1">Judul Dokument</label>
                            <p class="fw-bold">{{$data->title}}</p>
                       </div>
                       <div class="form-group">
                            <label class="mb-2" for="exampleFormControlInput1">Kategori</label>
                            <p class="fw-bold">{{$data->kategori->name}}</p>
                       </div>
                       <div class="form-group">
                            <label class="mb-2" for="exampleFormControlInput1">Di Upload Oleh</label>
                            <p class="fw-bold">{{$data->user->name}} | {{$data->created_at}}</p>
                       </div>
                       <div class="form-group">
                            <label class="mb-2" for="exampleFormControlInput1">Keterangan</label>
                            <p class="fw-bold">{{$data->deskripsi}}</p>
                       </div>
                       <div class="form-group">
                            <a href="{{asset($data->file_pdf)}}" class="btn btn-primary">Unduh File <i class="bi bi-download"></i></a>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <embed src="{{asset($data->file_pdf)}}" type="application/pdf" width="100%" height="600px">      
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection
