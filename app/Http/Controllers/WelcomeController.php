<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmMaker;
use App\Models\FilmBuyer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $dates = [];
        $filmCounts = [];
        $filmMakerCounts = [];
        $filmBuyerCounts = [];

        // Loop through the past 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            // Get the count of films and film makers for the specific date
            $filmCounts[] = Film::whereDate('createdAt', $date)->count();
            $filmMakerCounts[] = FilmMaker::whereDate('createdAt', $date)->count();
            $filmBuyerCounts[] = FilmBuyer::whereDate('createdAt', $date)->count();
        }

        // Calculate total counts
        $totalFilms = Film::count();
        $totalFilmMakers = FilmMaker::count();
        $totalFilmMakers = FilmMaker::count();
        $totalFilmBuyers  = FilmBuyer::count();


        $sectors = [
            ['id' => 1, 'name' => 'Film'],
            ['id' => 2, 'name' => 'TV/Webseries'],
            ['id' => 3, 'name' => 'Gaming and Esports'],
            ['id' => 4, 'name' => 'Radio and Podcasts'],
            ['id' => 5, 'name' => 'Music and Sound'],
            ['id' => 6, 'name' => 'Advertising'], // internet and out of home media
            ['id' => 7, 'name' => 'Influencer Marketing'],
            ['id' => 8, 'name' => 'Comics Or Graphics'],
            ['id' => 9, 'name' => 'Animation & VFX Services'],
            ['id' => 10, 'name' => 'Print (Newspapers, Magazine)'],
            ['id' => 11, 'name' => 'Live Event'],
            // ['id' => 12, 'name' => 'Startup'],
            ['id' => 13, 'name' => 'AR/VR'],
            // ['id' => 14, 'name' => 'Comics Or Graphics'],
            // ['id' => 15, 'name' => 'Animation']
        ];

        $sectorWiseData = [];

        // Loop through each sector to get the counts for film makers and film buyers
        foreach ($sectors as $sector) {
            $sectorWiseData[$sector['id']] = [
                'sector' => $sector['name'],
                'filmMakers' => FilmMaker::whereJsonContains('sectors', $sector['id'])->count(),
                'filmBuyers' => FilmBuyer::whereJsonContains('segments', $sector['id'])->count(),
                'film' => Film::where('category', $sector['id'])->count(),
            ];
        }

        // Pass data to the view
        return view('welcome', compact('sectorWiseData', 'totalFilmBuyers', 'filmBuyerCounts', 'dates', 'filmCounts', 'filmMakerCounts', 'totalFilms', 'totalFilmMakers'));
    }
}
