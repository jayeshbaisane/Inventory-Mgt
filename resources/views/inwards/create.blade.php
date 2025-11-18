

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Inward / Outward Entry</h2><br>

    <form method="POST" action="{{ route('inwards.store') }}">
        @csrf

        <label>Category *</label>
        <select name="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                
            @endforeach
        </select>

        <label>Material *</label>
        <select name="material_id" required>
            <option value="">Select Material</option>
            @foreach($materials as $mat)
                <option value="{{ $mat->id }}">{{ $mat->name }}</option>
            @endforeach
        </select>

        <label>Type *</label>
        <select name="type" required>
            <option value="">Select Type</option>
            <option value="inward">Inward</option>
            <option value="outward">Outward</option>
        </select>

        <label>Quantity *</label>
        <input type="number" name="quantity" required step="0.01">

        <label>Date *</label>
        <input type="date" name="entry_date" required>

        <button style="background-color: green; color: white; padding: 8px;" type="submit">Save</button>
    </form>
</div>
@endsection
