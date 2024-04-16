@extends('layouts.master', ['title' => 'Arsip | Manajement Arsip'])
@section('content')
    <div class="page-heading">
        <h3>Managament Arsip</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-6">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('management-arsip.update',$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput1">Nama File</label>
                                        <input type="text" class="form-control" value="{{ $data->title }}"
                                            id="exampleFormControlInput1" placeholder="Nama File" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput2">Kategori</label>
                                        <select name="kategori_id" id="exampleFormControlInput2" class="form-control">
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option {{ $data->kategori_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput3">Keterangan</label>
                                        <textarea name="keterangan" id="exampleFormControlInput3" placeholder="Keterangan" name="keterangan"
                                            class="form-control">{{$data->deskripsi}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput4">File PDF</label>
                                        <br>
                                        <input type="file" name="image" id="exampleFormControlInput4"
                                            class="form-contorl">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput5">Status Arsip</label>
                                        <select name="status" id="exampleFormControlInput5" class="form-control">
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="active" {{$data->status == 'active' ? 'selected' : ''}}>Publish</option>
                                            <option value="inactive" {{$data->status == 'inactive' ? 'selected' : ''}}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
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
