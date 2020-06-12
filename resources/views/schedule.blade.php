@extends('layouts.panel')

@section('content')
<form action="{{url('/schedule')}}" method="POST">
    @csrf
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                <h3 class="mb-0">Gestionar Horarios</h3>
                </div>
                <div class="col text-right">
                <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session("notification"))
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session("notification")}}
                </div>
            @endif
        </div>
        <div class="table-responsive">
        <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">D&iacute;a</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Turno ma&ntilde;ana</th>
                    <th scope="col">Turno Tarde</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($workDays as $key=>$workDay)
                    <tr>
                        <th scope="row">
                        {{$days[$key]}}
                        </th>
                        <td>
                            <label class="custom-toggle">
                              <input type="checkbox" name="active[]" value="{{$key}}"
                              @if ($workDay->active)checked @endif>
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="morning_start[]">
                                         @for ($i = 5; $i <= 11; $i++)
                                             <option value="{{$i}}:00"
                                                @if ($i.':00 AM'== $workDay->moring_start )
                                                selected    
                                                @endif
                                             >
                                                {{$i}}:00 AM
                                            </option>
                                             <option value="{{$i}}:30"
                                                @if ($i.':30 AM'== $workDay->moring_start )
                                                selected    
                                                @endif
                                             >
                                                {{$i}}:30 PM
                                            </option>
                                         @endfor
                                     </select>
                                </div>
                                <div class="col">
                                     <select class="form-control" name="morning_end[]">
                                         @for ($i = 5; $i < 11; $i++)
                                             <option value="{{$i}}:00" 
                                                @if ($i.':00 AM'== $workDay->moring_end )
                                                selected    
                                                @endif
                                             >{{$i}}:00 Am</option>
                                             <option value="{{$i}}:30"
                                                @if ($i.':30 AM'== $workDay->moring_end )
                                                selected    
                                                @endif
                                             >{{$i}}:30 AM</option>
                                         @endfor
                                     </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                     <select class="form-control" name="afternoon_start[]">
                                         @for ($i = 1; $i <= 11; $i++)
                                             <option value="{{$i+12}}:00"
                                                @if ($i.':00 PM'== $workDay->afternoon_start )
                                                selected    
                                                @endif
                                             >{{$i}}:00 Pm</option>
                                             <option value="{{$i+12}}:30"
                                                @if ($i.':30 PM'== $workDay->afternoon_start )
                                                selected    
                                                @endif
                                             >{{$i}}:30 Pm</option>
                                         @endfor
                                     </select>
                                </div>
                                <div class="col">
                                     <select class="form-control" name="afternoon_end[]">
                                         @for ($i = 1; $i < 11; $i++)
                                             <option value="{{$i+12}}:00"
                                                @if ($i.':00 PM'== $workDay->afternoon_end )
                                                selected    
                                                @endif
                                             >{{$i}}:00 pm</option>
                                             <option value="{{$i+12}}:30"
                                                @if ($i.':30 PM'== $workDay->afternoon_end )
                                                selected    
                                                @endif
                                             >{{$i}}:30 pm</option>
                                         @endfor
                                     </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
           
        </div>
      
    </div>
</form>

@endsection
