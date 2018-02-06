@extends('backLayout.app')
@section('title')
Projects
@stop

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Projects</h2>
        <div class="clearfix"></div>  
      </div>
      <div class="x_content" style="overflow: scroll;">

        <!-- <table class="table table-striped jambo_table bulk_action table-responsive"> -->
        <table id="example" class="display nowrap table-striped jambo_table table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Project_ID</th>
                    <th class="text-center">Project_Title</th>
                    <th class="text-center">Project_Description</th>
                    <th class="text-center">Project_Status</th>
                    <th class="text-center">Status_date_updated</th>
                    <th class="text-center">Process_ID</th>
                    <th class="text-center">Source_Ballot_Link</th>
                    <th class="text-center">Distric-Ward_Name</th>
                    <th class="text-center">Win_Text</th>
                    <th class="text-center">Win_Calculate</th>
                    <th class="text-center">Votes</th>
                    <th class="text-center">Vote_Date</th>
                    <th class="text-center">PB_Cycle</th>
                    <th class="text-center">Cost_Text</th>
                    <th class="text-center">Cost_Num</th>
                    <th class="text-center">Category_Topic_Committee_Raw</th>
                    <th class="text-center">Category_Type_Topic_Standardize</th>
                    <th class="text-center">Project_Location_Raw</th>
                    <th class="text-center">Project_Address_Clean</th>
                    <th class="text-center">Location_City</th>
                    <th class="text-center">State</th>
                    <th class="text-center">Country</th>
                    <th class="text-center">Zipcode</th>
                    <th class="text-center">Full_Address</th>
                    <th class="text-center">Latitude</th>
                    <th class="text-center">Longitude</th>
                    <th class="text-center">Neighborhood</th>
                    <th class="text-center">Census_Tract-or-Local_ID</th>
                    <th class="text-center">BIN</th>
                    <th class="text-center">Borough_Code</th>
                    <th class="text-center">Name_Dept_Agency_CBO</th>
                    <th class="text-center">Agency_Code</th>
                    <th class="text-center">Agency_Project_Code</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($projects as $key => $project)
                <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$project->project_id}}</td>
                  <td class="text-center">{{str_limit($project->project_title, 20)}}</td>
                  <td class="text-center">{{str_limit($project->project_description, 20)}}</td>
                  <td class="text-center"><span class="badge bg-green">  {{ $project->project_status }} </span></td>
                  <td class="text-center">{{$project->status_date_updated}}</td>
                  <td class="text-center"><span class="badge bg-orange">{{$project->process()->first()->name_process_annual}}</span></td>
                  <td class="text-center">{{$project->source_ballot_link}}</td>
                  <td class="text-center"><span class="badge bg-red">{{$project->district()->first()->name}}</span></td>
                  <td class="text-center">{{$project->win_text}}</td>
                  <td class="text-center">{{$project->win_calculate}}</td>
                  <td class="text-center">{{$project->votes}}</td>
                  <td class="text-center">{{$project->vote_date}}</td>
                  <td class="text-center">{{$project->pb_cycle}}</td>
                  <td class="text-center">${{number_format($project->cost_text)}}</td>
                  <td class="text-center">{{$project->cost_num}}</td>
                  <td class="text-center">{{$project->category_topic_committee_raw}}</td>
                  <td class="text-center"><span class="badge bg-blue">{{$project->category_type_topic_standardize}}</span></td>
                  <td class="text-center">{{$project->project_location_raw}}</td>
                  <td class="text-center">{{$project->project_address_clean}}</td>
                  <td class="text-center">{{$project->location_city}}</td>
                  <td class="text-center">{{$project->state}}</td>
                  <td class="text-center">{{$project->country}}</td>
                  <td class="text-center">{{$project->zipcode}}</td>
                  <td class="text-center">{{$project->full_address}}</td>
                  <td class="text-center">{{$project->latitude}}</td>
                  <td class="text-center">{{$project->longitude}}</td>
                  <td class="text-center"><span class="badge bg-purple">{{$project->neighborhood}}</span></td>
                  <td class="text-center">{{$project->census_tract_local_id}}</td>
                  <td class="text-center">{{$project->bin}}</td>
                  <td class="text-center">{{$project->borough_code}}</td>
                  <td class="text-center">{{$project->name_dept_agency_cbo}}</td>
                  <td class="text-center">{{$project->agency_code}}</td>
                  <td class="text-center">{{$project->agency_project_code}}</td>

                  <td class="text-center">
                    <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</button>
                  </td>
                </tr>
              @endforeach             
            </tbody>
        </table>
        {!! $projects->links() !!}
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
        },
        "paging": false,
        "pageLength": 20,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true
    } );
} );
</script>
<script type="text/javascript">
        $(function () {
            $('#user_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>
@endsection
