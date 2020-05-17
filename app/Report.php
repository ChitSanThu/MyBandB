<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'custom_reports';
    protected $fillable=[
        "content",
        "price",
        "type"
    ];
}
