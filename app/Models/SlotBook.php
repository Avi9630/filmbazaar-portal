<?php

// app/Models/SlotBook.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotBook extends Model
{
    protected $table = 'slot_book';
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'createdAt', 'updatedAt', 'maker_id'
    ];

    // If you want to format timestamps automatically
    protected $dates = ['createdAt', 'updatedAt'];
}
