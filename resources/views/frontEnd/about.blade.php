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
                        <!-- <div class="form-group">
                            <div class="input-search">
                                <i class="input-search-icon md-search" aria-hidden="true"></i>
                                <input type="text" class="form-control text-black" name="" placeholder="Search Street Address" style="border-radius:0;">
                            </div>
                        </div> -->
                        <a href="https://council.nyc.gov/pb/participate/" target="_blank"><h4 class="text-white mb-0">FIND OUT!</h4></a>
                    </div>
                    <!-- <div class="input-group">
                        <input id="location" class="form-control gm-err-autocomplete">
                        <label class="input-group-addon" for="location"><i class="fa fa-fw fa-map-marker" aria-hidden="true"></i></label>
                    </div> -->
                </div>
                <div class="panel-body">
                    <p>What do people fund when given the opportunity? Check out how New York neighborhoods are spending public money and explore PB-generated projects here</p>
                </div>
            </div>
        </div>
          <!-- End Panel -->
    </div>
@endsection