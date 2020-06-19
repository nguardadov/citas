<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
    public function getAvilableIntervarls($date,$doctorId);
    public function isAvailableInterval($date,$doctorId, Carbon $start);
}