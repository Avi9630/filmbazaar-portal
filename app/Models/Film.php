<?php

namespace App\Models;

use App\Libraries\Constant;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Model;
use DB;

class Film extends Model
{
    protected $guarded = [];
    protected $table = 'films';
    public function documents()
    {
        return $this->hasMany(FilmDocument::class, 'film_id', 'id'); // Corrected relationship
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    static function languages($id)
    {
        if (is_string($id)) {
            $id = json_decode($id, true);
        }
        if (!is_array($id)) {
            return [];
        }
        $languageNames = Language::whereIn('id', $id)->pluck('name')->toArray();
        return $languageNames;
    }

    static function countries($id)
    {
        if (is_string($id)) {
            $id = json_decode($id, true);
        }
        if (!is_array($id)) {
            return [];
        }
        $countryNames = Country::whereIn('id', $id)->pluck('name')->toArray();
        return $countryNames;
    }

    static function lookingFor($ids)
    {
        $data = '';
        if (!empty($ids)) {
            $countryNames = Constant::lookingForOptions();
            if (is_string($ids)) {
                $ids = json_decode($ids);
            }
            $selectedOptions = [];
            foreach ($ids as $id) {
                if (isset($countryNames[$id])) {
                    $selectedOptions[] = $countryNames[$id];
                }
            }
            $data = implode(', ', $selectedOptions);
        }
        return $data;
    }

    static function genre($ids)
    {
        $data = '';
        if (!empty($ids)) {
            $genre = Constant::genre();
            $genreAssociations = [];
            foreach ($genre as $g) {
                $genreAssociations[$g['id']] = $g['name'];
            }
            if (is_string($ids)) {
                $ids = json_decode($ids);
            }
            $selectedOptions = [];
            foreach ($ids as $id) {
                if (isset($genreAssociations[$id])) {
                    $selectedOptions[] = $genreAssociations[$id];
                }
            }
            $data = implode(', ', $selectedOptions);
        }
        return $data;
    }

    static function type($id)
    {
        $data = DB::table('film_types')->where('id', $id)->pluck('name')->toArray();
        $data = implode(', ', $data);
        return $data;
    }

    static function monthName($value)
    {
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        if (isset($months[$value])) {
            return $months[$value];
        }
        return 'Invalid month value';
    }

    static function printFormat($id)
    {
        $printFormat = Constant::printFormat();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }

    static function aspectRatio($id)
    {
        $printFormat = Constant::aspectRatio();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }
    static function soundFormat($id)
    {
        $printFormat = Constant::soundFormat();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }

    static function category($id)
    {
        $printFormat = Constant::category();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }

    static function videographyType($id)
    {
        $printFormat = Constant::videographyType();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        if (!empty($printFormatAssociations[$id])) {
            $data = $printFormatAssociations[$id];
            return $data;
        }
    }

    static function formatType($id)
    {
        $printFormat = Constant::formatType();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }
    static function stageType($id)
    {
        $printFormat = Constant::stageType();
        $printFormatAssociations = [];
        foreach ($printFormat as $print) {
            $printFormatAssociations[$print['id']] = $print['name'];
        }
        $data = $printFormatAssociations[$id];
        return $data;
    }

    static function filmType($value) 
    {
        $filmTypes = [
            1 => "Documentary Mid-length",
            2 => "Documentary Short",
            3 => "Fiction Mid-length",
            4 => "Fiction Short",
            5 => "Hybrid Feature",
            6 => "Fiction Feature",
            7 => "Documentary Feature",
            8 => "Animation Feature",
        ];
        if (isset($filmTypes[$value])) {
            return $filmTypes[$value];
        }
        return 'Invalid month value';

        
    }

    
}
