<HTML>
<head>
<?php include('init.inc.php') ?>
</head>

<body>
<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- facebook button -->
  <?php 
  echo "
  <fb:like href=\"$fb_domain\" send=\"$fb_send\" layout=\"button_count\" width=\"$fb_width\" show_faces=\"$fb_faces\"></fb:like>
  ";
?>	
  
</body>
</html>