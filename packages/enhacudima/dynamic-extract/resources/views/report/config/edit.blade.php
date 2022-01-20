@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Config Edit Report')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h5 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Edit </strong></h5></center>

    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">
          <form method="post" id="list" action="{{url('report/config/store/edit')}}">
          @csrf
                <input type="" name="user_id" value="{{Auth::user()->id ?? 0}}" hidden="">
                <input type="" name="id" value="{{$data->id}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name" value="{{$data->name}}"><br>
                <input type="text" name="comments" required autofocus="" class="form-control" placeholder="Comments" value="{{$data->comments}}"><br>
                <select name="can" required="" autofocus="" class="form-control">
                  <option value="{{$data->can}}"  selected="">{{$data->can}}</option>
                  @foreach($permissions as $permission)
                    @if(Auth::user()->can($permission->name))
                      <option value="{{$permission->name}}">{{$permission->name}}</option>
                    @endif
                  @endforeach
                </select><br>
                <select name="filtro" autofocus="" class="form-control">
                  @if(isset($data->filtro_r->id))
                    <option value="{{$data->filtro_r->id}}" selected="">{{$data->filtro_r->name}}</option>
                    @else
                    <option value="" selected="">Select filter..</option>
                  @endif
                  @foreach($filtros as $filtro)
                  <option value="{{$filtro->id}}">{{$filtro->name}}</option>
                  @endforeach
                  <option value="" >No filter..</option>
                </select>
                <br>
                <select name="table_name" class="form-control">
                  <option value="{{$data->table->id}}"  selected="">{{$data->table->name}}</option>
                  @foreach($tables as $table)
                  <option value="{{$table->id}}">{{$table->name}}</option>
                  @endforeach
                </select><br>
              <button type="submit" class="btn ">Save changes</button>
          </form>

  </div>
</div>
 </div>

@stop
