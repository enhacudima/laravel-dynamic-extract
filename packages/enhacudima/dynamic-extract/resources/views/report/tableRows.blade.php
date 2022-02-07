@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Report Table')

@section('content_header')
    <a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
@stop

@section('content')

 <div class="card card-solid card-default">
   <div class="card-header">
              <center><h5 class="card-title"><strong><i class="fa fa-fw fa-folder-open"></i> View data  </strong></h5></center>

    </div>
    <div class="panel-body">

    <div class="card-body table-responsive no-padding">

     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead >
        <tr>
            @if(isset($heading))
            @foreach($heading as $col)
            <th scope="col"><center> {{$col}}</center></th>
            @endforeach
            @endif
        </tr>
        </thead>
        <tbody>
            @if(isset($data))
            @foreach($data as $key => $data_cols)
                <tr>
                    @foreach($data_cols as $key => $data_col)
                    <td>{{$data_col}}</td>
                    @endforeach
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
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