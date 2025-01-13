<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmMaker extends Model
{
    //
    protected $guarded = [];
    protected $table = 'film_makers';
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
