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
                <h2>Tambah Pesanan</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Nama Pelanggan:</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="Masukkan nama pelanggan" required>
                        @error('customer_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="menu-select" class="form-label">Menu:</label>
                        <select class="form-control @error('order_items.0.menu_id') is-invalid @enderror" id="menu-select" name="order_items[0][menu_id]" required>
                            <option value="" disabled selected>Pilih Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                        @error('order_items.0.menu_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity-input" class="form-label">Jumlah Item:</label>
                        <input type="number" class="form-control @error('order_items.0.quantity') is-invalid @enderror" id="quantity-input" name="order_items[0][quantity]" placeholder="Masukkan jumlah item" min="1" required>
                        @error('order_items.0.quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total-price-display" class="form-label">Total Harga:</label>
                        <input type="text" id="total-price-display" class="form-control" value="0" readonly>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuSelect = document.getElementById('menu-select');
        const quantityInput = document.getElementById('quantity-input');
        const totalPriceDisplay = document.getElementById('total-price-display');

        function updateTotalPrice() {
            const selectedMenu = menuSelect.options[menuSelect.selectedIndex];
            const price = selectedMenu.dataset.price ? parseFloat(selectedMenu.dataset.price) : 0;
            const quantity = parseInt(quantityInput.value) || 0;

            const totalPrice = price * quantity;
            totalPriceDisplay.value = totalPrice.toFixed(2);
        }

        menuSelect.addEventListener('change', updateTotalPrice);
        quantityInput.addEventListener('input', updateTotalPrice);
    });
</script>

@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 12px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
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
