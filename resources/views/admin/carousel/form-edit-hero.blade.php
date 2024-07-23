@extends('admin.layouts.master')
@section('pagename', 'Tambah Informasi')
@section('page-title', 'Tambah Informasi')
@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index') }}">carousel</a></li>
    <li class="breadcrumb-item active">tambah-gambar</li>
@endsection
@section('dashboard-content')
    <div class="container article-container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <a href="{{ route('carousel.menu-utama') }}" class="btn btn-success mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Gambar</h5>

                        <!-- Vertical Form -->
                        <form class="row px-lg-4 px-3 g-3" method="POST"
                            action="{{ route('carousel.menu-utama.update', ['slug' => $image->slug]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-12  ">
                                <label for="formFile" class="form-label fw-bold">Gambar <span>Ukuran Rekomendasi : (1280 x
                                        720)</span> <span>
                                        Link Resize Gambar : <a target="_blank"
                                            href="https://safeimagekit.com/resize-image-to-1280x720">Klik disini</a>
                                    </span></label>
                                <input class="form-control" type="file" id="formFile" name="input_gambar"
                                    accept="image/*">
                            </div>
                            <div class="col-12 mb-lg-3 mb-2">
                                <label for="inputKeterangan" class="form-label fw-bold">Keterangan</label>
                                <input type="text" class="form-control" id="inputKeterangan" name="input_keterangan"
                                    value="{{ $image->keterangan }}" autocomplete="off" required>
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
