

@extends('layouts.app')

@section('content')
<h2>Add Category</h2>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <label>Category Name *</label>
    <input type="text" name="name" required>

    <button type="submit">Save</button>
</form>
@endsection
