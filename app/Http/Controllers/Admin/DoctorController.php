<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Specialty;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view("doctors.index",compact("doctors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialites = Specialty::all();
        return view("doctors.create",compact('specialites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->toArray());
        $rules = [
            'name'=>"required|min:3",
            "email"=>"required|email",
            "dni"=>"nullable|digits:8",
            "address"=>"nullable|min:5",
            "phone"=>"nullable|min:6"
        ];

        $this->validate($request,$rules);

        $doctor = new User();
        $doctor->name = $request->input("name");
        $doctor->email = $request->input("email");
        $doctor->dni = $request->input("dni");
        $doctor->address = $request->input("address");
        $doctor->phone = $request->input("phone");
        $doctor->role = "doctor";
        $doctor->password = bcrypt($request->input('password'));
        $doctor->save();
        $doctor->specialites()->attach($request->input('specialties'));
        $notification = "El médico se ha registrado correctamente.";
        return redirect('/doctors')->with(compact("notification"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $doctor = User::doctors()->findOrFail($id);
        $specialites = Specialty::all();
        $speciality_ids = $doctor->specialties()->pluck("specialties.id");
       // dd( $speciality_ids );
        return view("doctors.edit",compact("doctor","specialites","speciality_ids"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'=>"required|min:3",
            "email"=>"required|email",
            "dni"=>"nullable|digits:8",
            "address"=>"nullable|min:5",
            "phone"=>"nullable|min:6"
        ];

        $this->validate($request,$rules);

        $password = $request->input("password");
        $doctor = User::findOrFail($id);
        $doctor->name = $request->input("name");
        $doctor->email = $request->input("email");
        $doctor->dni = $request->input("dni");
        $doctor->address = $request->input("address");
        $doctor->phone = $request->input("phone");
        $doctor->role = "doctor";
        if($password){
            $doctor->password = bcrypt($request->input('password'));
        }
   
        $doctor->save(); //specialites
        $doctor->specialties()->sync($request->input("specialties"));
        $notification = "El médico se ha actualizo correctamente.";
        return redirect('/doctors')->with(compact("notification"));   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctorName= $doctor->name;
        $notification = "El médico $doctorName se eliminado correctamente.";
        $doctor->delete();
        return redirect('/doctors')->with(compact("notification"));  
    }
}
