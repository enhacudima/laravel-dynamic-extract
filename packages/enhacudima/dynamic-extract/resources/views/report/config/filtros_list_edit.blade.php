@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Report Config')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url('report/config/filtro/list') }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h3 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Configuration List </strong></h3></center>

    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">
          <form method="post" id="list" action="{{url('report/config/filtro/list/edit/store')}}">
          @csrf
                <input type="" name="user_id" value="{{Auth::user()->id ?? 0}}" hidden="">
                <input type="" name="id" value="{{$data->id}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name" value="{{$data->name}}"><br>
                <select required="" name="report_new_filtro_id" required autofocus="" class="form-control">
                  <option value="{{$data->report_new_filtro_id}}"selected="">{{$data->filtro->name}}</option>
                  @foreach($filtros as $filtro)
                    <option value="{{$filtro->id}}">{{$filtro->name}}</option>
                  @endforeach
                </select>
              <br>
              <button type="submit" class="btn ">Save changes</button>
          </form>

  </div>
</div>
 </div>

@stop
