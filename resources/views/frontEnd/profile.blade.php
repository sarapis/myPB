@extends('layouts.app')
@section('title')
Profile
@stop
<style>
   .navbar-container.container-fluid{
        display: none !important;
    }
    @media (max-width: 991px){
        .page {
            padding-top: 0px !important;
        }
    }
</style>
@section('content')

  <div class="col-md-12">
  
          @if($project->project_status_category=='Complete')
              <h3 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic mr-10"><i class="icon fa-check mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h3>
          @elseif($project->project_status_category=='Project Status Needed')
              <h3 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-10"></button>{{$project->project_title}}</h3>
          @elseif($project->project_status_category=='Not funded')
              <h3 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-10"><i class="icon fa-remove mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h3>
          @else
              <h3 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-10"><i class="icon fa-minus mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h3>
          @endif

  </div>

  <div class="col-md-7">
    <!-- Panel -->      
    <div class="panel">
      <div class="panel-body">
          <h4><b>{{$project->project_status}}</b></h4>
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
          <h4>{{$project->location_city}}, {{$project->state}}, {{$project->zipcode}}</h4>
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