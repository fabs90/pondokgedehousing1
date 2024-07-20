@extends('admin.layouts.master')
@section('pagename', 'Carousel Menu Utama')
@section('page-title', 'Carousel Menu Utama')
@section('page-breadcrumb')
    <li class="breadcrumb-item">carousel</li>
    <li class="breadcrumb-item active">menu-utama</li>
@endsection
@section('dashboard-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('carousel.menu-utama.create') }}" class="btn btn-success mb-2">Tambah Gambar</a>
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
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td style="width:30%;"><img src="{{ asset('storage/hero_carousel/' . $item->gambar) }}"
                                            alt="gambar" class=" img-fluid" style="width: 100%; height: auto;"></td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('carousel.menu-utama.edit', ['slug' => $item->slug]) }}"
                                            class="btn btn-primary">Ubah</a>
                                        <form action="{{ route('carousel.menu-utama.destroy', ['slug' => $item->slug]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('carousel.menu-utama.destroy', ['slug' => $item->slug]) }}"
                                                type="submit" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
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
