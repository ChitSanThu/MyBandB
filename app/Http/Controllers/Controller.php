<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $m=2;
    private $y=2020;

    public function setter($inc){
         $this->m += $inc;

    }

    public function getMonth(){
        return $this->m;
    }
    public function getYear(){
        return $this->y;
    }
//    function __construct($inc)
//    {
//        $this->setter($inc);
//        echo $this->getMonth();
//    }


}
