<script src="../../../frontend/global/vend/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../../../frontend/global/vend/jquery/jquery.js"></script>
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
  <script src="../../../frontend/global/vend/asrange/jquery-asRange.min.js"></script>
  <script src="../../../frontend/global/vend/ionrangeslider/ion.rangeSlider.min.js"></script>
  <script src="../../../frontend/global/js/Plugin/asrange.js"></script>
  <script src="../../../frontend/global/js/Plugin/ionrangeslider.js"></script>
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
      });
  </script>