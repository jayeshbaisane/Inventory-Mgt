@extends('layouts.app')

@section('content')
<h2>Add Material</h2><br>

<form method="POST" action="{{ route('materials.store') }}">
    @csrf

    <label>Select Category *</label>
    <select name="category_id" required>
        <option value="">Select</option>

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <label>Material Name *</label>
    <input type="text" name="name" required>

    <label>Opening Balance *</label>
    <input type="number" step="0.01" name="opening_balance" required>

    <button style="background-color: green; color: white; padding: 8px;" type="submit">Save</button>
</form>
@endsection
