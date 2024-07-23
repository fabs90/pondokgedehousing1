@extends('admin.layouts.master')
@section('pagename', 'Kontak')
@section('page-title', 'Kontak')
@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('article.index') }}">kontak</a></li>
    <li class="breadcrumb-item active">atur-kontak</li>
@endsection
@section('dashboard-content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-success mb-2" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Tambah Kontak</button>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold " id="staticBackdropLabel">Tambah Kontak</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Vertical Form -->
                                <form class="row px-lg-4 px-3 g-3" method="POST" action="{{ route('contact.store') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputNama" class="form-label fw-bold">Nama</label>
                                        <input type="text" class="form-control" id="inputNama" name="input_nama"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNoTelp" class="form-label fw-bold">Nomor Hp</label>
                                        <input type="tel" id="inputNoTelp" class="form-control"
                                            name="input_no_telp"></input>
                                    </div>
                                    <div class="col-12 mb-lg-3 mb-2">
                                        <label for="kategori" class="form-label fw-bold">Role</label>
                                        <select class="form-select" aria-label="Default select example" id="kategori"
                                            required name="input_role">
                                            <option value="" selected>Pilih Role</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="button"class="btn btn-warning text-light" data-bs-toggle="modal"
                                            data-bs-target="#staticTambahRole">Tambah Role</button>
                                    </div>
                                </form><!-- Vertical Form -->

                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End-->
                <!-- Modal -->
                <div class="modal fade" id="staticTambahRole" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="#staticTambahRole" aria-hidden="true">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold " id="staticBackdropLabel">Tambah Role</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Vertical Form -->
                                <form class="row px-lg-4 px-3 g-3" method="POST" action="{{ route('role.store') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="input_nama_role" class="form-label fw-bold">Nama Role</label>
                                        <input type="text" class="form-control" id="input_nama_role"
                                            name="input_nama_role" autocomplete="off" required>
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
                </div>
                <!-- Modal End-->


                <!-- Table Contact Start  -->
                <div class="card">
                    <div class="card-header">
                        <h5>Kontak</h5>
                    </div>
                    <table class="table datatable" id="table-article">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor HP</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($contacts as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->role->nama }}</td>
                                    <td>
                                        <form action="{{ route('contact.destroy', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('contact.destroy', ['id' => $item->id]) }}"
                                                class="btn btn-danger " data-confirm-delete="true">Hapus</a>
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
                <!-- Table Contact End  -->

                <!-- Table Role Start  -->
                <div class="card">
                    <div class="card-header">
                        <h5>Role</h5>
                    </div>
                    <table class="table datatable" id="table-role">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <form action="{{ route('role.destroy', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('role.destroy', ['id' => $item->id]) }}"
                                                class="btn btn-danger " data-confirm-delete="true">Hapus</a>
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
                <!-- Table Role End  -->


            </div>
        </div>
    </div>

@endsection
