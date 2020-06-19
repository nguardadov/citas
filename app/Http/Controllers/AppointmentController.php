<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Interfaces\ScheduleServiceInterface;
use App\Services\ScheduleServices;
use App\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function create(ScheduleServices $scheduleServices){
        $specialties = Specialty::all();
        $specialtyId = old('specialty_id'); 
        if($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        }else{
            $doctors = collect();
        }

        $date = old('scheduled_date');
        $doctorId = old('doctor_id');

        if($date && $doctorId){
            $intervals = $scheduleServices->getAvilableIntervarls($date,$doctorId);
        }else{
            $intervals = null;
        }

        return view('appointments.create',compact('specialties','doctors','intervals'));
    }

    public function store(Request $request, ScheduleServiceInterface $scheduleServiceInterface){

        $rules = [
            'description'=>'required',
            'specialty_id'=>'required|exists:specialties,id',
            'doctor_id'=> 'required|exists:users,id',
            'scheduled_time'=>'required',
            'type' =>'required',
        ];

        $messages = [
            'scheduled_time.required'=>'Por favor seleccione una hora válida para su cita',
            'type.required'=>'Por favor seleccione un tipo de consulta',
            'doctor_id.required' => 'Seleccione un medico',
            'specialty_id.required'=>'Seleccione un especialidad'
        ];

        
        $validator = Validator::make($request->all(),$rules,$messages);

        $validator->after(function($validator) use ($request,$scheduleServiceInterface)
        {
            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');
            //añadir errores sobre validator
            if($date && $doctorId && $scheduled_time)
            {
                $start = new Carbon($scheduled_time);
            }else{
                return;
            }
            if(!$scheduleServiceInterface->isAvailableInterval($date,$doctorId,$start)){
                $validator->errors()
                    ->add('available_time','La hora seleccionada ya se encuentra registrada por otro paciente');
            }
        });

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $request->only([
            'description',
            'specialty_id',
            'doctor_id',
            'patient_id',
            'scheduled_date',
            'scheduled_time',
            'type',
        ]);
        $data['patient_id']=auth()->user()->id;
        
        $carbonTime = Carbon::createFromFormat('g:i A',$data['scheduled_time']);
        
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        //dd($data);
        Appointment::create($data);

        $notification = "La cita se ha registrado correctamente!";

        return back()->with(compact('notification'));
    }
}
