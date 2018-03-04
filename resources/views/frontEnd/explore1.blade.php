<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../../frontend/global/vend/footable/footable.core.css">
  <link rel="stylesheet" href="../../frontend/assets/examples/css/tables/footable.css">
<style type="text/css">
.table a{
    text-decoration:none !important;
    color: rgba(40,53,147,.9);
    white-space: normal;
}
.footable.breakpoint > tbody > tr > td > span.footable-toggle{
    position: absolute;
    right: 25px;
    font-size: 25px;
    color: #000000;
}
#content{
    padding-top: 0 !important;

}
.collapse.navbar-collapse.navbar-collapse-toolbar.show{
    padding:5px;
}
.site-footer{
    position: fixed;
    bottom: 0;
    background: #fff;
    z-index: 9000;
    width: 100%;
    left: 271px;
}
</style>
<script src="../../../frontend/global/vend/breakpoints/breakpoints.js"></script>
<script>
Breakpoints();
</script>

<div class="panel">
    <div class="panel-body p-5">
        <div class="example table-responsive">
            <table class="table table-striped toggle-arrow-tiny"  id="examplePagination">
                <thead>
                  <tr>
                    <th class="text-center">Status</th>
                    <th data-toggle="true" class="pr-20">Name</th>
                    <th data-breakpoints="all">Price</th>
                    <th data-breakpoints="all">Year</th>
                    <th data-breakpoints="all">Votes</th>
                    <th data-breakpoints="all">Update</th>
                    <th data-breakpoints="all"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr> 
                        <td class="text-center">
                            @if($project->project_status!='')
                                @if($project->project_status=='Complete')
                                    <button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic"><i class="icon fa-check" aria-hidden="true"></i></button>
                                @elseif($project->project_status=='Project Status Needed')
                                    <button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic"></button>
                                @elseif($project->project_status=='Rejected')
                                    <button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic"><i class="icon fa-remove" aria-hidden="true"></i></button>
                                @else
                                    <button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic"><i class="icon fa-minus" aria-hidden="true"></i></button>
                                @endif
                            @endif
                        </td>
                        <td class="pr-30">
                            @if($project->project_title!='')
                                <a href="/profile/{{$project->id}}">{{$project->project_title}}</a>
                            @endif
                        </td>
                        <td>
                            @if($project->cost_num!='')
                                ${{number_format($project->cost_num)}}
                            @endif
                        </td>
                        <td>
                            @if($project->process->vote_year!='')
                                {{$project->process->vote_year}}
                            @endif
                        </td>
                        <td>
                            @if($project->votes!='')
                                {{$project->votes}}
                            @endif
                        </td>
                        <td>
                            @if($project->status_date_updated!='')
                                {{$project->status_date_updated}}
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5">
                      <div class="text-right">
                        <ul class="pagination">
                            
                        </ul>
                      </div>
                    </td>
                  </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script src="../../frontend/assets/examples/js/tables/footable.js"></script>
<script>
    $(document).ready(function(){
        var text= $('.navbar-container').css('height');
        $('.page').css('margin-top',text);
    });
</script>