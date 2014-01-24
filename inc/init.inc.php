<?php
$basedir = "";
$title = "Bydlení Hládkov - dlouhodobý, dostupný a pohodový pronájem od majitele na Praze 6, Hládkově, nedaleko Pražského hradu";
$subtitle = "Vaše pohodové Bydlení Hládkov Praha 6";
$cssfile = "custom.css";
$favicon = "favicon.ico";
$banner = "inc/heading1.inc.php";
$bannerimage = "/pics/background_banner.jpg";
$rootpage = false;
$codepage = "utf-8";
$favicon = "favicon.ico";
$defaultimagewidth= "640";

$html = "xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\" ";

//cufon init
$cufon_library = "js/cufon-yui.js";
$cufon_font = "js/Myriad_Pro_700.font.js";
$cufon_replace_class = "h1, .leftpanelink1, .leftpaneitem, .banner";

$ga_trackcode="UA-15947606-1";
$ga_trackcode_sampled="UA-15947606-3";
$ga_sampling=", { 'sampleRate': 5 }";
$google_site_verification="jnCREwrhg7k8hILrqYG0NL2id4etdSanIItwRGvPxJM";
$google_tag_manager="GTM-N4B683";

$qc_string="p-wMScbDMUN_0HS";//quantcast tracking string

//facebook
$html .= "xmlns:fb=\"http://ogp.me/ns/fb#\" xmlns:og=\"http://ogp.me/ns#\" ";
$fb_domain="http://www.hladkov.cz";
$fb_send="true";//1=true,0=false
$fb_faces="false";//1=true,0=false
$fb_width="100";
$fb_channelfile="//www.hladkov.cz/inc/facebook.channel.inc.php";
$fb_ga=true;//if hook fb like to edge for GA events report


$meta_description="Popis a nabídka bytů k pronájmu majitelem bytového domu na Praze 6, Hládkově. Prostorné rekonstruované byty v domě z 30 let větších rozměrů pro pohodlné bydlení rodinám nebo skupinám studentů.";
$meta_keywords="ubytovani,pronajem,podnajem,hladkov,byty";
$meta_language="Czech";

//opengraph $html .= " prefix=\"og: http://ogp.me/ns#\" "; $og_title=$subtitle;
$og_title=$subtitle; 
$og_description=$title; 
$og_type="website"; 
$og_url="http://www.hladkov.cz"; 
$og_image="http://www.hladkov.cz/pics/04%20Hladkov.jpg"; 
$og_locale="cs_CZ"; 
$og_locale_alternate=array("en_GB","en_US");
$fb_admins="1022581272";
$fb_appid="344835798979213";

?>
