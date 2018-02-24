@extends('layouts.app')
@section('title')
About
@stop

@section('content')
    <div class="row">
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
                            <div class="input-search">
                                <i class="input-search-icon md-search" aria-hidden="true"></i>
                                <input type="text" class="form-control text-black" name="" placeholder="Address search" style="border-radius:0;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <p>What do people fund when given the opportunity? Check out how New York neighborhoods are spending public money and explore PB-generated projects here</p>
                </div>
            </div>
        </div>
          <!-- End Panel -->
    </div>
@endsection