@extends('backLayout.app')
@section('title')
Processes_Annual
@stop
<style>
    tr.modified{
        background-color: red !important;
    }

    tr.modified > td{
        background-color: red !important;
        color: white;
    }
</style>
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Processes_Annual</h2>
        <div class="clearfix"></div>  
      </div>
      <div class="x_content" style="overflow: scroll;">

        <!-- <table class="table table-striped jambo_table bulk_action table-responsive"> -->
        <table id="example" class="display nowrap table-striped jambo_table table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Name_Process_Annual</th>
                    <th class="text-center">Projects</th>
                    <th class="text-center">Vote_Year</th>
                    <th class="text-center">Process_Name</th>
                    <th class="text-center">District-Ward_Name</th>
                    <th class="text-center">Voters</th>
                    <th class="text-center">City</th> 
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($processes as $key => $process)
                <tr id="process{{$process->id}}" class="{{$process->flag}}">
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$process->name_process_annual}}</td>
                  <td class="text-center">
                    @if($process->projects==null)
                      0
                    @else
                      {{sizeof(explode(",", $process->projects))}}
                    @endif
                  </td>
                  <td class="text-center">{{$process->vote_year}}</td>
                  <td class="text-center">{{$process->process_name}}</td>
                  <td class="text-center">
                  @if($process->district_ward_name==null)
                      0
                    @else
                      {{sizeof(explode(",", $process->district_ward_name))}}
                    @endif</td>
                  <td class="text-center">{{$process->voters}}</td>
                  <td class="text-center">{{$process->city}}</td>
                  <td>
                    <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$process->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                  </td>
                </tr>
              @endforeach             
            </tbody>
        </table>
        {!! $processes->links() !!}
      </div>
    </div>
  </div>
</div>
<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Process_Annual</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Name Process Annual</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name_process_annual" name="name_process_annual" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Vote_Year</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="vote_year" name="vote_year" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Process_Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="process_name" name="process_name" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Voters</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="voters" name="voters" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">City</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="city" name="city" value="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="id" name="id" value="0">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
<script src="{{asset('js/process_ajaxscript.js')}}"></script>
@endsection
