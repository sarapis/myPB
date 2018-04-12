<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <meta name="_token" content="{!! csrf_token() !!}" />
  <title>@yield('title')| PBNYC</title>
  <link rel="apple-touch-icon" href="../../frontend/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../../frontend/assets/images/favicon.ico">
  <!-- Stylesheets -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
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
  <!-- Fonts -->
  <link rel="stylesheet" href="../../../../frontend/global/fonts/web-icons/web-icons.css">
   <link rel="stylesheet" href="../../../../frontend/global/fonts/font-awesome/font-awesome.css">
  <link rel="stylesheet" href="../../../frontend/global/fonts/material-design/material-design.min.css">
  <link rel="stylesheet" href="../../../frontend/global/fonts/brand-icons/brand-icons.min.css">
  <link rel="stylesheet" href="../../../frontend/global/vend/asrange/asRange.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <link rel="stylesheet" href="../../../css/explorestyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <!--[if lt IE 9]>
    <script src="../../../frontend/global/vend/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../../frontend/global/vend/media-match/media.match.min.js"></script>
    <script src="../../../frontend/global/vend/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  
  <!-- <script src="../../../frontend/global/vend/jquery/jquery.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

  <script src="../../../frontend/global/vend/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>
  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a98fe1e54d8310013ae576a&product=inline-share-buttons' async='async'></script>
  <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMtpxeKLL1goekXSe73nSY8mtgK9q2ys&v=3.exp&callback=initMap"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo-Ba1uQA_-eQ0zAA-ymOSrfrakLUZsHo">
    </script>
  <script src="{{asset('js/gmaps.js')}}"></script>

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