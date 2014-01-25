<?php

// init FB main function for FB features to work
// fb_ga boolean to include (subscribe) for events tracking of clicking FB button to Google Analytics - requires Google Analytics to be included
function fb_init($fb_appid,$fb_channelfile,$fb_ga=true) {
  echo "
    <!-- facebook code -->
    <div id=\"fb-root\"></div>
    <script>
      
      // Load the SDK asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = \"//connect.facebook.net/cs_CZ/all.js#xfbml=1&appId=$fb_appid\";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));


        // Additional initialization code such as adding Event Listeners goes here
    
        //facebook like event for Google Analytics    
        //source: https://developers.google.com/analytics/devguides/collection/analyticsjs/events
        FB.Event.subscribe('edge.create', function(targetUrl) {
                                            ga('send', 'facebook', 'like', targetUrl);
                                          });
        
        //facebook unlike event for Google Analytics
        FB.Event.subscribe('edge.remove', function(targetUrl) {
                                            ga('send', 'facebook', 'unlike', targetUrl);
                                          });

    </script>
    <!-- facebook code -->
    
    
  ";
};//end fb_init

//echo code for FB likeit button
function fb_likeit($fb_domain,$fb_send=false,$fb_faces=false,$fb_width=100) {
	echo "
    <!-- facebook button -->
    <div class=\"fb-like\" data-href=\"$fb_domain\" data-width=\"$fb_width\" data-height=\"$fb_height\" data-colorscheme=\"light\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"$fb_faces\" data-send=\"false\"></div>  
	";
  };//end fb_likeit


?>

