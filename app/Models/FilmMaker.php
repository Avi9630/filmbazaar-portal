<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Libraries\Constant;

class FilmMaker extends Model
{
    //
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'film_makers';

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    static function companyType($id)
    {
        $companyType = Constant::companyType();
        if ($companyType[$id]) return $companyType[$id];
        return $id;
    }

    static function getSector($ids)
    {
        if ($ids) {
            $ids = json_decode($ids, true);

            $categories = Constant::categories();
            $data = array();
            foreach ($ids as $key => $value) {
                if (!empty($categories[$value]))
                    $data[] = $categories[$value];
            }
            return implode(",", $data);
        }
    }
}
