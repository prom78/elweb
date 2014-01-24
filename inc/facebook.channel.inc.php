<?php
  // Adding a Channel File greatly improves the performance of the JS SDK by addressing issues with cross-domain communication in certain browsers.
  // The channel file should be set to be cached for as long as possible. When serving this file, you should send valid Expires headers with a long expiration period. This will ensure the channel file is cached by the browser and not reloaded with each page refresh. Without proper caching, users will suffer a severely degraded experience.     
  $cache_expire = 60*60*24*365;
  header("Pragma: public");
  header("Cache-Control: max-age=".$cache_expire);
  header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
?>
 <script src="//connect.facebook.net/cs_CZ/all.js"></script>