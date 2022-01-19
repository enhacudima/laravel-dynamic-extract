@extends('adminlte::page')

@section('title','Bayport | Report')

@section('content_header')
    <h1>
        <a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
        <a class="btn btn-social-icon btn-github " href="{{ url('report/config') }}"><i class="fa  fa-cog"></i></a>
    </h1>
@stop

@section('content')
    <div class="row">
    @foreach($data as $report)
        @if(Auth::user()->can($report->can))
            <div class="col-md-4 ">
                <div class="card collapsed-card">
                    <div class="card-header">
                    <h3 class="card-title"><img src="{{asset('storage/uploads/avatars/'.$report->user->avatar)}}" class="user-image img-circle elevation-2" alt="User Image" width="25px" height="25px"> {{$report->name}}</h3></h3>

                    <div class="card-tools">
                        @if(isset($report->filtro))
                            <a href="{{url('report/config/filtro/edit',$report->filtro_r->id)}}" class="btn btn-tool"><i class="fas fa-filter"></i></a>
                        @endif
                        <a href="{{url('report/config/edit',$report->id)}}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: none;">
                    <form role="form" method="POST" action="{{ url('report/filtro')}}" enctype="multipart/form-data">
                        @csrf
                        <input name="can" value="{{$report->can}}" type="hidden">
                        <input name="type" value="{{$report->table->table_name}}" type="hidden">
                        <input name="report_id" value="{{$report->id}}" type="hidden">
                        <input name="report_name" value="{{$report->name}}" type="hidden">
                        @if(isset($report->filtro))
                        <!--date-->
                        <select class="form-control " name="filtro">
                            @foreach($report->sync_filtros as $filtro)
                                @if($filtro->filtros->type=='date')
                                <option value="{{$filtro->filtros->value}}">{{$filtro->filtros->name}}</option>
                                @endif
                            @endforeach
                        </select> <br>
                        
                        <div class="row" >
                                <div class="col-md-6">
                                    <input class="form-control"  type="date" name="start"  >
                                </div>

                                <div class="col-md-6">
                                    <input class="form-control"  type="date" name="end"  >
                                </div>
                        </div>
                        <br>
                        <!-- end date-->
                        <!--other filter-->
                            @foreach($report->sync_filtros as $filtro)
                                @if($filtro->filtros->type=='<=' or $filtro->filtros->type=='>=')
                                <div class="">
                                    <input type="hidden" name="comparisonColumun[]" value="{{$filtro->filtros->value}}">
                                    <input type="hidden" name="typeColumun[]" value="{{$filtro->filtros->type}}">
                                    <label>{{$filtro->filtros->name}}</label>
                                    <input class="form-control" type="text" name="comparisonValue[]" value="Sem filtro" placeholder="{{$filtro->filtros->name}}">
                                </div><br>
                                @endif
                                @if($filtro->filtros->type=='pesquisa')
                                <div class="">
                                    <input type="hidden" name="pesquisaColumun[]" value="{{$filtro->filtros->value}}">
                                    <label>{{$filtro->filtros->name}}</label>
                                    <input class="form-control" type="text" name="pesquisaValue[]" value="Sem filtro" placeholder="{{$filtro->filtros->name}}">
                                </div><br>
                                @endif
                                @if($filtro->filtros->type=='group')
                                <div class="">
                                    <input type="hidden" name="groupColumun[]" value="{{$filtro->filtros->value}}">
                                </div>
                                @endif
                                @if($filtro->filtros->type=='list')
                                <div class="">
                                    <input type="hidden" name="listColumun[]" value="{{$filtro->filtros->value}}">
                                    <select class="form-control" name="listValue[]">
                                        <option value="no_filter" selected="" >Seleciona {{$filtro->filtros->name}} ..</option>
                                        @foreach($filtro->filtros->lists as $list)
                                            <option value="{{$list->name}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>

                                </div><br>
                                @endif
                            @endforeach
                        <!--end other filter-->
                        @else
                            <div class="callout callout-info">
                                <h4>Filters</h4>

                                <p>Filters are not available for this report</p>
                            </div>
                            <input name="filtro" value="no_filter" type="hidden">
                        @endif
                        <hr />
                        <p>
                            <i><code>{{$report->comments}}</code> by {{$report->user->name}} {{$report->user->lname}}</i>
                        </p>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn btn-default btn-flat" style="width: 100%"><i class="fa fa-download"></i> Extrat</button>
                    </span>
                    </form>
                    <div class="d-md-flex">

                    </div><!-- /.d-md-flex -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        @endif
    @endforeach
    </div>

@stop
