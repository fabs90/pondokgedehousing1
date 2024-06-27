@extends('admin.layouts.master')
@section('pagename', 'Ubah Informasi')
@section('page-title', 'Ubah Informasi')
@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index') }}">informasi</a></li>
    <li class="breadcrumb-item active">ubah-informasi</li>
@endsection
@section('dashboard-content')
    <div class="container article-container">
        <div class="row">
            <div class="col-10">
                <a href="{{ route('article.index') }}" class="btn btn-success mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Informasi</h5>

                        <!-- Vertical Form -->
                        <form class="row px-lg-4 px-3 g-3" method="POST"
                            action="{{ route('article.update', ['slug' => $datas->slug]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-12">
                                <label for="inputJudul" class="form-label fw-bold">Judul</label>
                                <input type="text" class="form-control" id="inputJudul" name="input_judul"
                                    autocomplete="off" required value="{{ $datas->judul }}">
                            </div>
                            <div class="col-12">
                                <label for="article-default" class="form-label fw-bold">Isi</label>
                                <textarea id="mytextarea" class="form-control" name="input_isi">{{ $datas->isi }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="kategori" class="form-label fw-bold">Kategori</label>
                                <select class="form-select" aria-label="Default select example" id="kategori" required
                                    name="input_category">
                                    <option value="#"
                                        {{ empty(old('category_id', $datas->category_id)) ? 'selected' : '' }}>Pilih
                                        Kategori</option>
                                    <option value="1"
                                        {{ old('category_id', $datas->category_id) == 1 ? 'selected' : '' }}>Berita</option>
                                    <option value="2"
                                        {{ old('category_id', $datas->category_id) == 2 ? 'selected' : '' }}>Event</option>
                                    <option value="3"
                                        {{ old('category_id', $datas->category_id) == 3 ? 'selected' : '' }}>Promo</option>
                                </select>



                            </div>
                            <div class="col-12 mb-lg-3 mb-2 ">
                                <label for="formFile" class="form-label fw-bold">Gambar <span>Gambar akan dipakai
                                        sebagai
                                        thumbnail</span></label>
                                <input class="form-control" type="file" id="formFile" name="input_gambar"
                                    accept="image/*">
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
