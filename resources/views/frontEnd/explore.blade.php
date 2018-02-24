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
                            <th class="text-center">@sortablelink('cost_text', 'Price')</th>
                            <th class="text-center">@sortablelink('process.vote_year', 'Year')</th>
                            <th class="text-center">@sortablelink('votes', 'Votes')</th>
                            <th class="text-center">@sortablelink('status_date_updated', 'Update')</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td class="text-center">
                                    @if($project->project_status=='Complete')
                                        <button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic"><i class="icon fa-check" aria-hidden="true"></i></button>
                                    @elseif($project->project_status=='Project Status Needed')
                                        <button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic"><i class="icon fa-remove" aria-hidden="true"></i></button>
                                    @elseif($project->project_status=='Rejected')
                                        <button type="button" class="btn btn-floating btn-xs waves-effect waves-classic"></button>
                                    @else
                                        <button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic"><i class="icon fa-minus" aria-hidden="true"></i></button>
                                    @endif
                                <td><a href="/profile/{{$project->id}}">{{$project->project_title}}</a></td>
                                <td>
                                  ${{number_format($project->cost_text)}}
                                </td>
                                <td>{{$project->process->vote_year}}</td>
                                <td>{{$project->votes}}</td>
                                <td>{{$project->status_date_updated}}</td>
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