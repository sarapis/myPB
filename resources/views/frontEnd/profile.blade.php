@extends('layouts.app')
@section('title')
Profile
@stop
<meta name="description" content="{{$project->project_title}}">
<style>
    @media (max-width: 991px){
        .page {
            padding-top: 0px !important;
        }
    }
    #map{
      position: fixed !important;

    }
    .profile-location{
      display: none;
    }
    .overlay{
      display: block !important;
      width: 270px !important;
      height: 100% !important;
      z-index: 999 !important;
    }

    .navbar-container{
      display: none !important;
    }
  /*  @-webkit-keyframes example {
      from {left: 100%;}
      to {left: 0px;}
    }
    @keyframes example {
      from {left: 100%;}
      to {left: 0px;}
    }*/
    @media (max-width: 768px) {
      #map{
          width: 100% !important;
          margin: 0 !important;
          position: relative !important;
          display: block !important;
          z-index: 1 !important;
        }
      .overlay{
        display: none !important;
      }
      #sidebar{
        display: none !important;
      }
      #content{
        height: 100vh !important;
      }   
    }
</style>
@section('content')
<div class="wrapper">

  @include('layouts.sidebar')

  <div id="content" class="container">
 
    <div class="row container-fluid m-0 p-0">
      <div class="col-md-8">
        <div class="row" id="profile_btn">
          <button type="button" id="btn-profile" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left waves-effect waves-classic ml-15 mt-30 mb-0" style=""><b><span>{{$project->project_title}} </span><i class="icon wb-close" aria-hidden="true"></i></a></b>
          </button>
        </div>
        @if($project->project_status_category=='Complete')
            <h4 class="m-0 pt-20 pb-30"><button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic mr-10"><i class="icon fa-check mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h4>
        @elseif($project->project_status_category=='Project Status Needed')
            <h4 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-10"></button>{{$project->project_title}}</h4>
        @elseif($project->project_status_category=='Lost vote')
            <h4 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-10"><i class="icon fa-remove mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h4>
        @else
            <h4 class="m-0 pt-30 pb-30"><button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-10"><i class="icon fa-minus mr-0" aria-hidden="true"></i></button>{{$project->project_title}}</h4>
        @endif
        <!-- <a class="btn btn-info mb-15" href="/profilepdf_{{$project->project_title}}">Download PDF</a> -->
        <div class="panel mb-15">
          <div class="panel-body p-15">
            <h4><div class="pull-left pt-5"><b>{{$project->project_status}}</b></div>
              @if($project->project_status_category=='Complete')
                  <div class="pull-right"><button type="button" class="btn btn-floating btn-success btn-xs mr-10"><i class="icon fa-check mr-0" aria-hidden="true"></i></button></div>
                @elseif($project->project_status_category=='Project Status Needed')
                  <div class="pull-right">  <button type="button" class="btn btn-floating  btn-xs mr-10"></button>
                  </div>
                @elseif($project->project_status_category=='Lost vote')
                    <div class="pull-right"><button type="button" class="btn btn-floating btn-danger btn-xs mr-10"><i class="icon fa-remove mr-0" aria-hidden="true"></i></button></div>
                @else
                    <div class="pull-right"><button type="button" class="btn btn-floating btn-warning btn-xs mr-10"><i class="icon fa-minus mr-0" aria-hidden="true"></i></button></div>
              @endif
            </h4>
            @if($project->status_date_update!=null)
            <p>Last updated {{$project->status_date_updated}}</p>
            @endif
          </div>
        </div>

        <div class="panel mb-15">
          <div class="panel-body p-15">
            <h4><b>BALLOT INFORMATION</b></h4>
            <h5 class="profile-title">Project appeared on {{$project->district->name}} PBNYC ballot in {{$project->vote_year}} with a cost of ${{number_format($project->cost_text)}}. @if($project->project_status_category=='Project Status Needed')
              Project status is unknown with  an unknown number of votes
            @else {{$project->win_text}} with 
              @if($project->votes==0) an unknown number of 
              @else {{$project->votes}} 
              @endif votes. 
            @endif</h5>
          </div>
        </div>

        @if($project->project_status_category != 'Lost vote' && $project->project_status_category != 'Project Status Needed')
          @if($project->project_budget_type=='Capital')
          <div class="panel mb-15">
            <div class="panel-body p-15">
              <h5 class="profile-title">This is a <b>Capital Project</b> so it will likely take between 3-7 years from funding to completion.</h5>
            </div>
          </div>
          @endif
          @if($project->project_budget_type=='Expense')
          <div class="panel mb-15">
            <div class="panel-body p-15">
              <h5 class="profile-title">This is an <b>Expense Project</b> so it will likely be completed within 1-2 years.</h5>
            </div>
          </div>
          @endif
        @endif

        <!-- Panel -->      
        @if($project->project_status_category != 'Lost vote' && $project->project_status_category != 'Project Status Needed')
        <div class="panel mb-15">
          <div class="panel-body p-15">
              <h4><b>IMPLEMENTATION PLAN</b></h4>
              <h5 class="profile-title">${{$project->cost_appropriated}} by NYCC in {{$project->fiscal_year}}, with implementation by {{$project->name_dept_agency_cbo}}.</h5>
          </div>
        </div>
        @endif
        <div class="panel mb-15" style="background: #3f8a7b;">
          <div class="panel-body text-center p-15">
            <h5 class="feedback-title">Not finding what you're looking for?</h5>
            <button class="btn btn-block btn-profile waves-effect waves-classic waves-effect waves-classic"><a href="mailto:{{$contact->email}}" target="_top"  class="ui-link">Email Your Council Member</a></button>
          </div>
        </div>
        <div class="panel mb-15">
          <div class="panel-body p-15">
              <h4><b>PROJECT DETAILS</b></h4>
              <h5 class="profile-title"><b>{{$project->category_type_topic_standardize}}</b></h5>
              <h5 class="profile-title">{{$project->project_description}}</h5>
          </div>
        </div>
      </div>

      <div class="col-md-4 pl-0 pt-15 pr-0">
        <!-- Panel -->
        <div class="panel">
          <div id="map" class="mr-0 mt-0" style="width: 27% !important;"></div>
          <div class="panel-body profile-location">
              <h4>{{$project->project_address_clean}}</h4>
              <h4>{{$project->location_city}}, {{$project->state}}, {{$project->zipcode}}</h4>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer')
  </div>
  
