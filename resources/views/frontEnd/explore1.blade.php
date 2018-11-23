<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../../frontend/global/vend/footable/footable.core.css">
  <link rel="stylesheet" href="../../frontend/assets/examples/css/tables/footable.css">

<style type="text/css">
.table a{
    text-decoration:none !important;
    color: #424242;
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
/*.page{
    margin-top: 55px !important;
}*/
#map{
    position: fixed !important;
}
#example_wrapper .row{
  width: 100%;
  margin: 0;
}
#example_wrapper{
  margin-top: 20px;
}
.col-sm-12{
  padding: 0;
}
.overlay{
    display: none !important;
}
</style>
<script src="{{asset('js/markerclusterer.js')}}"></script>
<script src="../../../frontend/global/vend/breakpoints/breakpoints.js"></script>
<script>
Breakpoints();
</script>

  <div class="row" style="margin-right: 0;min-height: calc(100vh - 296px);">
      <div class="col-md-8 pr-0">
          @if(!empty($successMsg))
                <div class="pl-15 pr-15 pt-15">
                    <div class="alert dark alert-dismissible" role="alert" style="background: #3f8a7b;
                    color: white;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4 class="feedback-title">Your district doesn't have Participatory Budgeting (PB) yet. PB is a democratic process in which community members directly decide how to spend part of a public budget in their neighborhood. In the US and Canada 414,000 people have worked together to decide how to spend over $299 Million dollars during the last decade - and we’re just getting started. To advocate to your elected officials to PB, get their contact info <a href="https://myreps.participatorybudgeting.org" target="_blank" style="text-decoration: underline;">here.</a></h4>
                    </div>
                </div>
          @endif
          <div class="panel m-15 content-panel">

              <div class="panel-body p-0">

                      <table class="table table-striped toggle-arrow-tiny mb-0" id="example" style="width:100%">
                          <thead>
                              <tr>
                                  <th class="text-center">Status</th>
                                  <th data-toggle="true" class="pr-20">Name</th>
                                  <th></th>
                                  <button type="button" class="btn btn-raised btn-info pull-right download" id="download_csv">Download CSV</button>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($projects as $project)
                              <tr> 
                                  <td class="text-center">
                                      @if($project->project_status_category!='')
                                          @if($project->project_status_category=='Complete')
                                              <button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic"><i class="icon fa-check" aria-hidden="true"></i></button>
                                          @elseif($project->project_status_category=='Project Status Needed')
                                              <button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic"></button>
                                          @elseif($project->project_status_category=='Lost vote')
                                              <button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic"><i class="icon fa-remove" aria-hidden="true"></i></button>
                                          @else
                                              <button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic"><i class="icon fa-minus" aria-hidden="true"></i></button>
                                          @endif
                                      @endif
                                  </td>
                                  <td>
                                      @if($project->project_title!='')
                                          <a class="profile_name" ajax_text="{{$project->project_title}}">{{$project->project_title}}</a>
                                      @endif
                                  </td>
                                  <td><i class="fa fa-chevron-right" style="padding-top: 8px;color: #000000;float: right;padding-right: 10px;"></i></td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>

              </div>
          </div>
      </div>
      <div class="col-md-4 p-0">
          <div id="map" style="position: fixed !important;width: 28%;"></div>
      </div>
  </div>
  <form action="/download_csv" method="post" id="download_form">
      @csrf
      <input type="text" id="hidden_projects" name="projects">
      <input type="submit" name="submit" id="download_submit">
  </form>
  @include('layouts.footer')


<script>
    $(document).ready(function(){
      var address_district = <?php echo json_encode($address_district); ?>;
      if( address_district != ''){
      
          $('#btn-district span').html("District:"+address_district);
          $('#btn-district span').attr('ajax_text',"District: "+address_district);
          $('#btn-district').show();
      };

      var locations = <?php print_r(json_encode($projects)) ?>;
  

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

      var zoom = 10;
      if($('#btn-district').css('display') != 'none')
          zoom = 13;
      var mymap = new GMaps({
        el: '#map',
        lat: avglat,
        lng: avglng,
        zoom:zoom,
        markerClusterer: function(map) {
          options = {
              imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
          }
          return new MarkerClusterer(map, [], options);
        }
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
            icon: statusicon,
            infoWindow: {
              maxWidth: 250,
              content: (icon+'<a class="profile_name" ajax_text="'+value.project_title+'">'+value.project_title+'</a>')
            },
            markerClusterer: function(map) {
              return new MarkerClusterer(map);
            }
          });
        });

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

<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        "pageLength": 25,
        "searching": false,
        "info":     false,
        "lengthChange": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        language:
        {
            paginate:
            {
                previous: "<<",
                next: ">>",
                first: "|<",
                last: ">|"
            }
        }    
    } );
} );
</script>