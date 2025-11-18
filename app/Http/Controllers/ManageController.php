<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index()
    {
        $materials = Material::with('category','inward')->get();

        return view('manage.index', compact('materials'));
    }
}
