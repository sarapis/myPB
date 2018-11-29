@extends('layouts.app')
@section('title')
Summary
@stop
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<style type="text/css">
#chartdiv_category {
    width       : 100%;
    height      : 450px;
    font-size   : 14px;
}
#chartdiv_vote {
    width       : 100%;
    height      : 450px;
    font-size   : 14px;
} 
#chartdiv_cost {
    width       : 100%;
    height      : 450px;
    font-size   : 14px;
}

#chartdiv_agency {
  width: 100%;
  height: 450px;
  font-size: 11px;
}

.amcharts-pie-slice {
  transform: scale(1);
  transform-origin: 50% 50%;
  transition-duration: 0.3s;
  transition: all .3s ease-out;
  -webkit-transition: all .3s ease-out;
  -moz-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
  cursor: pointer;
  box-shadow: 0 0 30px 0 #000;
}

.amcharts-pie-slice:hover {
  transform: scale(1.1);
  filter: url(#shadow);
}                               
#map{
    z-index: 1 !important;
    height: 400px !important;
    display: block !important;
}
ul#ui-id-1 {
    width: 260px !important;
}
#tab_sort{
    display: none !important;
}
.nav.nav-tabs.nav-tabs-line.ui-tabs-nav.ui-corner-all.ui-helper-reset.ui-helper-clearfix.ui-widget-header{
    display: none;
}
</style>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
@section('content')
<div class="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content Holder -->
    <div id="content" class="container">
        <!-- <div id="map" style="height: 30vh;"></div> -->
        <!-- Example Striped Rows -->
        <div class="row ml-10 mr-10">
            <div class="col-md-12 p-10">
                @if (session('success'))
                    <div class="alert dark alert-dismissible" role="alert" style="background: #3f8a7b;
                    color: white;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4 class="feedback-title">Your district doesn't have Participatory Budgeting (PB) yet. PB is a democratic process in which community members directly decide how to spend part of a public budget in their neighborhood. In the US and Canada 414,000 people have worked together to decide how to spend over $299 Million dollars during the last decade - and we’re just getting started. To advocate to your elected officials to PB, get their contact info <a href="https://myreps.participatorybudgeting.org" target="_blank" style="text-decoration: underline;">here.</a></h4>
                    </div>
                @endif

                <div id="map" style="width: 100%;"></div>
            </div>
            <div class="col-md-6 p-10">
                <div class="panel m-0 mb-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY CATEGORY</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_category"></div>                   
                    </div>
                </div>
                 <div class="panel m-0 mb-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY COST</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_cost"></div>                   
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-10">              
                <div class="panel m-0 mb-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY VOTE</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_vote"></div>                   
                    </div>
                </div>
                <div class="panel m-0 mb-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY AGENCY</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_agency"></div>                   
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
<form action="/download_pdf" method="post" id="download_form">
    @csrf
    <input type="text" id="hidden_projects" name="projects">
    <input type="text" id="hidden_price_min" name="price_min">
    <input type="text" id="hidden_price_max" name="price_max">
    <input type="text" id="hidden_year_min" name="year_min">
    <input type="text" id="hidden_year_max" name="year_max">
    <input type="text" id="hidden_vote_min" name="vote_min">
    <input type="text" id="hidden_vote_max" name="vote_max">
    <input type="text" id="hidden_address" name="address" value="{{$address_district}}">
    <input type="text" id="hidden_status" name="status">
    <input type="text" id="hidden_category" name="category">
    <input type="text" id="hidden_city" name="city">
    <input type="submit" name="submit" id="download_submit">
</form>
<script>
 $(document).ready(function () {
    var address_district = <?php echo json_encode($address_district); ?>;
    if( address_district != ''){
    
        $('#btn-district span').html("District: "+address_district);
        $('#btn-district span').attr('ajax_text',"District: "+address_district);
        $('#btn-district').show();
    };
});
</script>
<script>
    $(document).ready(function(){
        if(screen.width < 768){
          var text= $('.navbar-container').css('height');
          var height = text.slice(0, -2);
          $('.page').css('padding-top', height);
          $('#content').css('top', height);
        }
        else{
          var text= $('.navbar-container').css('height');
          var height = text.slice(0, -2);
          $('.page').css('margin-top', height);
        }
    });
</script>

@include('frontEnd.categorychart')
@include('frontEnd.votechart')
@include('frontEnd.costchart')
@include('frontEnd.agencychart')

<script>
    var locations = <?php print_r(json_encode($location_maps)) ?>;
  

    var sumlat = 0.0;
    var sumlng = 0.0;
    for(var i = 0; i < locations.length; i ++)
    {
        sumlat += parseFloat(locations[i].latitude);
        sumlng += parseFloat(locations[i].longitude);

    }

    var avglat = sumlat/locations.length;
    var avglng = sumlng/locations.length;

  

    if(!avglat){
        avglat = 40.730981;
        avglng = -73.998107
    }

    var mymap = new GMaps({
      el: '#map',
      lat: avglat,
      lng: avglng,
      zoom:13
    });


    $.each( locations, function(index, value ){
        var icon;
        var statusicon;
        if(value.project_status_category == "Complete"){
            icon = '<button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic mr-5" style="box-shadow:none;"><i class="icon fa-check" aria-hidden="true"></i></button>';
            statusicon = "/images/icon/completed-map-pin.png";
        }
        else if(value.project_status_category == "Project Status Needed"){
            icon = '<button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-5" style="box-shadow:none;"></button>';
            statusicon = "/images/icon/status-needed-map-pin.png";
        }
        else if(value.project_status_category == "Lost vote"){
            icon = '<button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-5" style="box-shadow:none;"><i class="icon fa-remove" aria-hidden="true"></i></button>';
            statusicon = "/images/icon/not-funded-map-pin.png";
        }
        else{
            icon ='<button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-5" style="box-shadow:none;"><i class="icon fa-minus" aria-hidden="true"></i></button>';
            statusicon = "/images/icon/in-progress-map-pin.png";
        }

        mymap.addMarker({
            lat: value.latitude,
            lng: value.longitude,
            title: value.city,
            icon : statusicon,      
            infoWindow: {
                maxWidth: 250,
                content: (icon+'<a class="profile_name" ajax_text="'+value.project_title+'">'+value.project_title+'</a>')
            }
        });
   });
</script>
@endsection


