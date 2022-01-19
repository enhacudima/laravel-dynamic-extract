@extends('adminlte::page')

@section('title','Bayport | Report Config')

@section('content_header')
    <h1>
      <a class="btn btn-social-icon btn-github"  href="{{ url('report/config') }}"><i class="fa  fa-arrow-left"></i></a>
      <a class="btn btn-social-icon btn-github"  data-toggle="modal" data-target="#modal-primary" ><i class="fa  fa-plus"></i></a>
      <a class="btn btn-social-icon btn-github " href="{{ url('report/config/filtro/filtros') }}"><i class="fa  fa-cog"></i></a>
    </h1>
@stop

@section('content')

 <div class="card">
   <div class="card-header">
              <center><h3 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Configuration Group Filter </strong></h3></center>

    </div>
    <div class="card-body">

    <div class="card-body table-responsive no-padding">  

     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead >
        <tr>
            <th scope="col">ID</th>
            <th scope="col"><center>Name</center></th>
            <th scope="col"><center>Filtres</center></th>
            <th scope="col">Actions</th>
            <th scope="col">Create</th>
            <th scope="col">Time</th>
            <th scope="col">User</th>

        </tr>
        </thead>
        <tbody>
            @if(isset($data))
                @foreach($data as $value)
                <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>  
                    @foreach($value->sync_filtros as $filtro)
                        <span class="badge bg-defult">{{$filtro->filtros->name}}</span>
                    @endforeach
                </td>
                <td>
                  <a class="fa fa-pencil-square-o btn btn-success btn-xs" aria-hidden="true" href="{{url('report/config/filtro/edit',$value->id)}}" > Modify</a> 
                </td> 
                <td>{{$value->created_at}}</td>
                <td>{{$value->updated_at->diffForHumans()}}</td>
                <td><img src="{{asset('storage/uploads/avatars/'.$value->user->avatar)}}" class="img-circle" alt="User Image" width="25px" height="25px"> {{$value->user->name}} {{$value->user->lname}}</td>    
                </tr>   
                </tr>

                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
 </div>


  <div class="modal modal-primary fade" id="modal-primary">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">Create New Group Filter</h5>
        </div>
          <form method="post" id="list" action="{{url('report/config/filtro/store')}}">
          @csrf
            <div class="modal-body">
                <input type="" name="user_id" value="{{Auth::user()->id}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name"><br>                
                
                <div class="">
                    <div class="form-group">
                        <strong>Filters</strong>
                        <br/>
                        @foreach($filtros as $value)
                        <label>{{ Form::checkbox('filtros[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
    
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline">Save changes</button>
            </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
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
