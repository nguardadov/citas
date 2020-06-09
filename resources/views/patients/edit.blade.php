@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Actualizar Paciente</h3>
            </div>
            <div class="col text-right">
            <a href="{{url('patients')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
       
        <form action="{{url('patients/'.$patient->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{old('name',$patient->name)}}" required>
            </div>
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="text" class="form-control" placeholder="E-mail" name="email" value="{{old('email',$patient->email)}}" required>
            </div>
            <div class="form-group">
                <label for="">DNI</label>
                <input type="text" class="form-control" placeholder="dni" name="dni" value="{{old('dni',$patient->dni)}}" >
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" class="form-control" placeholder="direccion" name="address" value="{{old('address',$patient->address)}}" >
            </div>
            <div class="form-group">
                <label for="">T&eacute;lefono</label>
                <input type="text" class="form-control" placeholder="Télefono" name="phone" value="{{old('phone',$patient->phone)}}" >
            </div>
            <div class="form-group">
                <label for="">Contrse&ntilde;a</label>
            <input type="text" class="form-control" placeholder="Password" name="password" value="" >
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
