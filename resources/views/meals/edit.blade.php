@extends('layouts.admin-layout')
@section('title', 'Edit Meal')
@section('content')
<h2>Edit Meal</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{route('meals.update', $meal->id)}}') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{$meal->name}}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $meal->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" value="{{$meal->price}}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-select">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id ==$meal->category_id ? 'selected' : '' }}>
                {{ $category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if(isset($meal) && $meal->image)

        <img src="{{ asset('storage/' . $meal->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
