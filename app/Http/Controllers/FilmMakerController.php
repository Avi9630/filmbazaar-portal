<?php

namespace App\Http\Controllers;

use App\Models\FilmMaker;
use Illuminate\Http\Request;

class FilmMakerController extends Controller
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
        // Fetch Film Makers based on search query, paginated with 10 items per page
        $filmMakers = FilmMaker::when($search, function ($query, $search) {
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
                return $query->whereJsonContains('sectors', (int)$sector); // Assuming 'sectors' is a JSON field
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('id', 'DESC') // Order by ID in descending order

            ->paginate(20);

        foreach ($filmMakers as $filmMaker) {
            if ($filmMaker->sectors) {
                // Check if it's a string that needs decoding
                if (is_string($filmMaker->sectors)) {
                    // Decode it only if it's a string
                    $filmMaker->sectors = json_decode($filmMaker->sectors, true);
                }

                // Now map the sectors to their names
                $filmMaker->sectors = $this->mapSectors($filmMaker->sectors);
            }
        }
        $sectors = [
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

        return view('film_makers.index', compact('filmMakers', 'sectors'));
    }

    private function mapSectors(array $sectorIds)
    {
        return collect($sectorIds)->map(function ($sectorId) {
            $sector = collect($this->sectors)->firstWhere('id', $sectorId);
            return $sector ? $sector['name'] : 'Unknown';
        })->implode(', ');
    }

    // Function to show Film Maker details
    public function show($id)
    {
        // Fetch Film Maker details by ID
        $filmMaker = FilmMaker::findOrFail($id);
        return view('film_makers.show', compact('filmMaker'));
    }

    public function updateStatus(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'id' => 'required|integer|exists:film_buyers,id', // Ensure the ID exists in the film_buyers table
            'status' => 'required|integer'
        ]);

        // Fetch Film Buyer details by ID
        $FilmBuyer = FilmMaker::findOrFail($request->id);

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