</div>

<script>
    $(document).ready(function(){
        if(screen.width < 768){
          var text= $('.navbar-container').css('height');
          var height = text.slice(0, -2);
          $('#sidebar').css('top', height);
          $('#content').css('top', height);
        }
        else{
          var text= $('.navbar-container').css('height');
          var height = text.slice(0, -2);
          $('.page').css('margin-top', height);
        }
    });
</script>
 <script type="text/javascript">

    var locations = <?php print_r(json_encode($project)) ?>;

    var mymap = new GMaps({
      el: '#map',
      lat: locations.latitude,
      lng: locations.longitude,
      zoom:13
    });

    var status = locations.project_status_category;
    var statusicon = '';
    // console.log(status);
    if(status == 'Complete'){
        statusicon = "/images/icon/completed-map-pin.png"
      }
    if(status == 'Lost vote'){
        statusicon = "/images/icon/not-funded-map-pin.png"
      }
    if(status == 'In process'){
        statusicon = "/images/icon/in-progress-map-pin.png"
      }
    if(status == 'Project Status Needed'){
        statusicon = "/images/icon/status-needed-map-pin.png"
      }
      

     mymap.addMarker({
      lat: locations.latitude,
      lng: locations.longitude,
      icon: statusicon,      
      infoWindow: {
          maxWidth: 250,
          content: ('<span style="color:#424242;font-weight:500;font-size:14px;">'+locations.project_address_clean+', '+locations.location_city+', '+locations.state+', '+locations.zipcode+'</span>')
      }
    });

  </script>
@endsection  