<!-- Core  -->
  <script src="../../../frontend/global/vend/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../../../frontend/global/vend/tether/tether.js"></script>
<!--   <script src="../../../frontend/global/vend/bootstrap/bootstrap.js"></script> -->
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script>
$('#widget').draggable();
</script>
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
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es,fr,ru,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}

setInterval(function(){
  var iframe = $('.goog-te-menu-frame');
  $('table a .text', iframe.contents()).eq(1).text('中文');
  $('table a .text', iframe.contents()).eq(2).text('Français');
  $('table a .text', iframe.contents()).eq(3).text('Pусский');
  $('table a .text', iframe.contents()).eq(4).text('Español');
  $('.st-btn[data-network="blogger"]').hide();
  $('.st-btn[data-network="delicious"]').hide();
  $('.st-btn[data-network="digg"]').hide();
  $('.st-btn[data-network="flipboard"]').hide();
  $('.st-btn[data-network="googleplus"]').hide();
  $('.st-btn[data-network="livejournal"]').hide();
  $('.st-btn[data-network="mailru"]').hide();
  $('.st-btn[data-network="meneame"]').hide();
  $('.st-btn[data-network="messenger"]').hide();
  $('.st-btn[data-network="odnoklassniki"]').hide();
  $('.st-btn[data-network="pinterest"]').hide();
  $('.st-btn[data-network="reddit"]').hide();
  $('.st-btn[data-network="tumblr"]').hide();
  $('.st-btn[data-network="twitter"]').hide();
  $('.st-btn[data-network="vk"]').hide();
  $('.st-btn[data-network="wechat"]').hide();
  $('.st-btn[data-network="weibo"]').hide();
  $('.st-btn[data-network="whatsapp"]').hide();
  $('.st-btn[data-network="xing"]').hide();
}, 500);


</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
    $(document).ajaxSend(function( event, jqxhr, settings ){
        if(settings.url.indexOf("geo") == -1){
           $("*").animsition({
            inClass: 'fade-in',
            inDuration: 800,
            loading: true,
            loadingClass: 'loader-overlay',
            loadingParentElement: 'html',
            loadingInner: '\n      <div class="loader-content">\n        <div class="loader-index">\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>',
            onLoadEvent: true
          });

          
        }
        else{
          $('#loading').show();
        }
    });

    $(document).ajaxComplete(function(){

        $('.loader-overlay').remove();
        $('#loading').hide();
    });
});
  </script>



