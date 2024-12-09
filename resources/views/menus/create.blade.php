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
                <h2>Tambah Menu</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('menus.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Menu:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama menu" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga:</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" placeholder="Masukkan harga menu" required>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan deskripsi menu" rows="3" required></textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Pilih kategori menu</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
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
