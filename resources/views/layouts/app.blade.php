<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.style')
@include('layouts.header')
<body>
    <!-- page content -->
    <div class="page">

	    @yield('content')
	    
	</div>
	<!-- /page content -->
	 @include('layouts.footer')
</body>
 @include('layouts.script')