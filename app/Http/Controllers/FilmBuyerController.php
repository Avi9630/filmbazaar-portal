<?php

namespace App\Http\Controllers;

use App\Models\FilmBuyer;
use Illuminate\Http\Request;

class FilmBuyerController extends Controller
{
    private $sectors = [
        ['id' => 1, 'name' => 'Film'],
        ['id' => 2, 'name' => 'TV'],
        ['id' => 3, 'name' => 'Gaming and Esports'],
        ['id' => 4, 'name' => 'Radio and Podcasts'],
        ['id' => 5, 'name' => 'Music and Sound'],
        ['id' => 6, 'name' => 'Internet Advertising'],
        ['id' => 7, 'name' => 'Influencer Marketing'],
        ['id' => 8, 'name' => 'Out of Home Media'],
        ['id' => 9, 'name' => 'AVGC-XR'],
        ['id' => 10, 'name' => 'Print (Newspapers, Magazine)'],
        ['id' => 11, 'name' => 'Live Event'],
        ['id' => 12, 'name' => 'Startup'],
        ['id' => 13, 'name' => 'AR/VR']
    ];
    // Function to list Film Makers with Pagination and Search
    public function index(Request $request)
    {
        $search = trim($request->input('name'));
        $email = trim($request->input('email'));
        $sector = trim($request->input('sector'));
        $status = trim($request->input('status'));

        // Fetch Film Buyers with pagination
        $FilmBuyers = FilmBuyer::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
            });
        })
            ->when($email, function ($query, $email) {
                return $query->where('email', 'like', '%' . $email . '%');
            })
            ->when($sector, function ($query, $sector) {
                return $query->whereJsonContains('segments', (int)$sector);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('id', 'DESC') // Order by ID in descending order
            ->paginate(20)
            ->appends($request->all());  // ✅ Preserve filters across pages

        // Process segments
        foreach ($FilmBuyers as $FilmBuyer) {
            if ($FilmBuyer->segments && is_string($FilmBuyer->segments)) {
                $FilmBuyer->segments = $this->mapSectors(json_decode($FilmBuyer->segments, true));
            }
        }

        // Sectors list
        $sectors = $this->sectors;

        return view('film_buyer.index', compact('FilmBuyers', 'sectors'));
    }

    private function mapSectors(array $sectorIds)
    {
        return collect($sectorIds)->map(function ($sectorId) {
            $sector = collect($this->sectors)->firstWhere('id', $sectorId);
            return $sector ? $sector['name'] : '';
        })->filter()->implode(', ');
    }
    // Function to show Film Maker details
    public function show($id)
    {
        // Fetch Film Maker details by ID
        $FilmBuyer = FilmBuyer::findOrFail($id);

        return view('film_buyer.show', compact('FilmBuyer'));
    }
    public function updateStatus(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'id' => 'required|integer|exists:film_buyers,id', // Ensure the ID exists in the film_buyers table
            'status' => 'required|integer'
        ]);

        // Fetch Film Buyer details by ID
        $FilmBuyer = FilmBuyer::findOrFail($request->id);

        // Update the status
        $FilmBuyer->status = $request->status;
        if (!empty($request->reason))
            $FilmBuyer->reason   = $request->reason;
        if (!empty($request->reason_type))
            $FilmBuyer->reason_type = $request->reason_type;
        $FilmBuyer->save();

        // Return a success response
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}
