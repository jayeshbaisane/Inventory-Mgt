<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Material;
use App\Models\Inward;
use Illuminate\Support\Facades\DB;


class InwardController extends Controller
{
    public function index()
    {
        $inwards = Inward::with('category', 'material')->get();
        return view('inwards.index', compact('inwards'));
    }

    public function create()
    {
        $categories = Category::all();
        $materials = Material::all();
        return view('inwards.create', compact('categories', 'materials'));
    }

    public function store(Request $request)
   {
        $data = $request->validate([

            'category_id' => 'required|exists:categories,id',
            'material_id' => 'required|exists:materials,id',
            'type'        => 'required|in:inward,outward',
            'quantity'    => 'required|numeric',
            'entry_date'  => 'required|date',

        ]);

        $lastID = Inward::max('internal_inward_id');
        $newInternalID = $lastID ? $lastID + 1 : 5001;

        // Use transaction to keep data consistent
        DB::beginTransaction();
        try {
            $material = Material::lockForUpdate()->findOrFail($data['material_id']);

            // compute new balance
            if ($data['type'] === 'inward') {
                $newBalance = $material->opening_balance + $data['quantity'];
            } else { // outward
                $newBalance = $material->opening_balance - $data['quantity'];

                // prevent negative balance (optional)
                if ($newBalance < 0) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['quantity' => 'Not enough quantity in stock for this outward.']);
                }
            }

            // create record in inwards table (or use appropriate model)
            $inward = Inward::create([

                'category_id'        => $data['category_id'],
                'material_id'        => $data['material_id'],
                'type'               => $data['type'],
                'quantity'           => $data['quantity'],
                'entry_date'         => $data['entry_date'],
                'internal_inward_id' => $newInternalID,
                
            ]);

            // update material balance
            $material->opening_balance = $newBalance;
            $material->save();

            DB::commit();

            return redirect()->route('inwards.index')->with('success', 'Entry saved successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            // Log the exception in real app
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to save entry: '.$e->getMessage()]);
        }
    }

    public function destroy(Inward $inward)
    {
        $inward->delete();
        return redirect()->route('inwards.index')->with('success', 'Entry deleted.');
    }
}
