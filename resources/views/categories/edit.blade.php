

@extends('layouts.app')

@section('content')
<h2>Edit Category</h2>

<form method="POST" action="{{ route('categories.update',$category->id) }}">
    @csrf @method('PUT')

    <label>Category Name *</label>
    <input type="text" name="name" value="{{ $category->name }}" required>

    <button type="submit">Update</button>
</form>
@endsection
