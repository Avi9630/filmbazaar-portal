<?php

namespace App\Http\Controllers;

use App\Models\FilmMaker;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
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
        $sector = $request->input('sector');
        $status = $request->input('status');

        // Fetch Films with search, sector, and status filters
        $films = Film::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->when($sector, function ($query, $sector) {
                return $query->where('sector_id', $sector); // Assuming 'sector_id' is the column for sectors
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(15);

        // Map sectors if needed
        foreach ($films as $film) {
            if ($film->category) {
                $film->category = $this->mapSectors([$film->category]);
            }
        }

        // Define sectors for the filter dropdown
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

        // Return view with films and sectors data
        return view('film.index', compact('films', 'sectors'));
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

        return view('film.show', compact('filmMaker'));
    }
}
