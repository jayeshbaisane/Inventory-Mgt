

@extends('layouts.app')

@section('content')
<h2>Category List</h2><br><br>

<a style="background-color:grey; color: white; padding: 8px;" href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>
            <a style="background-color:green; color: white; padding: 8px;" href="{{ route('categories.edit',$category->id) }}">Edit</a>
            <form action="{{ route('categories.destroy',$category->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button style="background-color:darkred; color: white; padding: 8px;" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
