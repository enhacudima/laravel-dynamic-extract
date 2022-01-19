@extends('adminlte::page')

@section('title','Bayport | Report Config')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url('report/config/filtro') }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h3 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Configuration group filter edit </strong></h3></center>

    </div>
    <div class="card-body">

    <div class="card-body table-responsive no-padding">  
          <form method="post" id="list" action="{{url('report/config/filtro/edit/store')}}">
          @csrf
                <input type="" name="user_id" value="{{Auth::user()->id}}" hidden="">
                <input type="" name="id" value="{{$data->id}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name" value="{{$data->name}}"><br>                
                
                <div class="">
                    <div class="form-group">
                        <strong>Filters</strong>
                        <br/>
                        @foreach($filtros as $value)
                        <label>
                          {{ Form::checkbox('filtros[]', $value->id, in_array($value->id, $filtros_selected) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
              <br>  
              <button type="submit" class="btn ">Save changes</button>
          </form>

  </div>
</div>
 </div>

@stop
