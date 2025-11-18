

@extends('layouts.app')

@section('content')
<h2 style="padding-left: 80px;">Inward / Outward Entries</h2><br>

<a style="background-color: green; color: white; padding: 8px;" href="{{ route('inwards.create') }}">Add Entry</a><br><br>


<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Category</th>
    <th>Material</th>
    <th>Date</th>
    <th>Quantity (+ / -)</th>
    <th>Internal ID</th>
    <th>Delete</th>
</tr>

@foreach($inwards as $in)
<tr>
    <td>{{ $in->id }}</td>
    <td>{{ $in->category->name }}</td>
    <td>{{ $in->material->name }}</td>
    <td>{{ $in->entry_date }}</td>
    <td>{{ $in->quantity }}</td>
    <td>{{ $in->internal_inward_id }}</td>
    <td>
        <form action="{{ route('inwards.destroy', $in->id) }}" method="POST">
            @csrf @method('DELETE')
            <button style="background-color: red; color: white; padding: 8px;" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection


