<?php
	$incdir = "inc/";
	$path = "/";
	$index = "index";
	$suffix = ".htm.txt";
	include($incdir."init.inc.php");

  //init
  if (isset($_GET["path"])) { $path = $_GET["path"]; } ;//?
  if (isset($_GET["image"])) { $path = dirname($_GET["image"]);$image = urldecode($_GET["image"]); } ;//image and path
  if (isset($_GET["width"])) { $width = (int) $_GET["width"]; } else { $width=$defaultimagewidth; };//width of the image if specified
  
  // include last part of path into title, if available
  if (preg_match_all("/[^\/]+$/",$path,$matches)) {
    $title = $matches[0][0]." - ".$title;
  };//end preg match all
  $title = 

	//page head
	include("inc/head.inc.php");
  include("inc/opengraph.inc.php");

  //libraries
	include_once($incdir."page.functions.inc.php");
	include_once($incdir."photos.functions.inc.php");
	include_once($incdir."forms.functions.inc.php");
  include_once($incdir."googlecode.inc.php");//google analytics tracking
  include_once($incdir."googletagmanager.inc.php");//google tag manager  
  include_once($incdir."googletag.inc.php");//google +1 button
	include_once($incdir."facebook.likeit.inc.php");//facebook like it button
	include_once($incdir."cufon.inc.php");//script inline
	//include_once($incdir."chat.inc.php");//flash application / chat / Digsby
	//include_once($incdir."photos.countries.inc.php");
	//include_once($incdir."bannertoggle.inc.php");
  include_once($incdir."quantcast.inc.php");//quantcast measurement tags functions

  // google tracking code - based on analytics.js
  ga_track ($ga_trackcode);
  ?>
  </HEAD>
  <BODY>
  <?php
  
  // google tag manager
  ga_tag_manager ($google_tag_manager);
  // quantcast tracking code - second part
  qc_body($qc_string);
  
  // facebook init
  fb_init($fb_appid,$fb_channelfile,$fb_ga);
    
// PAGE LAYOUT
//main layout
	echo "<DIV CLASS=\"page\">\n";//circumvent the ie bug for doubling the margin on float, page is only block
//page banner
	include($incdir."bannerwrapper.inc.php");
//leftpane
	echo "<DIV CLASS=\"leftpane\">\n";//float to the left side
	echo "<DIV CLASS=\"innerpane\">\n";//inserted container to the negative margin shifts are not cropped
	//navigace
//navigace menu
	//$data = Navigace($pageleft, $ugroups, $privilege);
	$data = Navigace($path);
	WriteP($data, "<A HREF=\"/\" CLASS=\"leftpaneitem\">Úvod</A>");
//facebook likeit - writeout
	fb_likeit($fb_domain,$fb_send,$fb_faces,$fb_width);
// google +1 button
  gplus_button();
// chat application DigsbyChat(width,height)
  //ChatPopup(600,400,$incdir);
//logo
//image size switcher
//	include($incdir."switcher.inc.php");//left-out
	echo "</DIV> <!-- innerpane -->\n";
	echo "</DIV> <!-- leftpane -->\n";
//page content
	echo "<DIV CLASS=\"text\" VALIGN=\"top\">\n";
	$action = (isset($_GET["action"])) ? urldecode($_GET["action"]) : false ;
	switch ($action) {
		case "search" :
			if(isset($_POST["searchfield"])) { $searchfield = $_POST["searchfield"]; } else { $searchfield = false; };
			$data = SearchFor($searchfield);
			echo SearchTable($data);
		break;
		case "switcher" :
			$switcher=explode("x",$_GET["switcher"]);
			setcookie("imagewidth",$switcher[0]);
			setcookie("imageheight",$switcher[1]);
			$image = (isset($_GET["image"])) ? urldecode($_GET["image"]) : false ;
			ShowImage($image,value($switcher[0]));//test
		break ;
		case "image" :
			ShowImage($image,$width);
		break ;
		default :
			if (isset($formresult)) { echo $formresult; };
			WriteText($path);
			ShowThumbs($path);
		break;
	};//end if
	echo "</DIV> <!-- text -->\n";
	echo "</DIV> <!-- page -->\n";
//end libraries and scripts
include($incdir."cufon.end.inc.php");//cufon trigger

?>

</BODY>
</HTML>