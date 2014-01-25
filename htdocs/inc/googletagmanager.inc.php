<?php

// implementation of the code for the google tag manager
function ga_tag_manager($google_tag_manager) {
  echo " 
    <!-- Google Tag Manager -->
    <noscript>
      <iframe src=\"//www.googletagmanager.com/ns.html?id=GTM-N4B683\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe>
    </noscript>
    <script>
    (function(w,d,s,l,i){
      w[l]=w[l]||[];
      w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
      var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
      j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;
      f.parentNode.insertBefore(j,f);
    })
      (window,document,'script','dataLayer','$google_tag_manager');
    </script>
    <!-- End Google Tag Manager -->
  ";
};//end ga_tag_manager
?>