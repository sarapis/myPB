@extends('layouts.app')
@section('title')
Explore
@stop
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style type="text/css">
    .table a{
        text-decoration:none !important;
        color: rgba(40,53,147,.9);
    }
</style>
@section('content')
<div class="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content Holder -->
    <div id="content" style="padding: 0;">
        <!-- <div id="map" style="height: 30vh;"></div> -->
        <!-- Example Striped Rows -->
        <div class="panel">
            <div class="panel-body pt-0">
                <div class="example table-responsive">
                    <table class="table table-striped table-bordered floatThead-table">
                        <thead>
                          <tr>
                            <th class="text-center">@sortablelink('project_status', 'Status')</th>
                            <th class="text-center">@sortablelink('project_title', 'Name')</th>
                            <th class="text-center">@sortablelink('cost_num', 'Price')</th>
                            <th class="text-center">@sortablelink('process.vote_year', 'Year')</th>
                            <th class="text-center">@sortablelink('votes', 'Votes')</th>
                            <th class="text-center">@sortablelink('status_date_updated', 'Update')</th>
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
                                            <button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic"><i class="icon fa-remove" aria-hidden="true"></i></button>
                                        @elseif($project->project_status=='Rejected')
                                            <button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic"><i class="icon fa-remove" aria-hidden="true"></i></button>
                                        @else
                                            <button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic"><i class="icon fa-minus" aria-hidden="true"></i></button>
                                        @endif
                                    @endif
                                <td>
                                    @if($project->project_title!='')
                                        <a href="/profile/{{$project->id}}">{{$project->project_title}}</a></td>
                                    @endif
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
                                    @endif</td>
                                <td>
                                    @if($project->status_date_updated!='')
                                        {{$project->status_date_updated}}</td>
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $projects->appends(\Request::except('page'))->render() }}
            </div>
            <!-- End Example Striped Rows -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
     var map = new GMaps({
        el: '#map',
        lat: 51.5073346,
        lng: -0.1276831,
      });
    });
</script>
@endsection