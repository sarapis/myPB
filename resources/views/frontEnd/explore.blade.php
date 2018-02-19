@extends('layouts.app')
@section('title')
Explore
@stop

@section('content')
<div class="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content Holder -->
    <div id="content">
        <!-- Example Range -->
        <div class="example-wrap">
            <h4 class="example-title">Range</h4>
            <div class="example mt-30">
              <div class="asRange" data-plugin="asRange" data-namespace="rangeUi" data-step="10"
              data-min="2" data-range="true" data-tip=true data-value="[10,70]"></div>
            </div>
        </div>
        <!-- End Example Range -->
    </div>
</div>
@endsection