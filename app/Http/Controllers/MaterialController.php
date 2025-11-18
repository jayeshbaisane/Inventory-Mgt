<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('category')->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('materials.create', compact('categories'));
    }

    public function store(Request $request)
    {
            $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric',
        ]);

        // Auto-generate internal material ID
        //$lastID = Material::orderBy('internal_material_id', 'desc')->value('internal_material_id');

        $lastID = Material::whereNotNull('internal_material_id')
                  ->orderBy('internal_material_id', 'desc')
                  ->value('internal_material_id');
        $newInternalID = $lastID ? $lastID + 1 : 1001; // starting from 1001

        Material::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'opening_balance' => $request->opening_balance,
            'internal_material_id'=> $newInternalID,
        ]);

        return redirect()->route('materials.index')->with('success','Material added successfully!');
    }

    public function edit(Material $material)
    {
        $categories = Category::all();
        return view('materials.edit', compact('material','categories'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'category_id'      => 'required',
            'name'             => 'required|string|max:255',
            'opening_balance'  => 'required|numeric',
        ]);

        $material->update([
            'category_id'     => $request->category_id,
            'name'            => $request->name,
            'opening_balance' => $request->opening_balance,
         ]);

    return redirect()->route('materials.index')->with('success','Material updated');
    }


    public function manage()
    {
    $materials = Material::with('category')
        ->withSum('inwards as total_inward', 'quantity')
        ->get();

    return view('materials.manage', compact('materials'));
    }


    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success','Material deleted');
    }
}
