<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=[
        'title',
        'address',
        'phone',
        'logo',
        'tax',

    ];
}
