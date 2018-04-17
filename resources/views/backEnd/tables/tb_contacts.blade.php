@extends('backLayout.app')
@section('title')
Contacts
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
        <h2>Contacts</h2>
        <div class="clearfix"></div>  
      </div>
      <div class="x_content" style="overflow: scroll;">

        <!-- <table class="table table-striped jambo_table bulk_action table-responsive"> -->
        <table id="example" class="display nowrap table-striped jambo_table table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Agency</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($contacts as $key => $contact)
                <tr id="contact{{$contact->id}}" class="{{$contact->flag}}">
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$contact->name}}</td>
                  <td class="text-center">{{$contact->email}}</td>
                  <td class="text-center">{{$contact->phone}}</td>
                  <td class="text-center">{{$contact->category}}</td>
                  <td class="text-center">{{$contact->agency}}</td>
                  <td class="text-center">{{$contact->title}}</td>
                  <td>
                    <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$contact->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                  </td>
                </tr>
              @endforeach             
            </tbody>
        </table>
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
                <h4 class="modal-title">Contacts</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Email</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="email" name="email" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Phone</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="category">
                                <option></option>
                                <option value="Participant">Participant</option>
                                <option value="PBP Volunteer">PBP Volunteer</option>
                                <option value="PBP Staff">PBP Staff</option>
                                <option value="Agency Representative">Agency Representative</option>
                                <option value="District Representative">District Representative</option>
                  
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Title</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="title" name="title" value="">
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
<script src="{{asset('js/contacts_ajaxscript.js')}}"></script>
@endsection
