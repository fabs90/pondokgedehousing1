@extends('admin.layouts.master')
@section('pagename', 'Atur Informasi')
@section('page-title', 'Atur Informasi')
@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index') }}">informasi</a></li>
    <li class="breadcrumb-item active">atur-informasi</li>
@endsection
@section('dashboard-content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('article.create') }}" class="btn btn-success mb-2">Tambah Informasi</a>
                {{-- <button type="submit" class="btn btn-success mb-2" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Tambah Informasi</button> --}}
                <!-- Modal -->
                {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold " id="staticBackdropLabel">Tambah Informasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Vertical Form -->
                                <form class="row px-lg-4 px-3 g-3" method="POST" action="{{ route('article.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputJudul" class="form-label fw-bold">Judul</label>
                                        <input type="text" class="form-control" id="inputJudul" name="input_judul"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="article-default" class="form-label fw-bold">Isi</label>
                                        <textarea id="mytextarea2" class="form-control" name="input_isi"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                                        <select class="form-select" aria-label="Default select example" id="kategori"
                                            required name="input_category">
                                            <option value="#" selected>Pilih Kategori</option>
                                            <option value="1">Berita</option>
                                            <option value="2">Event</option>
                                            <option value="3">Promo</option>

                                        </select>

                                    </div>
                                    <div class="col-12 mb-lg-3 mb-2 ">
                                        <label for="formFile" class="form-label fw-bold">Gambar <span>Gambar akan dipakai
                                                sebagai
                                                thumbnail</span></label>
                                        <input class="form-control" type="file" id="formFile" name="input_gambar"
                                            accept="image/*" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- Vertical Form -->

                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Modal End-->
                <div class="card">
                    <table class="table datatable" id="table-article">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($articles as $post)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $post->judul }}</td>
                                    <td style="max-lines: 4;">{!! Str::limit($post->isi, 300) !!}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td style="width:25%;"><img src="{{ asset('storage/images/' . $post->gambar) }}"
                                            alt="gambar" class="img-fluid img-informasi" style="width: 80%;">
                                    </td>
                                    <td>
                                        <a href="{{ route('article.edit', ['slug' => $post->slug]) }}"
                                            class="btn btn-primary">Ubah</a>
                                        <form action="{{ route('article.destroy', ['slug' => $post->slug]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('article.destroy', ['slug' => $post->slug]) }}" type="submit"
                                                class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
