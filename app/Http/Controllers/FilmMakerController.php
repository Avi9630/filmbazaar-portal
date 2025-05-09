<?php

namespace App\Http\Controllers;

use App\Models\FilmMaker;
use Illuminate\Http\Request;

class FilmMakerController extends Controller
{
    private  $sectors = [
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

    // Function to list Film Makers with Pagination and Search
    private function downloadCsv($request)
    {

        $filename = "film_makers_" . date('Y-m-d') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $search         = trim($request->input('name'));
        $email          = trim($request->input('email'));
        $company        = trim($request->input('company'));
        $sector         = trim($request->input('sector'));
        $status         = trim($request->input('status'));
        $paymentStatus  = trim($request->input('paymentStatus'));
        $asigned_b2b    = trim($request->input('asigned_b2b'));
        $from_waves    =   trim($request->input('from_waves'));
        $agree_for_meeting    =   trim($request->input('agree_for_meeting'));
        if ($paymentStatus === '0') {
            $paymentStatus = null;
        }

        // Fetch Film Makers
        $filmMakers = FilmMaker::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
            });
        })
            ->when($email, fn($query) => $query->where('email', 'like', "%$email%"))
            ->when($asigned_b2b, fn($query) => $query->where('asigned_b2b', 'like', "%$asigned_b2b%"))
            ->when($company, fn($query) => $query->where('company', 'like', "%$company%"))
            ->when($sector, fn($query) => $query->whereJsonContains('sectors', (int)$sector))
            ->when($status, fn($query) => $query->where('status', $status))
            ->when($paymentStatus, fn($query) => $query->where('payed', $paymentStatus))
            ->when(isset($from_waves) && $from_waves !== '', function ($query) use ($from_waves) {
                return $query->where('from_waves', (int)$from_waves);
            })
            ->when(isset($agree_for_meeting) && $agree_for_meeting !== '', function ($query) use ($agree_for_meeting) {
                return $query->where('agree_for_meeting', (int)$agree_for_meeting);
            })
            ->orderBy('id', 'DESC')
            ->get(); // ⚠️ Don't forget to call `get()` to retrieve results



        $callback = function () use ($filmMakers) {
            $file = fopen('php://output', 'w');
            //  echo  "test1";
            // CSV headers
            fputcsv($file, ['Name', 'Email', 'Company', 'Status', 'Payment Status', "Send To B2b", 'Company Profile', 'Designation', 'Country', 'Sector', "phone number", "Form Waves", "agree_for_meeting", "about_us"]);

            // CSV rows
            foreach ($filmMakers as $filmMaker) {
                //  echo  "test1";
                $name = trim($filmMaker->first_name . ' ' . $filmMaker->last_name);
                $sectors = [];
                if (!empty($filmMaker->sectors)) {
                    $sectorIds = is_array($filmMaker->sectors) ? $filmMaker->sectors : json_decode($filmMaker->sectors, true);

                    if (is_array($sectorIds)) {
                        foreach ($sectorIds as $id) {
                            $matched = array_filter($this->sectors, function ($sector) use ($id) {
                                return $sector['id'] == $id;
                            });

                            if (!empty($matched)) {
                                $sector = reset($matched);
                                $sectors[] = $sector['name'];
                            }
                        }
                    }
                }
                fputcsv($file, [
                    $name,
                    $filmMaker->email,
                    $filmMaker->company,
                    //$sectorNames,
                    $filmMaker->status,
                    ($filmMaker->payed == 1) ? 'Paid' : 'Unpaid',
                    $filmMaker->asigned_b2b ? 'Already Send' : 'Not Send Yet',
                    $filmMaker->company_profile,
                    $filmMaker->job_profile,
                    $filmMaker?->country?->name,
                    implode(', ', $sectors),
                    $filmMaker->phone_number,
                    $filmMaker->from_waves,
                    $filmMaker->agree_for_meeting,
                    $filmMaker->about_us,
                ]);
            }

            fclose($file);
        };
        //  die("test");
        return response()->stream($callback, 200, $headers);
    }
    public function index(Request $request)
    {

        if ($request->has('download')) {
            return $this->downloadCsv($request);
        }

        $search         =   trim($request->input('name'));
        $email          =   trim($request->input('email'));
        $company        =   trim($request->input('company'));
        $sector         =   trim($request->input('sector'));
        $status         =   trim($request->input('status'));
        $paymentStatus  =   trim($request->input('paymentStatus'));
        $asigned_b2b    =   trim($request->input('asigned_b2b'));
        $from_waves    =   trim($request->input('from_waves'));
        $agree_for_meeting    =   trim($request->input('agree_for_meeting'));

        if ($paymentStatus === 0) {
            $paymentStatus = NULL;
        }

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
            ->when($asigned_b2b, function ($query, $asigned_b2b) {
                return $query->where('asigned_b2b', 'like', '%' . $asigned_b2b . '%');
            })
            ->when($company, function ($query, $company) {
                return $query->where('company', 'like', '%' . $company . '%');
            })
            ->when($sector, function ($query, $sector) {
                return $query->whereJsonContains('sectors', (int)$sector); // Assuming 'sectors' is a JSON field
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($paymentStatus, function ($query, $paymentStatus) {
                return $query->where('payed', $paymentStatus);
            })
            ->when(isset($from_waves) && $from_waves !== '', function ($query) use ($from_waves) {
                return $query->where('from_waves', (int)$from_waves);
            })
            ->when(isset($agree_for_meeting) && $agree_for_meeting !== '', function ($query) use ($agree_for_meeting) {
                return $query->where('agree_for_meeting', (int)$agree_for_meeting);
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
