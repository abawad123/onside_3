@extends('layouts.admin-layout')
@section('title', 'Edit Category')
@section('content')
<h2>Edit Category</h2>
<form method="POST" action="{{route('categories.update',
$category)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        @error('name')
        <div class="alert alert-danger m-3">{{ $message }}</div>
        @enderror
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
            class="form-control @error('title') is-invalid @enderror">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
