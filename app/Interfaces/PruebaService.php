<?php

namespace App\Interfaces;

use App\Interfaces\ScheduleServiceInterface;
use App\WorkDay;
use Carbon\Carbon;

class PruebaService implements ScheduleServiceInterface
{
    private function getDayFromDate($date){
        $dateCarbon = new Carbon($date);
        //convirtiendo la fecha a dia
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i-1);
        return $day;
    }

    public function getAvilableIntervarls($date,$doctorId){
           //obteniendo la hora por dia
           $WorkDay=WorkDay::where('active',true)
           ->where('day',$this->getDayFromDate($date))
           ->where('user_id',$doctorId)
           ->first([
               "moring_start",
               "moring_end",
               "afternoon_start",
               "afternoon_end"
           ]);
   
           if($WorkDay){
               $moriningStart = new Carbon($WorkDay->moring_start);
               $moriningEnd = new Carbon($WorkDay->moring_end);
       
               $moriningIntervals = $this->getInterval($moriningStart,$moriningEnd);
       
               $afternoonStart = new Carbon($WorkDay->afternoon_start);
               $afternoonEnd = new Carbon($WorkDay->afternoon_end);
       
               $afternoonIntervals = $this->getInterval($afternoonStart,$afternoonEnd);
               $data = [];
               $data["morning"] = $moriningIntervals;
               $data["afternoon"]=$afternoonIntervals;
       
               return $data;
           }else{
               return [];
           }
           
    }

    private function getInterval($start,$end){
        $start = new Carbon($start);
        $end = new Carbon($end);
        $intervals = [];
        while($start < $end){
            $interval = [];
            $interval["start"]=$start->format('g:i A');
            $start->addMinutes(30);
            $interval["end"]=$start->format('g:i A');
            $intervals [] = $interval;
        }

        return $intervals;
    }
}