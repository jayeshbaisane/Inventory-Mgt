

@extends('layouts.app')

@section('content')
<h2>Material List</h2> <br><br>

<a style="background-color:grey; color: white; padding: 8px;" href="{{ route('materials.create') }}">Add Material</a><br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Category</th>
    <th>Material Name</th>
    <th>Opening Balance</th>
    <th>Internal ID</th>
    <th>Action</th>
</tr>

@foreach($materials as $mat)
<tr>
    <td>{{ $mat->id }}</td>
    <td>{{ $mat->category->name ?? 'No Category' }}</td>
    <td>{{ $mat->name }}</td>
    <td>{{ $mat->opening_balance }}</td>
    <td>{{ $mat->internal_material_id }}</td>
    <td>
        <a style="background-color: green; color: white; padding: 8px;" href="{{ route('materials.edit',$mat->id) }}">Edit</a>
        <form action="{{ route('materials.destroy',$mat->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button style="background-color: red; color: white; padding: 8px;" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach

</table>
@endsection
