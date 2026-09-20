<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class timeController extends Controller
{
    public function MakeTimeSheet()
    {
        $Times = [];
        $startTime = new DateTime('00:00');
        $endTime = new DateTime('23:59');

        while ($startTime <= $endTime) {
            $Times[] = $startTime->format('H:i');
            $startTime->modify('+15 minutes');
        }
        return $Times;
    }
}
