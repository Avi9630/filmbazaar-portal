<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmBuyer extends Model
{
    //
    protected $guarded = [];
    protected $table = 'film_buyers';

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
