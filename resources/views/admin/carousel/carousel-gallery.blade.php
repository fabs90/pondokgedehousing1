@extends('admin.layouts.master')
@section('pagename', 'Carousel Gallery')
@section('page-title', 'Carousel Gallery')
@section('page-breadcrumb')
    <li class="breadcrumb-item">carousel</li>
    <li class="breadcrumb-item active">gallery</li>
@endsection
@section('dashboard-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('carousel.gallery.create') }}" type="submit" class="btn btn-success mb-2">Tambah Gambar</a>
                <div class="card">
                    <table class="table datatable" id="table-article">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($datas as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td style="width:25%;"><img src="{{ asset('storage/gallery/' . $item->image) }}"
                                        alt="gambar" class=" img-fluid" style="width: 180px; height: auto;"></td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <a href="{{ route('carousel.gallery.edit', ['slug' => $item->image]) }}"
                                        class="btn btn-primary">Ubah</a>
                                    <form action="{{ route('carousel.gallery.destroy', ['slug' => $item->image]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('carousel.gallery.destroy', ['slug' => $item->image]) }}"
                                            type="submit" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                    </form>
                                </td>
                                @php
                                    $no++;
                                @endphp
                            </tr>
                            @endforeach

                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
