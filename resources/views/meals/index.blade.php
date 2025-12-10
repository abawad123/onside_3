@extends('layouts.admin-layout')
@section('title', 'Meals')
@section('content')
<h2>Meals</h2>
<a href="{{route('meals.create')}}" class="btn btn-primary mb-3">Add Meal</a>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($meals as $meal)
        <tr>
            <td>{{ $meal->name }}</td>
            <td>${{ $meal->price }}</td>
            <td>{{ $meal->category->name }}</td>
            <td>
                @if($meal->image)
                <img src="{{ asset('storage/' . $meal->image) }}" width="80">
                @endif
            </td>
            <td>
                <a href="{{ route('meals.edit', $meal) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('meals.destroy', $meal) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
