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
        <h1>Edit Kategori</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category_name">Nama Kategori:</label>
                <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}" required>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>
</div>
@endsection