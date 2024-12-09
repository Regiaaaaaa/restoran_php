@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Detail Pesanan</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        <table class="table table-bordered">
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>{{ $order->total_price }}</td>
            </tr>
            <tr>
                <th>Tanggal Pesanan</th>
                <td>{{ $order->order_date }}</td>
            </tr>
        </table>

        <h3>Item Pesanan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
