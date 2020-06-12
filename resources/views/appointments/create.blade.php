@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Registrar nueva cita</h3>
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
       
        <form action="{{url('patients')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Especialidad</label>
                <select class="form-control" name="specialty">
                    <option value="" disabled selected>--Seleccione una opcion---</option>
                    @foreach ($spcialties as $spcialtie)
                        <option value="{{$spcialtie->id}}">
                            {{$spcialtie->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Médico</label>
                <select class="form-control" name="doctor"></select>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" placeholder="Seleccione una fecha" type="text" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="">Hora de atención</label>
                <input type="text" class="form-control" placeholder="direccion" name="address" value="{{old('address')}}" >
            </div>
            <div class="form-group">
                <label for="">T&eacute;lefono</label>
                <input type="text" class="form-control" placeholder="Télefono" name="phone" value="{{old('phone')}}" >
            </div>
          
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection
