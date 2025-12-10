@extends('layouts.admin-layout')
@section('title', 'Create Meal')
@section('content')
<h2>Add Meal</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('meals.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control">
    </div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-select">
            <option>Select Category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
