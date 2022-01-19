@extends('adminlte::page')

@section('title','Bayport | Report Config')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url('report/config/filtro/filtros') }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h3 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Configuration filter edit </strong></h3></center>

    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">  
          <form method="post" id="list" action="{{url('report/config/filtro/filtros/edit/store')}}">
          @csrf
                <input type="" name="user_id" value="{{Auth::user()->id}}" hidden="">
                <input type="" name="id" value="{{$data->id}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name" value="{{$data->name}}"><br>                
                <input type="text" name="value" required autofocus="" class="form-control" placeholder="Columun/Table" value="{{$data->value}}"><br> 
                <select required="" name="type" required autofocus="" class="form-control">
                  <option value="{{$data->type}}"  selected="">{{$data->type}}</option>
                  <option value="date">date</option>
                  <option value="pesquisa">pesquisa</option>
                  <option value="list">list</option>
                  <option value="group">group by</option>
                  <option value="columuns">columuns</option>
                  <option value="<=">less than "<="</option>
                  <option value=">=">greater than ">="</option>
                </select>
              <br>  
              <button type="submit" class="btn ">Save changes</button>
          </form>

  </div>
</div>
 </div>

@stop
