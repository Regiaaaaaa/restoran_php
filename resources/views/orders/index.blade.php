@extends('layouts.app')

@section('content')

<div class="row justify-content-between align-items-center mb-4">
    <div class="col-md-6">
        <h1 class="text-dark">Pesanan</h1>
    </div>
    @if (auth()->user()->role === 'staff')
        <div class="col-md-3 text-md-end">
            <a href="{{ route('orders.create') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Pesanan
            </a>
        </div>
    @endif
</div>

<div class="card shadow-lg">
    <div class="card-header bg-light text-dark text-center">
        <h2>Daftar Pesanan</h2>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Menu Pesanan</th>
                    <th class="text-center">Jumlah Item</th>
                    <th>Total Harga</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        @foreach ($order->orderItems as $item)
                            <p>{{ $item->menu->name }}</p>
                        @endforeach
                    </td>
                    <td class="text-center">{{ $order->orderItems->sum('quantity') }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td class="text-center">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-link btn-sm" title="Detail">
                            <img src="{{ asset('icons/ditel.png') }}" alt="Detail" style="width: 24px; height: 24px; transition: transform 0.2s;">
                        </a>

                        @if (auth()->user()->role === 'staff')
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')" style="background: none; border: none;">
                                    <img src="{{ asset('icons/destroy.png') }}" alt="Hapus" style="width: 24px; height: 24px; transition: transform 0.2s;">
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada pesanan</td>
                </tr>
                @endforelse
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
