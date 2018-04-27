@extends('backLayout.app')
@section('title')
Projects
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
                    <th class="text-center">Project_Status</th>                   
                    <th class="text-center">Process_ID</th>                 
                    <th class="text-center">Distric-Ward_Name</th>
                    <th class="text-center">Agency_Code</th>
                    <th class="text-center">Category_Type_Topic_Standardize</th>
                    <th class="text-center">Project_Title</th>
                    <th class="text-center">Project_Description</th>
                    <th class="text-center">Status_date_updated</th>
                    <th class="text-center">Source_Ballot_Link</th>
                    <th class="text-center">Win_Text</th>
                    <th class="text-center">Win_Calculate</th>
                    <th class="text-center">Votes</th>
                    <th class="text-center">Vote_Date</th>
                    <th class="text-center">PB_Cycle</th>
                    <th class="text-center">Cost_Text</th>
                    <th class="text-center">Cost_Num</th>
                    <th class="text-center">Category_Topic_Committee_Raw</th>
                    
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
                    
                    <th class="text-center">Agency_Project_Code</th>
                    <th class="text-center">Project_Budget_Type</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach($projects as $key => $project)
                <tr id="project{{$project->id}}" class="{{$project->flag}}">
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$project->project_id}}</td>
                  
                  <td class="text-center"><span class="badge bg-green">  {{ $project->project_status }} </span></td>
                  
                  <td class="text-center"><span class="badge bg-orange">{{$project->process()->first()->name_process_annual}}</span></td>
                  
                  <td class="text-center"><span class="badge bg-red">{{$project->district()->first()->name}}</span></td>
                  <td class="text-center">
                    @if($project->agency_code!=null)
                    <span class="badge bg-purple">{{$project->agency()->first()['agency_code']}}</span>
                    @else
                    <span class="badge bg-purple"></span>
                    @endif

                  </td>
                  <td class="text-center"><span class="badge bg-blue">{{$project->category_type_topic_standardize}}</span></td>
                  <td class="text-center">{{$project->project_title}}</td>
                  <td class="text-center">{{$project->project_description}}</td>
                  <td class="text-center">{{$project->status_date_updated}}</td>
                  <td class="text-center">{{$project->source_ballot_link}}</td>
                  <td class="text-center">{{$project->win_text}}</td>
                  <td class="text-center">{{$project->win_calculate}}</td>
                  <td class="text-center">{{$project->votes}}</td>
                  <td class="text-center">{{$project->vote_date}}</td>
                  <td class="text-center">{{$project->pb_cycle}}</td>
                  <td class="text-center">${{number_format($project->cost_text)}}</td>
                  <td class="text-center">{{$project->cost_num}}</td>
                  <td class="text-center">{{$project->category_topic_committee_raw}}</td>
                  
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
                  <td class="text-center">{{$project->census_tract_or_local_id}}</td>
                  <td class="text-center">{{$project->bin}}</td>
                  <td class="text-center">{{$project->borough_code}}</td>
                  <td class="text-center">{{$project->name_dept_agency_cbo}}</td>
                  
                  <td class="text-center">{{$project->agency_project_code}}</td>

                  <td class="text-center"><span class="badge bg-blue">{{$project->project_budget_type}}</span></td>

                  <td class="text-center">
                    <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$project->id}}" style="width: 80px;"><i class="fa fa-fw fa-edit"></i>Edit</button>
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
<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Project</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="row modal-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Project_ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_id" name="project_id" value="">
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Project_Title</label>

                      <div class="col-sm-7">
                        <textarea type="text" class="form-control" id="project_title" name="project_title" value=""></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Project_Description</label>

                      <div class="col-sm-7">
                        <textarea type="text" class="form-control" id="project_description" name="project_description" value="" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Status_Category</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="project_status_category">
                                <option value="Complete">Complete</option>
                                <option value="In process">In process</option>
                                <option value="Not funded">Not funded</option>
                                <option value="Project Status Needed">Project Status Needed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Status_date_updated</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="status_date_updated" name="status_date_updated" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Source_Ballot_Link</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="source_ballot_link" name="source_ballot_link" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Win_Text</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="win_text" name="win_text" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Win_Calculate</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="win_calculate" name="win_calculate" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Votes</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="votes" name="votes" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Vote_Date</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="vote_date" name="vote_date" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">PB_Cycle</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="pb_cycle" name="pb_cycle" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Cost_Text</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="cost_text" name="cost_text" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Cost_Num</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="cost_num" name="cost_num" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Category Topic Committee Raw</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="category_topic_committee_raw" name="category_topic_committee_raw" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Category Type Topic Standardize</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="category_type_topic_standardize">
                                <option></option>
                                <option value="Housing">Housing</option>
                                <option value="Senior and Social Services">Senior and Social Services</option>
                                <option value="Youth">Youth</option>
                                <option value="Transportation and Public Safety">Transportation and Public Safety</option>
                                <option value="Parks and Recreation">Parks and Recreation</option>
                                <option value="Education">Education</option>
                                <option value="Public Health and Environment">Public Health and Environment</option>
                                <option value="Art, Community, and Culture">Art, Community, and Culture</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <dir class="col-md-6" style="margin-top: 0;">
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Project Location Raw</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_location_raw" name="project_location_raw" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Project Address Clean</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_address_clean" name="project_address_clean" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Location_City</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="location_city" name="location_city" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">State</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="state" name="state" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Country</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="country" name="country" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Zipcode</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Full_Address</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="full_address" name="full_address" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Latitude</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="latitude" name="latitude" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Longitude</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="longitude" name="longitude" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Neighborhood</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="neighborhood">
                                <option></option>
                                <option value="East Harlem North">East Harlem North</option>
                                <option value="East Harlem South">East Harlem South</option>
                                <option value="Upper West Side">Upper West Side</option>
                                <option value="Morningside Heights">Morningside Heights</option>
                                <option value="Breezy Point-Belle Harbor-Rockaway Park-Broad Channel">Breezy Point-Belle Harbor-Rockaway Park-Broad Channel</option>
                                <option value="Park Slope-Gowanus">Park Slope-Gowanus</option>
                                <option value="Windsor Terrace">Windsor Terrace</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Census_Tract-or-Local_ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="census_tract_or_local_id" name="census_tract_or_local_id" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">BIN</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="bin" name="bin" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Borough_Code</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="borough_code" name="borough_code" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Name Dept Agency CBO</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name_dept_agency_cbo" name="name_dept_agency_cbo" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Agency Project Code</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="agency_project_code" name="agency_project_code" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Project Budget Type</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="project_budget_type">
                                <option></option>
                                <option value="Capital">Capital</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                    </div>
                  </dir>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="id" name="project_id" value="0">
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
<script src="{{asset('js/project_ajaxscript.js')}}"></script>
@endsection
