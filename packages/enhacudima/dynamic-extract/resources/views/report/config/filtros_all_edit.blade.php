@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Config Edit Filter')

@section('content_header')
    <a class="btn btn-social-icon btn-github"  href="{{ url('report/config/filtro/filtros') }}"><i class="fa  fa-arrow-left"></i></a>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h5 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Edit Filter  </strong></h5></center>
    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">
          <form method="post" id="list" action="{{url('report/config/filtro/filtros/edit/store')}}">
          @csrf
                <input type="" name="user_id" value="{{Auth::user()->id ?? 0}}" hidden="">
                <input type="" name="id" value="{{$data->id}}" hidden="">

                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name" value="{{$data->name}}"><br>
                <label for="exampleFormControlInput1" class="form-label">Columun/Table</label>
                <input type="text" name="value" required autofocus="" class="form-control" placeholder="Columun/Table" value="{{$data->value}}">
                <small>Table name for filter type "columuns"</small>
                <br>
                <br>
                <label for="exampleFormControlInput1" class="form-label">Type</label>
                <select required="" name="type" id="type" required autofocus="" class="form-control type">
                  <option value="{{$data->type}}"  selected="">{{$data->type}}</option>
                  <option value="date">date</option>
                  <option value="pesquisa">search</option>
                  <option value="list">list</option>
                  <option value="group">group by</option>
                  <option value="columuns">columuns</option>
                  <option value="<=">less than "<="</option>
                  <option value=">=">greater than ">="</option>
                </select>
                <br>
                @if($data->lists)
                <div class="flexCheckLists" id="flexCheckLists" >
                    <div class="form-group">
                        @foreach($data->lists as $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="list_columuns[]" value="{{ $value->name  }}" id=" {{ $value->id }}" checked >
                            <label class="form-check-label" for=" {{ $value->id }}">
                                {{ $value->name }}
                            </label>
                            <a class="btn btn-light btn-sm" aria-hidden="true" href="{{url('report/config/filtro/list/edit',$value->id)}}" ><i class="fas fa-edit"></i> </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($data->columuns)
                <div class="flexCheckColumuns" id="flexCheckColumuns" >
                    <div class="form-group">
                        @foreach($data->columuns as $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="list_columuns[]" value="{{ $value->name }}" id=" {{ $value->id }}" checked >
                            <label class="form-check-label" for=" {{ $value->id }}">
                                {{ $value->name }}
                            </label>
                            <a class="btn btn-light btn-sm" aria-hidden="true" href="{{url('report/config/filtro/columuns/edit',$value->id)}}" ><i class="fas fa-edit"></i> </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <br>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{url('report/config/filtro/filtros/delete',$data->id)}}">Delete</a>
          </form>

  </div>
</div>
</div>

@stop
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('#type').on('change', function() {
        //console.log(this.value)
        if (this.value=="columuns"){
        $('#flexCheckLists').css('display', 'none');
        $('#flexCheckColumuns').css('display', 'block');
        }
        else if(this.value=="list"){
        $('#flexCheckLists').css('display', 'block');
        $('#flexCheckColumuns').css('display', 'none');
        }
        else{
        $('#flexCheckLists').css('display', 'none');
        $('#flexCheckColumuns').css('display', 'none');
        }
    });
})
</script>
@stop

