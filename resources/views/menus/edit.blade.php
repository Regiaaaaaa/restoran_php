@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1>Edit Menu</h1>
        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Menu:</label>
                <input type="text" class="form-control" name="name" value="{{ $menu->name }}" required>
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" class="form-control" name="price" value="{{ $menu->price }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" name="description" required>{{ $menu->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori:</label>
                <select class="form-control" name="category_id" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>
</div>
@endsection