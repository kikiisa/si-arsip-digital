@extends('layouts.master', ['title' => 'Edit Kategori'])
@section('content')
    <div class="page-heading">
        <h3>Edit Kategori</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-6 col-lg-6">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Route('kategori.update',$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="mb-2" for="exampleFormControlInput1">Nama Kategori</label>
                                        <input type="text"  class="form-control" value="{{ $data->name }}" id="exampleFormControlInput1" placeholder="Nama Kategori" name="name">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
@endsection
