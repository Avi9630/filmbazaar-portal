<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];
    protected $table = 'Countries';

    public function filmMakers()
    {
        return $this->hasMany(FilmMaker::class);
    }
}
