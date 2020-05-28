<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $specialties = Specialty::select("id","name","description")
        ->orderBy("id","desc")
        ->paginate(10);
       // dd($specialties);
        return view("especialties.index",compact('specialties'));
    }

    public function create(){
        return view("especialties.create");
    } 

    public function edit(Specialty $specialty){
        return view("especialties.edit",compact("specialty"));
    } 

    public function store(Request $request)
    {

        $rules = [
            "name" => "required|min:3"
        ];

        $messages = [
            "name.required" => "Es necesario ingresar un nombre.",
            "name.min" => "Como mínimo el nombre debe tener 3 caracteres."
        ];

        $this->validate($request,$rules,$messages);

        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();

        return redirect("/specialties");

    }

    public function update(Request $request,Specialty $specialty)
    {

        $rules = [
            "name" => "required|min:3"
        ];

        $messages = [
            "name.required" => "Es necesario ingresar un nombre.",
            "name.min" => "Como mínimo el nombre debe tener 3 caracteres."
        ];

        $this->validate($request,$rules,$messages);

        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();

        return redirect("/specialties");

    }

    public function destroy(Specialty $specialty)
    {
        //dd($specialty);
        $specialty->delete();
        return redirect("/specialties");
    }
}
