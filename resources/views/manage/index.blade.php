

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Material Manage Page</h2><br><br>

    <a style="background-color: green; color: white; padding: 8px;" href="{{ route('materials.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mr-2">Add Material</a>
    <a style="background-color: green; color: white; padding: 8px;" href="{{ route('inwards.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Add Inward/Outward</a>

    <table class="table-auto w-full mt-6 border">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-3 py-2 border">Category</th>
                <th class="px-3 py-2 border">Material Name</th>
                <th class="px-3 py-2 border">Opening Balance</th>
                <th class="px-3 py-2 border">Total Inward/Outward</th>
                <th class="px-3 py-2 border">Current Balance</th>
                <th class="px-3 py-2 border">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($materials as $material)
                @php
                    $totalInOut = $material->inward?->sum('quantity') ?? 0;
                    $currentBalance = $material->opening_balance + $totalInOut;
                @endphp

                <tr class="border-t">
                    <td class="px-4 py-2 border">
                        {{ $material->category->name ?? 'N/A' }}
                    </td>

                    <td class="px-4 py-2 border">
                        {{ $material->name }}
                    </td>

                    <td class="px-4 py-2 border">
                        {{ number_format($material->opening_balance, 2) }}
                    </td>

                    <td class="px-4 py-2 border">
                        {{ number_format($totalInOut, 2) }}
                    </td>

                    <td class="px-4 py-2 border font-bold">
                        {{ number_format($currentBalance, 2) }}
                    </td>

                    <td class="px-4 py-2 border">
                        <a style="background-color: green; color: white; padding: 8px;" href="{{ route('materials.edit', $material->id) }}" class="text-blue-600">Edit</a>

                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="inline ml-2">
                            @csrf
                            @method('DELETE')
                            <button style="background-color: red; color: white; padding: 8px;" onclick="return confirm('Soft delete this material?')" class="text-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

</div>
@endsection
