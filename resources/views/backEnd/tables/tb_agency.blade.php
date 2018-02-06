@extends('backLayout.app')
@section('title')
Agency
@stop

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Agency</h2>
        <div class="clearfix"></div>  
      </div>
      <div class="x_content" style="overflow: scroll;">

        <!-- <table class="table table-striped jambo_table bulk_action table-responsive"> -->
        <table id="example" class="display nowrap table-striped jambo_table table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Agency_Name</th>
                    <th class="text-center">Projects</th>
                    <th class="text-center">Website</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($agencies as $key => $agency)
                <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$agency->name}}</td>
                  <td class="text-center">{{$agency->agency_name}}</td>
                  <td class="text-center">@foreach($agency->project as $project)
                    <span class="badge bg-green">{{$project->project_id}}</span>
                  @endforeach
                  </td>
                  <td class="text-center">{{$agency->website}}</td>
                  <td class="text-center">{{$agency->contacts}}</td>
                  <td>
                    <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</button>
                  </td>
                </tr>
              @endforeach             
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            }
        }
    } );
} );
</script>
@endsection
