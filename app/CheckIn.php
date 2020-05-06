<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class CheckIn extends Model
{

    protected $fillable=[
        'start_day',
        'end_day',
        'room_number',
        'name',
        'father_name',
        'phone',
        'nrc',
        'gender',
        'age',
        'nation',
        'job',
        'address',
        'state',
        'guest_status',
        'month',
        'year',
        'row_record'

    ];
}
