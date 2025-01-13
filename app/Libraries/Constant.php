<?php

namespace App\Libraries;

use Exception;
use Illuminate\Support\Facades\Validator;

class Constant
{
    static function lookingForOptions()
    {
        $lookingFor = [
            1 => 'Gap Financing/Finishing Funds/P&A Funds',
            2 => 'Sales and Distribution',
            3 => 'Film Festival',
        ];
        return $lookingFor;
    }

    static function companyType()
    {
        $data = [['id' => 1, 'name' => 'Producer'], ['id' => 2, 'name' => 'Agency'], ['id' => 3, 'name' => 'Platform'], ['id' => 4, 'name' => 'Others']];
        return $data;
    }

    static function formatType()
    {
        $data = [['id' => 1, 'name' => 'Featured'], ['id' => 2, 'name' => 'Non Featured'], ['id' => 3, 'name' => 'Documentary'], ['id' => 4, 'name' => 'Web Series']];
        return $data;
    }
    static function stageType()
    {
        
        $data = [['id' => 1, 'name' => 'Script'], ['id' => 2, 'name' => 'Co-Production'], ['id' => 3, 'name' => 'Work In Progress'], ['id' => 4, 'name' => 'Film Ready For Distribution'], ['id' => 5, 'name' => 'Work In Progress'], ['id' => 6, 'name' => 'Completed']];
        return $data;
    }


    static function videographyType()
    {
        $data = [['id' => 1, 'name' => 'Animation'], ['id' => 2, 'name' => 'Live Shoot']];
        return $data;
    }

    static function genre()
    {
        $data = [['id' => 1, 'name' => 'Action'], ['id' => 2, 'name' => 'Arts, Music and Culture'], ['id' => 3, 'name' => 'Comedy'], ['id' => 4, 'name' => 'Cultural Figure'], ['id' => 5, 'name' => 'Drama'], ['id' => 6, 'name' => 'Fantasy'], ['id' => 7, 'name' => 'Horror'], ['id' => 8, 'name' => 'Mystery'], ['id' => 9, 'name' => 'Others'], ['id' => 10, 'name' => 'Romance'], ['id' => 11, 'name' => 'Thriller']];
        return $data;
    }

    static function soundFormat()
    {
        $data = [['id' => 1, 'name' => '5.1'], ['id' => 2, 'name' => '7.1'], ['id' => 3, 'name' => 'Atmos'], ['id' => 4, 'name' => 'Dolby'], ['id' => 5, 'name' => 'Silent'], ['id' => 6, 'name' => 'Stereo']];
        return $data;
    }

    static function aspectRatio()
    {
        $data = [['id' => 1, 'name' => '16:10'], ['id' => 2, 'name' => '16:9'], ['id' => 3, 'name' => '2.21:1'], ['id' => 4, 'name' => '2.39:1'], ['id' => 5, 'name' => '2:1'], ['id' => 6, 'name' => '4:3'], ['id' => 7, 'name' => '5:4'], ['id' => 8, 'name' => 'Other']];
        return $data;
    }

    static function printFormat()
    {
        $data = [['id' => 1, 'name' => '2K'], ['id' => 2, 'name' => '35mm'], ['id' => 3, 'name' => '4K'], ['id' => 4, 'name' => '70mm'], ['id' => 5, 'name' => 'HD'], ['id' => 6, 'name' => 'Other'], ['id' => 7, 'name' => 'SD']];
        return $data;
    }

    static function category()
    {
        $data = [['id' => 1, 'name' => 'Film'], ['id' => 2, 'name' => 'TV'], ['id' => 3, 'name' => 'Gaming and Esports'], ['id' => 4, 'name' => 'Radio and Podcasts'], ['id' => 5, 'name' => 'Music and Sound'], ['id' => 6, 'name' => 'Internet Advertising'], ['id' => 7, 'name' => 'Influencer Marketing'], ['id' => 8, 'name' => 'Out of Home Media'], ['id' => 9, 'name' => 'AVGC-XR'], ['id' => 10, 'name' => 'Print (Newspapers, Magazine)'], ['id' => 11, 'name' => 'Live Event'], ['id' => 12, 'name' => 'Startup'], ['id' => 13, 'name' => 'AR/VR']];
        return $data;
    }
}
