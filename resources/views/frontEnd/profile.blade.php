@extends('layouts.app')
@section('title')
Profile
@stop

@section('content')
<div class="page-header p-10">
    @if($project->project_status=='Complete')
        <h3><button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic mr-10"><i class="icon fa-check m-0" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">{{$project->project_title}}</span></h3>
    @elseif($project->project_status=='Rejected')
        <h3><button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-10"></button><span style="position: absolute; line-height: 20px; padding: 5px;">{{$project->project_title}}</span></h3>
    @elseif($project->project_status=='Project Status Needed')
        <h3><button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-10"><i class="icon fa-remove  m-0" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">{{$project->project_title}}</span></h3>
    @else
    <h3><button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-10"><i class="icon fa-minus m-0" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">{{$project->project_title}}</span></h3>
    @endif
</div>
  <div class="col-md-7">
    <!-- Panel -->      
    <div class="panel">
      <div class="panel-body">
          <h2>{{$project->project_status}}</h2>
          <h4>{{$project->status_date_updated}} {{$project->project_id}}</h4>
          <h4>{{$project->name_dept_agency_cbo}}</h4>
          <h4>{{$project->district->name}}</h4>
          <h4>{{$contact->email}}</h4>
          <h4>{{$contact->phone}}</h4>
      </div>
    </div>
    <div class="panel">
      <div class="panel-body">
          <h2 class="text-center">{{number_format($project->votes)}} &nbsp&nbspvotes</h2>
          <div class="row">
            <div class="col-sm-6 text-center">
              <h4>{{$project->process->vote_year}}</h4>
            </div>
            <div class="col-sm-6 text-center">
              <h4>${{number_format($project->cost_text)}}</h4>
            </div>
          </div>
          <h3><b>{{$project->category_type_topic_standardize}}</b></h3>
          <h4>{{$project->project_description}}</h4>
      </div>
    </div>
    <!-- End Panel -->
  </div>
  <div class="col-md-5">
    <!-- Panel -->
    <div class="panel">
      <div id="mymap" style="height: 30vh;"></div>
      <div class="panel-body">
          <h4>{{$project->project_address_clean}}</h4>
          <h4>{{$project->location_city}}</h4>
          <h4>{{$project->state}}, {{$project->zipcode}}</h4>
      </div>
    </div>
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5XHJ6oNL9-qh0XsL0G74y1xbcxNGkSxw&callback=initMap"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
 <script type="text/javascript">

    var locations = <?php print_r(json_encode($project)) ?>;

    var mymap = new GMaps({
      el: '#mymap',
      lat: locations.latitude,
      lng: locations.longitude,
      zoom:13
    });

     mymap.addMarker({
      lat: locations.latitude,
      lng: locations.longitude,
      title: locations.project_title
    });

  </script>
@endsection