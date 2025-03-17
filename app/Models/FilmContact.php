<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmContact extends Model
{
    //
    protected $guarded = [];
    public function countryRelation()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
    public function profileDoc()
    {
        return $this->belongsTo(Image_temp::class, 'profile', 'id');
    }
}
