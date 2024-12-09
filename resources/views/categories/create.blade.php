@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger shadow-sm mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Tambah Kategori</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Nama Kategori:</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" placeholder="Masukkan nama kategori" required>
                        @error('category_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Gaya tambahan untuk tampilan yang lebih elegan */
    body {
        background-color: #f8f9fa; /* Warna latar belakang yang lembut */
    }

    .card {
        border-radius: 12px; /* Membuat kartu memiliki sudut yang melengkung */
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px; /* Sudut input lebih lembut */
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 8px;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        font-size: 1.25rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }

    .btn-lg {
        font-size: 1rem;
    }
</style>
@endpush
