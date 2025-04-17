@extends('layouts.main')

@section('content')


            <div class="m-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
                        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel User</h6>
                            <div class="d-flex">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm m-1">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </a>
                                <a href="{{ route('users.pdf') }}" target="_blank" class="btn btn-danger btn-sm m-1">
                                    <i class="fas fa-file-pdf"></i> Cetak PDF
                                </a>
                                <a href="{{ route('users.excel') }}" class="btn btn-success btn-sm m-1">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                                <!-- Tombol Import Excel -->
                                <a href="{{ route('users.import') }}" class="btn btn-warning btn-sm m-1" data-toggle="modal" data-target="#importModal">
                                    <i class="fas fa-upload"></i> Import Excel
                                </a>
                            </div>
                            <!-- Modal Import Excel -->
                            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importModalLabel">Import Excel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="file">Pilih File Excel untuk Import</label>
                                                    <input type="file" name="file" class="form-control" accept=".xlsx,.csv" required>
                                                </div>
                                                <button type="submit" class="btn btn-success">Import</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm m-1">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="#" class="btn btn-danger btn-delete btn-sm" data-id="{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

@endsection('content')

