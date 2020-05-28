@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Especialidades</h3>
            </div>
            <div class="col text-right">
            <a href="{{url('specialties')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
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
       
        <form action="{{url('specialties/'.$specialty->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Nombre de la especialidad</label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{old('name',$specialty->name)}}" required>
            </div>
            <div class="form-group">
                <label for="">Descripcion</label>
                <input type="text" class="form-control" placeholder="descripción" name="description" value="{{old('description',$specialty->description)}}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
