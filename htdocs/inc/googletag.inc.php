<?php

// source: https://developers.google.com/+/web/+1button/?hl=en
function gplus_button() {
  echo "
  <!-- Place this tag where you want the +1 button to render. -->
  <div class=\"g-plusone\" data-annotation=\"inline\" data-width=\"300\"></div>
  
  <!-- Place this tag after the last +1 button tag. -->
  <script type=\"text/javascript\">
    window.___gcfg = {lang: 'cs'};
  
    (function() {
      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
      po.src = 'https://apis.google.com/js/plusone.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
  </script>
  ";
};//end gplus_button
