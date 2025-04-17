@extends('layouts.main') {{-- atau layout kamu sendiri --}}
@section('content')
<div class="container">
    <h2>Detail User</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            {{-- Tambahkan data lainnya jika ada --}}
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
