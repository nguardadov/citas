<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function hours(Request $request){
        $rules = [
            'date'=>'required|date_format:"Y-m-d"',
            'doctor_id'=>"required|exists:users,id"
        ];

        $this->validate($request,$rules);
        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        //convirtiendo la fecha a dia
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i-1);
        $doctorId = $request->input('doctor_id');

        //obteniendo la hora por dia
        $WorkDay=WorkDay::where('active',true)
        ->where('day',$day)
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
    
            $afternoonStart = new Carbon($WorkDay->moring_start);
            $afternoonEnd = new Carbon($WorkDay->moring_end);
    
            $afternoonIntervals = $this->getInterval($afternoonStart,$afternoonEnd);
            $data = [];
            $data["morning"] = $moriningIntervals;
            $data["afternoon"]=$afternoonIntervals;
    
            return $data;
        }else{
            return [];
        }
        

       
    }


    public function getInterval($start,$end){
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
