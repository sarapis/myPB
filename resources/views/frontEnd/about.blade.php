@extends('layouts.app')
@section('title')
About
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
    .pac-logo:after{
      display: none;
    }
</style>
@section('content')
    <div class="row p-20">
        <div class="col-xl-7 col-md-7">
          <!-- Panel -->
          <div class="panel">
            <div class="panel-body">
                {!! $about->body !!}
            </div>
          </div>
          <!-- End Panel -->
        </div>
        <div class="col-xl-5 col-md-5">
          <!-- Panel -->
            <div class="panel">
                <div class="panel-body bg-custom">
                    <div class="form-group">
                        <h4 class="text-white">Does your NYC neighborhood do PB?</h4>
                        <div class="form-group">
                            <form method="get" action="/explore">
                              <div class="input-search">
                                  <i class="input-search-icon md-search" aria-hidden="true"></i>
                                  <input id="location" type="text" class="form-control text-black" name="address" placeholder="Search Street Address" style="border-radius:0;">
                              </div>
                            </form>
                        </div>
                        <a href="https://council.nyc.gov/pb/participate/" target="_blank"><h4 class="text-white mb-0">FIND OUT!</h4></a>
                    </div>
                </div>
                <div class="panel-body">
                    <p>What do people fund when given the opportunity? Check out how New York neighborhoods are spending public money and explore PB-generated projects here</p>
                </div>
            </div>
        </div>
          <!-- End Panel -->
    </div>


<script>
  function initAutocomplete() {
      var input = document.getElementById('location');
      var searchBox = new google.maps.places.SearchBox(input);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-RQR_KenWPqcgUbOtMLreNVWeTV1wcSo&libraries=places&callback=initAutocomplete" async defer></script>
@endsection

