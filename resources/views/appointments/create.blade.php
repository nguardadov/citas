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
       
        <form action="{{url('appointments')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Descripción</label>
                <input type="text" value="{{old('description')}}" 
                    class="form-control" name="description" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Especialidad</label>
                    <select class="form-control" name="specialty_id" id="specialties">
                        <option value="" >--Seleccione una especialidad---</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{$specialty->id}}"
                                @if (old('specialty_id') == $specialty->id)
                                    selected
                                @endif
                            >
                                {{$specialty->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Médico</label>
                    <select class="form-control" name="doctor_id" id="doctor" >
                        <option value="" >--Seleccione una especialidad---</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{$doctor->id}}"
                                @if (old('doctor_id') == $doctor->id)
                                    selected
                                @endif
                            >
                                {{$doctor->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
           
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" 
                        id="date",
                        name="scheduled_date"
                        value="{{old('scheduled_date',date('Y-m-d'))}}"
                        data-date-format="yyyy-mm-dd"
                        data-date-start-date="{{date('Y-m-d')}}"
                        data-data-end-date="+30d"
                        placeholder="Seleccione una fecha" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="">Hora de atención</label>
                <div id="hours">
                    @if ($intervals)
                        @foreach ($intervals['morning'] as $key=>$interval)
                            <div class="custom-control custom-radio mb-3">
                                <input name="scheduled_time" value="{{$interval['start']}}" type="radio" 
                                id="intervalMorning{{$key}}" class="custom-control-input">
                                <label class="custom-control-label" for="intervalMorning{{$key}}">
                                    {{$interval['start']}} - {{ $interval['end']}}
                                </label>
                            </div>
                        @endforeach
                        @foreach ($intervals['afternoon'] as $key=>$interval)
                        <div class="custom-control custom-radio mb-3">
                            <input name="scheduled_time" value="{{$interval['start']}}" type="radio" 
                            id="intervalAfeternoon{{$key}}" class="custom-control-input">
                            <label class="custom-control-label" for="intervalAfeternoon{{$key}}">
                                {{$interval['start']}} - {{ $interval['end']}}
                            </label>
                        </div>
                    @endforeach
                    @else   
                        <div class="alert alert-info" role="alert">
                            Selecciona un médico y una fecha, para ver sus horas disponibles
                        </div>
                    @endif
                   
                </div>
            </div>
            <div class="form-group">
                <label for="">Tipo de Consulta</label>
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" type="radio" id="type1" value="consulta" 
                    @if (old('type')=="consulta")
                        selected
                    @endif
                    name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="type1">Consulta</label>
                  </div>
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" type="radio" id="type2" value="examen"
                    name="customRadio" class="custom-control-input"
                    @if (old('type')=="examen")
                        selected
                    @endif
                    >
                    <label class="custom-control-label" for="type2">Examen</label>
                  </div>
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" type="radio" id="type3" value="operacion"
                    name="customRadio" class="custom-control-input"
                    @if (old('type')=="operacion")
                        selected
                    @endif
                    >
                    <label class="custom-control-label" for="type3">Operación</label>
                  </div>
            </div>
          
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/appointments/create.js')}}"></script>
@endsection
