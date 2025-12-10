@extends('layouts.admin-layout')
@section('title', 'Categories')
@section('content')
<h2>Categories</h2>
<a href="{{route('categories.create')}}" class="btn btn-primary mb-3">Add Category</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>

            <td>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')

                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
