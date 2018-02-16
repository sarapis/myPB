<script src="../../../frontend/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../../../frontend/global/vendor/jquery/jquery.js"></script>
  <script src="../../../frontend/global/vendor/tether/tether.js"></script>
  <script src="../../../frontend/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="../../../frontend/global/vendor/animsition/animsition.js"></script>
  <script src="../../../frontend/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../../../frontend/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="../../../frontend/global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <script src="../../../frontend/global/vendor/waves/waves.js"></script>
  <!-- Plugins -->
  <script src="../../../frontend/global/vendor/switchery/switchery.min.js"></script>
  <script src="../../../frontend/global/vendor/intro-js/intro.js"></script>
  <script src="../../../frontend/global/vendor/screenfull/screenfull.js"></script>
  <script src="../../../frontend/global/vendor/slidepanel/jquery-slidePanel.js"></script>
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
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>