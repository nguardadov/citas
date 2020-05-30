@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Agregar Médico</h3>
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
       
        <form action="{{url('doctors')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{old('name')}}" required>
            </div>
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="text" class="form-control" placeholder="E-mail" name="email" value="{{old('email')}}" required>
            </div>
            <div class="form-group">
                <label for="">DNI</label>
                <input type="text" class="form-control" placeholder="dni" name="dni" value="{{old('dni')}}" required>
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" class="form-control" placeholder="direccion" name="address" value="{{old('address')}}" required>
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" class="form-control" placeholder="Télefono" name="phone" value="{{old('phone')}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
