@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Files')

@section('content_header')
     <a class="btn btn-social-icon btn-github" aria-hidden="true" href="{{url('meusficheiros/all/deletefile')}}" ><i class=" fas fa-trash-alt " style="color: red"></i> Delete All Files</a>

@stop

@section('content')

 <div class="card">
   <div class="card-header border-0">
    <div class="d-flex justify-content-between">
              <center><h5 class="card-title"><strong><i class="fa fa-fw fa-bookmark"></i> Files </strong></h5></center>
    </div>

    </div>
    <div class="card-body table-responsive no-padding ">

    <div class="position-relative mb-4">

     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead >
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col"><center>Descrição</center></th>
            <th scope="col">Details</th>
            <th scope="col">Criado em</th>
            <th scope="col">Tempo de execução</th>
            <th scope="col">Ultima actualização</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
            @if($data)
                @foreach($data as $value)
                    <tr>
                    <td>{{$value->id}}</td>
                    <td><img src="{{asset('storage/uploads/avatars/'.$value->avatar)}}" class="img-circle" alt="User Image" width="25px" height="25px"> {{$value->name}} {{$value->lname}}</td>
                    <td>{{$value->filename}}</td>
                    <td>
                        @if(isset($value->filterData))
                            @foreach($value->filterData as $key => $items )
                                <span class="badge bg-info"> <div class="text-uppercase">{{$key}}:</div>
                                @if(is_array($items))
                                    @foreach($items as $keyItem =>$item)
                                        {!! $item !!},
                                    @endforeach
                                @else
                                    {!! $items !!}
                                @endif
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->created_at->diffInMinutes($value->updated_at)}} Minutes</td>
                    <td>{{$value->updated_at->diffForHumans()}}</td>
                    <td>
                        @if($value->status)
                        <a class="btn btn-default btn-xs" aria-hidden="true" href="{{url(config('dynamic-extract.prefix').'/meusficheiros/deletefile',$value->filename)}}" ><i class="fa fa-spinner fa-spin " style="color: red"></i> Abortar</a>
                        @else
                        <a class="btn btn-default btn-xs" aria-hidden="true" href="{{url(config('dynamic-extract.prefix').'/file/download',$value->filename)}}" ><i class="fas fa-download" style="color: green"></i> Baixar</a>
                        <a class="btn btn-default btn-xs" aria-hidden="true" href="{{url(config('dynamic-extract.prefix').'/meusficheiros/deletefile',$value->filename)}}" ><i class="fas fa-trash-alt" style="color: red"></i> Eliminar</a>
                        @endif
                    </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
 </div>
@stop

@section('js')
<script type="text/javascript">
  setTimeout(function() {
    location.reload();
  }, 30000);//30seg
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Blfrtip',
        "order": [[ 0, "desc" ]],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "columnDefs": [
                        { "type": "date-eu", "targets": 4 }
                      ],
        buttons: [
            {
              extend: 'copy',
              text: '<i class="fas fa-copy"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'csv',
              text: '<i class="fas fa-file-alt"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'pdf',
              text: '<i class="fas fa-file-pdf"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'print',
              text: '<i class="fa fa-fw fa-print"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'colvis',
              text: '<i class="fa fa-fw fa-eye-slash"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
        ]
    } );
} );

</script>

@stop

@section('css')
<style type="text/css">
  <style>
     .content-wrapper {
          background-color : white;
      }
  </style>

  <style type="text/css">
    .table{
        font-size: 10.7px;
      }
  </style>

  <style type="text/css">
      .dataTables_wrapper .dt-buttons {
    float:none;
    text-align:center;
    margin-bottom: 30px;
  }
  </style>

</style>

@stop
