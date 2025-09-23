<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
     public function index()
    {
        // Eager load user for efficiency
        $properties = Property::with('user')->latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load('user');
        return view('admin.properties.show', compact('property'));
    }
}
