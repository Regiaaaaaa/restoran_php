@extends('layouts.app')

@section('content')
<div class="row justify-content-between align-items-center mb-4">
    <div class="col-md-6">
        <h1 class="text-dark">Kategori Menu</h1>
    </div>
    @if (auth()->user()->role === 'admin')
        <div class="col-md-2 text-md-end">
            <a href="{{ route('categories.create') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
        </div>
    @endif
</div>

<div class="card shadow-lg">
    <div class="card-header bg-light text-dark text-center">
        <h2>Daftar Kategori</h2>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <tbody>
                @if ($categories->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center text-muted">Data tidak ditemukan</td>
                    </tr>
                @else
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td class="text-center">
                            @if (auth()->user()->role === 'admin')
                                <!-- Tombol Edit dengan ikon lokal -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-link btn-sm" title="Edit">
                                    <img src="{{ asset('icons/edit.png') }}" alt="Edit" style="width: 24px; height: 24px; transition: transform 0.2s;">
                                </a>

                                <!-- Tombol Hapus dengan ikon lokal -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" style="background: none; border: none;">
                                        <img src="{{ asset('icons/destroy.png') }}" alt="Hapus" style="width: 24px; height: 24px; transition: transform 0.2s;">
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-secondary text-white">Anda Adalah Staff</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f9f9f9; /* Warna latar yang netral */
    }

    .card-header {
        background-color: #f7f7f7; /* Warna abu-abu terang */
        border-bottom: 1px solid #ddd; /* Garis bawah halus */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1; /* Efek hover yang ringan */
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        background-color: white;
    }

    .table td, .table th {
        padding: 12px;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-link img {
        transition: transform 0.2s;
    }

    .btn-link img:hover {
        transform: scale(1.1);
    }
</style>
@endpush
