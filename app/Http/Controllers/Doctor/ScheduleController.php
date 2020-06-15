<?php

namespace App\Http\Controllers\Doctor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function edit(){
        $days = ["Lunes","Martes","Miércoles",
                 "Jueves","Viernes","Sábado","Domingo"];

        $scheludes = WorkDay::where('user_id',"=",auth()->user()->id)->get();
        if(count($scheludes) > 0){
            $workDays = $scheludes->map(function($workDay){
                $workDay->moring_start = (new Carbon($workDay->moring_start))->format('g:i A');
                $workDay->moring_end = (new Carbon($workDay->moring_end))->format('g:i A');
                $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
                $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
                return $workDay;
            });
        }else{
            $workDays = collect();
            for ($i=0; $i <7 ; $i++) { 
                $workDays->push(new WorkDay());
            }
        }
      
       // dd($workDays->toArray());
        return view('schedule',compact("days","workDays"));
    }

    public function store(Request $request){
        $active = $request->input('active');
        $morning_start = $request->input("morning_start");
        $morning_end = $request->input("morning_end");
        $afternoon_start = $request->input("afternoon_start");
        $afternoon_end = $request->input("afternoon_end");
        
        try {
           DB::beginTransaction();
            for ($i=0; $i < 7 ; ++$i) { 
               WorkDay::updateOrCreate([
                   'day'=>$i,
                   'user_id'=>auth()->user()->id
               ],[
                   'active' => in_array($i,$active),
                   "moring_start"=>$morning_start[$i],
                   "moring_end"=>$morning_end[$i],
                   "afternoon_start"=>$afternoon_start[$i],
                   "afternoon_end"=>$afternoon_end[$i],
               ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
        }
        

        return back();
    }
}
