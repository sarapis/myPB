<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<!--   <meta name="description" content="bootstrap admin template"> -->
  <meta name="author" content="">
  <meta name="_token" content="{!! csrf_token() !!}" />
  <title>@yield('title')| PBNYC</title>
  <link rel="apple-touch-icon" href="../../frontend/assets/images/apple-touch-icon.png">
  <link rel="canonical" href="" />
  <link rel="shortcut icon" href="../../frontend/assets/images/favicon.ico">
  <!-- Stylesheets -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css" />
   
   <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  <link rel="stylesheet" href="../../../frontend/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../frontend/global/css/bootstrap-extend.min.css">

  <link rel="stylesheet" href="../../frontend/assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="../../../frontend/global/vend/animsition/animsition.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/switchery/switchery.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/intro-js/introjs.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/waves/waves.css">
  <link rel="stylesheet" href="../../../../frontend/global/fonts/web-icons/web-icons.css">
   <link rel="stylesheet" href="../../../../frontend/global/fonts/font-awesome/font-awesome.css">
  <link rel="stylesheet" href="../../../frontend/global/fonts/material-design/material-design.min.css">
  <link rel="stylesheet" href="../../../frontend/global/fonts/brand-icons/brand-icons.min.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/asrange/asRange.css">

  <link rel="stylesheet" href="../../../css/explorestyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script src="{{asset('js/filter_ajaxscript.js')}}"></script>
  <script src="../../../frontend/global/vend/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>
  <script type='text/javascript' src='{{asset("js/sharethis.js#property=5a98fe1e54d8310013ae576a&product=inline-share-buttons")}}' async='async'></script>
 <!--  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bb2cb9985136400117096ad&product=inline-share-buttons' async='async'></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo-Ba1uQA_-eQ0zAA-ymOSrfrakLUZsHo">
    </script>
  <script src="{{asset('js/gmaps.js')}}"></script>
  <script src="{{asset('js/markerclusterer.js')}}"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113999334-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113999334-1');
</script>
 <style>
  body{
    top: 0 !important;
  }
  #st-1 .st-btn[data-network='sharethis'] {
    background: transparent !important;
    padding-left: 0;
  }
  #google_translate_element{
    padding-top: 21px;
  }
  .goog-te-banner-frame.skiptranslate{
    display: none;
  }
  .goog-te-gadget img {
    display: none;
  }
  .goog-te-gadget-simple {
    background-color: transparent !important;
    border: 0 !important;
  }
  .goog-te-gadget-simple .goog-te-menu-value span {
    color: white;
    font-size: 14px;
    font-weight: 500;
  }
  .goog-te-menu-value span{
    font-family: 'Poppins', sans-serif !important;
  }
  
  .goog-te-menu-value span:nth-child(3){
    display: none;
  }
  .goog-te-menu-value span:nth-child(5){
    display: none;
  }
  .goog-te-menu-value span:nth-child(1){
    
  }
  .goog-te-gadget-simple .goog-te-menu-value span {
    visibility: hidden;
  }
  .goog-te-gadget-simple .goog-te-menu-value span:before {
    content: 'Languages';
    visibility: visible;
  }
  .goog-te-menu-value {
    max-width: 80px;
    display: inline-block;
  }
 </style>
</head>