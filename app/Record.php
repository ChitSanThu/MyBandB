<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
   protected $fillable=[
        'report_name',
        'report_content',
        'report_price'
   ];
}
