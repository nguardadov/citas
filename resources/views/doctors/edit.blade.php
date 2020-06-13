@extends('layouts.panel')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Editar Médico</h3>
            </div>
            <div class="col text-right">
            <a href="{{url('doctors')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
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
       
        <form action="{{url('doctors/'.$doctor->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{old('name',$doctor->name)}}" required>
            </div>
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="text" class="form-control" placeholder="E-mail" name="email" value="{{old('email',$doctor->email)}}" required>
            </div>
            <div class="form-group">
                <label for="">DNI</label>
                <input type="text" class="form-control" placeholder="dni" name="dni" value="{{old('dni',$doctor->dni)}}">
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" class="form-control" placeholder="direccion" name="address" value="{{old('address',$doctor->address)}}">
            </div>
            <div class="form-group">
                <label for="">Télefono</label>
                <input type="text" class="form-control" placeholder="Télefono" name="phone" value="{{old('phone',$doctor->phone)}}">
            </div>
            <div class="form-group">
                <label for="">Contrase&ntilde;a</label>
                <input type="text" class="form-control" placeholder="Contraseña" name="password">
                <p>Ingrese un valor si desea modificar la contrase&ntilde;a</p>
            </div>
            <div class="form-group">
                <label for="">Especialidades</label>
                <select class="form-control selectpicker" name="specialties[]" id="specialties"
                    title="Seleccione una especialidad" multiple data-style="btn-outline-primary">
                    @foreach ($specialites as $specialty)
                        <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                    @endforeach
                  </select>
                  
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $("document").ready(()=>{
        $("#specialties").selectpicker('val',@json($speciality_ids));
    });
</script>
@endsection
