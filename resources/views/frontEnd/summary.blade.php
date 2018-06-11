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
  height: 500px;
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
    position: fixed !important;
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
        <div class="row" style="margin-right: 0">
            <div class="col-md-8 pr-0">
                <div class="panel m-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY CATEGORY</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_category"></div>                   
                    </div>
                </div>
                <div class="panel m-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY VOTE</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_vote"></div>                   
                    </div>
                </div>
                <div class="panel m-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY COST</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_cost"></div>                   
                    </div>
                </div>
                <div class="panel m-15 content-panel">
                    <div class="panel-title pt-5 pb-0 text-center">
                        <h3>PROJECTS BY AGENCY</h3>
                    </div>
                    <div class="panel-body p-0">
                        <div id="chartdiv_agency"></div>                   
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div id="map" style="position: fixed !important;width: 28%;"></div>
            </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function () {
    var address_district = <?php echo json_encode($address_district); ?>;
    if( address_district != ''){
    
        $('#btn-district span').html("District: "+address_district);
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
    var locations = <?php print_r(json_encode($projects)) ?>;
    var sumlat = 0.0;
    var sumlng = 0.0;
    for(var i = 0; i < locations['data'].length; i ++)
    {
        sumlat += parseFloat(locations['data'][i].latitude);
        sumlng += parseFloat(locations['data'][i].longitude);

    }
    var avglat = sumlat/locations['data'].length;
    var avglng = sumlng/locations['data'].length;
    var mymap = new GMaps({
      el: '#map',
      lat: avglat,
      lng: avglng,
      zoom:10
    });


    $.each( locations['data'], function(index, value ){
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
        else if(value.project_status_category == "Not funded"){
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
                content: ('<a href="/profile/'+value.id+'" style="color:#424242;font-weight:500;font-size:14px;">'+icon+value.project_title+'</a>')
            }
        });
   });
</script>
@endsection


