<!DOCTYPE html>
<HTML <?php echo $html ?>>
<HEAD>
	<META CONTENT="text/html; charset=<?php echo $codepage ?>" HTTP-EQUIV="content-type">

	<META NAME="description" CONTENT="<?php echo $meta_description ?>">
	<META NAME="keywords" CONTENT="<?php echo $meta_keywords ?>">
	<META NAME="language" CONTENT="<?php echo $meta_language ?>">
	<META NAME="google-site-verification" CONTENT="<?php echo $google_site_verification ?>">

	<LINK REL="stylesheet" HREF="css/elweb.css" TYPE="text/css">	
	<LINK REL="stylesheet" HREF="css/<?php echo $cssfile?>" TYPE="text/css">
	<LINK REL="shortcut icon" HREF="pics/<?php echo $favicon?>">	
	<TITLE><?php echo $title; ?></TITLE>
	<BASE HREF="http://<?php echo $_SERVER["HTTP_HOST"]."/".$basedir ?>">


