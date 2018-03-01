<!-- Core  -->
  <script src="../../../frontend/global/vend/babel-external-helpers/babel-external-helpers.js"></script>
  <!-- <script src="../../../frontend/global/vend/jquery/jquery.js"></script> -->
  <script src="../../../frontend/global/vend/tether/tether.js"></script>
  <script src="../../../frontend/global/vend/bootstrap/bootstrap.js"></script>
  <script src="../../../frontend/global/vend/animsition/animsition.js"></script>
  <script src="../../../frontend/global/vend/mousewheel/jquery.mousewheel.js"></script>
  <script src="../../../frontend/global/vend/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="../../../frontend/global/vend/asscrollable/jquery-asScrollable.js"></script>
  <script src="../../../frontend/global/vend/waves/waves.js"></script>
  <!-- Plugins -->
  <script src="../../../frontend/global/vend/switchery/switchery.min.js"></script>
  <script src="../../../frontend/global/vend/intro-js/intro.js"></script>
  <script src="../../../frontend/global/vend/screenfull/screenfull.js"></script>
  <script src="../../../frontend/global/vend/slidepanel/jquery-slidePanel.js"></script>
  <script src="../../../frontend/global/vend/moment/moment.min.js"></script>
  <script src="../../../frontend/global/vend/footable/footable.js"></script>
  <!-- Scripts -->
  <script src="../../../frontend/global/js/State.js"></script>
  <script src="../../../frontend/global/js/Component.js"></script>
  <script src="../../../frontend/global/js/Plugin.js"></script>
  <script src="../../../frontend/global/js/Base.js"></script>
  <script src="../../../frontend/global/js/Config.js"></script>
  <script src="../../frontend/assets/js/Section/Menubar.js"></script>
  <script src="../../frontend/assets/js/Section/Sidebar.js"></script>
  <script src="../../frontend/assets/js/Section/PageAside.js"></script>
  <script src="../../frontend/assets/js/Plugin/menu.js"></script>
  <!-- Config -->
  <script src="../../../frontend/global/js/config/colors.js"></script>
  <script src="../../frontend/assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', '../../assets');
  </script>
  <!-- Page -->
  <script src="../../frontend/assets/js/Site.js"></script>
  <script src="../../../frontend/global/js/Plugin/asscrollable.js"></script>
  <script src="../../../frontend/global/js/Plugin/slidepanel.js"></script>
  <script src="../../../frontend/global/js/Plugin/switchery.js"></script>
  <script src="../../frontend/assets/examples/js/tables/footable.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $("#sidebar").mCustomScrollbar({
              theme: "minimal"
          });
          $('#sidebarCollapse').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });

          $('#sidebarCollapse1').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });
          $('#distrit li').click(function(){
              var district = $(this).html();
              $('#btn-filter span').html("District:"+district);
              $('#btn-filter').show();
          });
          function sendfilter(){
            //$.ajax()
            filter_value = [];
            $('#filter_buttons button').each(function(){
                if($(this).css('display') != 'none')
                {
                  $('span', $(this)).html()
                }
            });
          }
      });
  </script>
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 175000,
      values: [ 0, 175000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      
        var value1 = ui.values[0]; var value2 = ui.values[1];
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        })
        $.ajax({ 
          type: "GET", 
          url: "/filter", 
          data: {
            price_min: value1,
            price_max: value2,
            vote_min: $( "#slider-range-vote" ).slider( "values", 0 ),
            vote_max: $( "#slider-range-vote" ).slider( "values", 1 ),
            year_min: $( "#slider-range-year" ).slider( "values", 0 ),
            year_max: $( "#slider-range-year" ).slider( "values", 1 )
          },
          cache: false, 
          success: function(html){ 
            console.log(html); 
            $('#content').html(html);
          } 
        });
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    // $( "#slider-range-year" ).slider({
    //   range: true,
    //   min: 2012,
    //   max: 2018,
    //   values: [ 2012, 2017 ],
    //   slide: function( event, ui ) {
    //     $( "#amount-year" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
    //   }
    // });


     $( "#slider-range-year" ).slider({ 
      range: true, 
      min: 2012, 
      max: 2018, 
      values: [ 2012, 2018 ], 
      slide: function( event, ui ) { 
        $( "#amount-year" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        var value1 = ui.values[0]; var value2 = ui.values[1];
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        })
        $.ajax({ 
          type: "GET", 
          url: "/filter", 
          data: {
            price_min: $( "#slider-range" ).slider( "values", 0 ),
            price_max: $( "#slider-range" ).slider( "values", 1 ),
            vote_min: $( "#slider-range-vote" ).slider( "values", 0 ),
            vote_max: $( "#slider-range-vote" ).slider( "values", 1 ),
            year_min: value1,
            year_max: value2
          },
          cache: false, 
          success: function(html){ $('#content').html(html); } }); } }); 



    $( "#amount-year" ).val(  $( "#slider-range-year" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-year" ).slider( "values", 1 ) );

    $( "#slider-range-vote" ).slider({
      range: true,
      min: 0,
      max: 6000,
      values: [ 0, 6000 ],
      slide: function( event, ui ) {
        $( "#amount-vote" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        var value1 = ui.values[0]; var value2 = ui.values[1];
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        })
        $.ajax({ 
          type: "GET", 
          url: "/filter", 
          data: {
            price_min: $( "#slider-range" ).slider( "values", 0 ),
            price_max: $( "#slider-range" ).slider( "values", 1 ),
            vote_min: value1,
            vote_max: value2,
            year_min: $( "#slider-range-year" ).slider( "values", 0 ),
            year_max: $( "#slider-range-year" ).slider( "values", 1 )
          },
          cache: false, 
          success: function(html){ $('#content').html(html); } });
        }
    });
    $( "#amount-vote" ).val(  $( "#slider-range-vote" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-vote" ).slider( "values", 1 ) );

  } );
  </script>

  