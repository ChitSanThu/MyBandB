<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptRecord extends Model
{
    protected $fillable=[
        'guest_id',
        'name',
        'nrc_no',
        'total',
        'comment',
        'status'

    ];
    public function checkin(){
        return $this->belongsTo('App\CheckIn'); 
    }
}
