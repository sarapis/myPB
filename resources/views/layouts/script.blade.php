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
              $('.overlay').fadeIn();
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });

          $('#sidebarCollapse1').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.overlay').fadeOut();
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });
          $('#district li').click(function(){

              var value = $(this).html();
              $('#btn-district span').html("District:"+value);
              $('#btn-district').show();
              sendfilter();
          });
          $('#projectstatus li').click(function(){
              var value = $('span',this).html();
              $('#btn-status span').html("Status:"+value);
              $('#btn-status').show();
              sendfilter();
          });
          $('#projectcategory li').click(function(){
              var value = $(this).html();
              $('#btn-category span').html("Category:"+value);
              $('#btn-category').show();
              sendfilter();
          });
          $('#cityagency li').click(function(){
              var value = $(this).html();
              $('#btn-city span').html("City:"+value);
              $('#btn-city').show();
              sendfilter();
          });
          $('#filter_buttons button').click(function(){
              $(this).hide();
              sendfilter();
          });
          function sendfilter(){
           
            var form_data = new FormData();    
            // var form_data = [];
            // var form_name = [];
            $('#filter_buttons button').each(function(index){
                
                if($(this).css('display') != 'none')
                {
                  var values = $('span', $(this)).html();
                  value_array = values.split(':');
                 
                  form_data.append(value_array[0],value_array[1]);
                  //form_data[] = value_array[1];
                }
            });
            ///
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
            })    
            $.ajax({
              type: 'POST',
              url: "/range",
              data: form_data,
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false,
              success: function(data) {

                $('#content').html(data);
              },
              error: function(errResponse) {
              
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
      max: 1500000,
      values: [ 0, 1500000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      
        var value1 = ui.values[0]; var value2 = ui.values[1];

        
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
         } }); 



    $( "#amount-year" ).val(  $( "#slider-range-year" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-year" ).slider( "values", 1 ) );

    $( "#slider-range-vote" ).slider({
      range: true,
      min: 0,
      max: 5293,
      values: [ 0, 5293 ],
      slide: function( event, ui ) {
        $( "#amount-vote" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        var value1 = ui.values[0]; var value2 = ui.values[1];
        
        }
    });

    $( "#amount-vote" ).val(  $( "#slider-range-vote" ).slider( "values", 0 ) +
      " - " + $( "#slider-range-vote" ).slider( "values", 1 ) );
    $('.ui-slider-handle.ui-corner-all.ui-state-default').mouseup(function(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        })
        $.ajax({ 
          type: "GET", 
          url: "/explore", 
          data: {
            price_min: $( "#slider-range" ).slider( "values", 0 ),
            price_max: $( "#slider-range" ).slider( "values", 1 ),
            vote_min: $( "#slider-range-vote" ).slider( "values", 0 ),
            vote_max: $( "#slider-range-vote" ).slider( "values", 1 ),
            year_min: $( "#slider-range-year" ).slider( "values", 0 ),
            year_max: $( "#slider-range-year" ).slider( "values", 1 ),
            is_ajax:true
          },
          cache: false, 
          success: function(html){ 
            console.log(html); 
            $('#content').html(html);
          } 
        });
      });

  } );
  </script>

  