  <!-- Quantcast Tag, part 1 -->
  <script type="text/javascript">
      var _qevents = _qevents || [];
      (function() {
          var elem = document.createElement('script');
          elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge")  
                      + ".quantserve.com/quant.js";
          elem.async = true;
          elem.type = "text/javascript";
          var scpt = document.getElementsByTagName('script')[0];
          scpt.parentNode.insertBefore(elem, scpt);  
      })();
  </script>
  <!-- Quantcast Tag, part 1 end -->

<?php
function qc_body($qc_string) {
echo'
  <!-- Quantcast Tag, part 2 -->
  <script type="text/javascript">
      _qevents.push( { qacct:"'.$qc_string.'"} );
  </script>
  <noscript>
      <div style="display: none;">
          <img src="//pixel.quantserve.com/pixel/p-test123.gif" height="1" width="1" alt="Quantcast"/>
      </div>
  </noscript>
  <!-- Quantcast Tag, part 2 end -->  
';
};//end QuantcastBody

?>