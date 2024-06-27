@extends('admin.layouts.master')
@section('pagename', 'Tambah Informasi')
@section('page-title', 'Tambah Informasi')
@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index') }}">informasi</a></li>
    <li class="breadcrumb-item active">tambah-informasi</li>
@endsection
@section('dashboard-content')
    <div class="container article-container">
        <div class="row">
            <div class="col-10">
                <a href="{{ route('article.index') }}" class="btn btn-success mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Informasi</h5>

                        <!-- Vertical Form -->
                        <form class="row px-lg-4 px-3 g-3" method="POST" action="{{ route('article.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="inputJudul" class="form-label fw-bold">Judul</label>
                                <input type="text" class="form-control" id="inputJudul" name="input_judul"
                                    autocomplete="off" @error('input_judul') is-invalid @enderror" required
                                    value="{{ old('input_judul') }}">
                                @error('input_judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="article-default" class="form-label fw-bold">Isi</label>
                                <textarea id="mytextarea" class="form-control" name="input_isi"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="kategori" class="form-label fw-bold">Kategori</label>
                                <select class="form-select @error('input_category') is-invalid @enderror"
                                    aria-label="Default select example" id="kategori" required name="input_category">
                                    <option value="#" selected>Pilih Kategori</option>
                                    <option value="1">Berita</option>
                                    <option value="2">Event</option>
                                    <option value="3">Promo</option>
                                </select>
                                @error('input_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12 mb-lg-3 mb-2 ">
                                <label for="formFile" class="form-label fw-bold">Gambar <span>Gambar akan dipakai
                                        sebagai
                                        thumbnail</span></label>
                                <input class="form-control" type="file" id="formFile" name="input_gambar"
                                    accept="image/*" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
