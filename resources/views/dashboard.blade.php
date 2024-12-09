@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Section: Welcome Message -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-info text-center">
                <h4 class="fw-bold">
                    Selamat Datang, {{ auth()->user()->username ?? 'Pengguna' }}!
                </h4>
                <p>Di Official Website Makan.in</p>
            </div>
        </div>
    </div>

    <!-- Section: Profil Pengguna -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <img src="{{ asset('icons/org.png') }}" alt="Profile Picture" 
                        class="rounded-circle me-4" width="70" height="70">
                    <div>
                        <h5 class="fw-bold mb-0">
                            {{ auth()->check() ? auth()->user()->username : 'Belum Login' }}
                        </h5>
                        @if(auth()->check())
                        <p class="text-muted">Role: {{ auth()->user()->role }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Recent Orders -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="fw-bold">Recent Orders</h5>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Total Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                            <tr>
                                <td>{{ $order->customer_name }}</td>
                                <td class="text-success fw-bold">Rp {{ $order->total_price }}</td>
                                <td>{{ $order->orderItems->sum('quantity') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('orders.index') }}" class="btn btn-warning text-dark rounded-pill px-4 py-2">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f4f8fb; 
    }

    .alert {
        font-size: 1.2rem;
        border-radius: 10px;
    }

    .btn-warning {
        background-color: #ffc107;
        font-weight: bold;
    }

    .card-header {
        border-radius: 15px 15px 0 0;
    }

    .rounded-circle {
        object-fit: cover;
    }
</style>
@endpush
