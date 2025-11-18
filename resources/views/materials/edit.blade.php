

@extends('layouts.app')

@section('content')
<h2>Edit Material</h2>

<form method="POST" action="{{ route('materials.update',$material->id) }}">
    @csrf @method('PUT')

    <label>Select Category *</label>
    <select name="category_id" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $material->category_id==$cat->id?'selected':'' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <label>Material Name *</label>
    <input type="text" name="name" value="{{ $material->name }}" required>

    <label>Opening Balance *</label>
    <input type="number" step="0.01" name="opening_balance" value="{{ $material->opening_balance }}" required>

    <button type="submit">Update</button>
</form>
@endsection
