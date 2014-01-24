<?php
function ga_track_old ($ga_trackcode,$ga_sampling="") {
  echo "
  <!-- Google Analytics -->
  <script type=\"text/javascript\">
  
    var _gaq = _gaq || [];
    
    _gaq.push(['_setAccount', '$ga_trackcode']);
    _gaq.push(['_trackPageview']);
  
    (function() {
    var ga = document.createElement('script'); 
      ga.type = 'text/javascript'; 
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga,s);
    })();
  </script>
  <!-- End Google Analytics -->
  ";
};//end ga_tracks

function ga_track ($ga_trackcode,$ga_sampling="") {
  echo "
    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','gaTracker');
      
      //debug
      /*
      gaTracker(function() {
        alert('library done loading');
      });
      */
            
      gaTracker('create', '$ga_trackcode'$ga_sampling);
      gaTracker('send', 'pageview');
      //debug
      /*
      gaTracker('send', 'pageview',{
                            'hitCallback': function() {
                                            alert('analytics.js done sending data');
                                          }
                            });
      */
    </script>
    <!-- End Google Analytics -->
  ";
};//end ga_track