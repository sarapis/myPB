@extends('layouts.app')
@section('title')
Profile
@stop

@section('content')
<div class="row">
    <div class="col-xl-7 col-md-7">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
            <h3>{{$project->project_title}}</h3>
            <h4>{{$project->status_date_updated}} {{$project->project_id}}</h4>
            <h4>{{$project->name_dept_agency_cbo}}</h4>
            <h4>{{$project->district->name}}</h4>
            <h4>{{$contact->email}}</h4>
            <h4>{{$contact->phone}}</h4>
        </div>
      </div>
      <!-- End Panel -->
      <!-- Panel -->
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
            <h3>{{$project->category_type_topic_standardize}}</h3>
            <h4>{{$project->project_description}}</h4>
            <a href="http://{{$project->source_ballot_link}}" target="_blank">VIEW BALLOT</a>
        </div>
      </div>
      <!-- End Panel -->
    </div>
    <div class="col-xl-5 col-md-5">
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
      <!-- End Panel -->
</div>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBW3D0csUKNr8q5xQiIJwaqbETdKGm2Zg&callback=initMap"
  type="text/javascript"></script>
<script src="../../../../js/gmaps.js"></script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($project)) ?>;

    var mymap = new GMaps({
      el: '#mymap',
      lat: locations.latitude,
      lng: locations.longitude,
      zoom:10
    });

    mymap.addMarker({
      lat: locations.latitude,
      lng: locations.longitude,
      title: locations.project_title
    });

  </script> -->
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