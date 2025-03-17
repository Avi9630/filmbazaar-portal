<?php

namespace App\Http\Controllers;

use App\Models\AllowedBuyer;
use Illuminate\Http\Request;

class AllowedBuyerController extends Controller
{
    // List all Allowed Buyers with pagination and search
    public function index(Request $request)
    {
        $query = AllowedBuyer::query();

        if ($request->has('search')) {
            $query->where('email', 'LIKE', '%' . $request->search . '%');
        }

        $allowedBuyers = $query->paginate(10);

        return view('allowedbuyers.index', compact('allowedBuyers'));
    }

    // Show form to create a new Allowed Buyer
    public function create()
    {
        return view('allowedbuyers.create');
    }

    // Store a new Allowed Buyer
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:allowed_buyer,email',
        ]);

        AllowedBuyer::create($request->all());

        return redirect()->route('allowedbuyers.index')->with('success', 'Allowed Buyer created successfully.');
    }

    // Show a specific Allowed Buyer
    public function show($id)
    {
        $allowedBuyer = AllowedBuyer::findOrFail($id);
        return view('allowedbuyers.show', compact('allowedBuyer'));
    }

    // Show form to edit an Allowed Buyer
    public function edit($id)
    {
        $allowedBuyer = AllowedBuyer::findOrFail($id);
        return view('allowedbuyers.edit', compact('allowedBuyer'));
    }

    // Update an Allowed Buyer
    public function update(Request $request, $id)
    {

        $request->validate([
            'email' => 'required|email|unique:allowed_buyer,email,' . $id,
        ]);
        try {
            $allowedBuyer = AllowedBuyer::findOrFail($id);
            $allowedBuyer->update($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('allowedbuyers.index')->with('success', 'Allowed Buyer updated successfully.');
    }

    // Delete an Allowed Buyer
    public function destroy($id)
    {
        $allowedBuyer = AllowedBuyer::findOrFail($id);
        $allowedBuyer->delete();

        return redirect()->route('allowedbuyers.index')->with('success', 'Allowed Buyer deleted successfully.');
    }
}
