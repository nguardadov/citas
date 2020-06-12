<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){
        $spcialties = Specialty::all();
        return view('appointments.create',compact('spcialties'));
    }

    public function store(){}
}
