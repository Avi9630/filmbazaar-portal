<?php

// app/Http/Controllers/SlotBookController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlotBook;

class SlotBookController extends Controller
{
    public function index(Request $request)
    {
        $query = SlotBook::query();

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    

        $slots = $query->paginate(10);

        return view('slotbook.index', compact('slots'));
    }
}
