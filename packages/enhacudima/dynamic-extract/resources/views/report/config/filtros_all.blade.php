@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Report Config')

@section('content_header')
      <a class="btn btn-social-icon btn-github"  href="{{ url('report/config/filtro') }}"><i class="fa  fa-arrow-left"></i></a>
      <a class="btn btn-social-icon btn-github"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa  fa-plus"></i></a>
      <a class="btn btn-social-icon btn-github " href="{{ url('report/config/filtro/list') }}"><i class="fa  fa-list"></i></a>
      <a class="btn btn-social-icon btn-github " href="{{ url('report/config/filtro/columuns') }}"><i class="fa  fa-database"></i></a>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h3 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report Configuration Filter </strong></h3></center>

    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">

     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead >
        <tr>
            <th scope="col">ID</th>
            <th scope="col"><center>Name</center></th>
            <th scope="col">Columun/Table</th>
            <th scope="col">Type</th>
            <th scope="col"><center><i class="fa  fa-database"></i> Columuns</center></th>
            <th scope="col"><center><i class="fa  fa-bars"></i> lists</center></th>
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
                <td>{{$value->value}}</td>
                <td>{{$value->type}}</td>
                <td>
                    @foreach($value->columuns as $columun)
                        <span class="badge bg-defult">{{$columun->name}}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($value->lists as $lists)
                        <span class="badge bg-defult">{{$lists->name}}</span>
                    @endforeach
                </td>
                <td>
                      <a class="fa fa-pencil-square-o btn btn-success btn-xs" aria-hidden="true" href="{{url('report/config/filtro/filtros/edit',$value->id)}}" > Modify</a>
                </td>
                <td>{{$value->created_at}}</td>
                <td>{{$value->updated_at->diffForHumans()}}</td>
                <td><img src="{{asset('storage/uploads/avatars/'.$value->user->avatar)}}" class="img-circle" alt="User Image" width="25px" height="25px"> {{$value->user->name}} {{$value->user->lname}}</td>
                </tr>

                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
 </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create New Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form method="post" id="list" action="{{url('report/config/filtro/filtros/new/store')}}">
          @csrf
            <div class="modal-body">
                <input type="" name="user_id" value="{{Auth::user()->id ?? 0}}" hidden="">

                <input type="text" name="name" required autofocus="" class="form-control" placeholder="Name"><br>
                <input type="text" name="value" required autofocus="" class="form-control" placeholder="Columun/Table"><br>
                <select required="" name="type" required autofocus="" class="form-control">
                  <option value="" disabled="" selected="">Select type</option>
                  <option value="date">date</option>
                  <option value="pesquisa">pesquisa</option>
                  <option value="list">list</option>
                  <option value="group">group by</option>
                  <option value="columuns">columuns</option>
                  <option value="<=">less than "<="</option>
                  <option value=">=">greater than ">="</option>
                </select>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
