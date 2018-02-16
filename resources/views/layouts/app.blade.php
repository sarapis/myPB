<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.style')
@include('layouts.header')

    <!-- page content -->
    <div class="page">
	    <div class="page-content">
	      @yield('content')
	    </div>
	</div>
	<!-- /page content -->

 @include('layouts.footer')
 @include('layouts.script')