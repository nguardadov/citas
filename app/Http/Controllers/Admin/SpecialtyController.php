<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->performValidation($request);
        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();
        $notification = "Se creo la especialidad correctamente";
        return redirect("/specialties")->with(compact('notification'));

    }

    public function update(Request $request,Specialty $specialty)
    {

        $this->performValidation($request);

        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();

        $notification = "Se actualizo la especialidad correctamente";
        return redirect("/specialties")->with(compact("notification"));

    }

    public function destroy(Specialty $specialty)
    {
        //dd($specialty);
        $deleted = $specialty->name;
        $specialty->delete();
        $notification = "Se eliminino la especialidad '".$deleted."' de manera correcta";
        return redirect("/specialties")->with(compact("notification"));
    }


    protected function performValidation(Request $request){
        $rules = [
            "name" => "required|min:3"
        ];

        $messages = [
            "name.required" => "Es necesario ingresar un nombre.",
            "name.min" => "Como mínimo el nombre debe tener 3 caracteres."
        ];

        $this->validate($request,$rules,$messages);
    }
}
