<?php
$image = (isset($_GET["image"])) ? $_GET["image"] : false ;
//make sure for the html entitites to deal with the diacritics
$image_coded = htmlentities($image);
$width = (isset($_GET["width"])) ? (int)$_GET["width"] : 100 ;
$homedir = (isset($_GET["homedir"])) ? "{$_SERVER['DOCUMENT_ROOT']}{$_GET["homedir"]}" : "{$_SERVER['DOCUMENT_ROOT']}/home" ;
GetThumbnail($homedir,$image,$width);

//operation to try if the image name is htmlencoded and therefore not found as the browser decodes the htmlentity
function GetThumbnail($homedir,$image,$width,$height=false) {
	//echo "<IMG SRC=\"$image\">";//test
	if(file_exists($homedir.$image)) {
		//image name not encoded into html entities
		HandleImage($homedir.$image,$width,$height=false);
	} elseif(file_exists($homedir.htmlentities($image))) {
		//image name encoded into html entities
		HandleImage($homedir.htmlentities($image),$width,$height=false);
	} else {
		die("Image $homedir$image not found!");//alas
	};//end if
};//end GetThumbnail

//get the file into memory and resize it and return back as an image
function HandleImage($image,$width,$height=false) {
	//init
	if (!$height) { $height=round($width*3/4); } else { $height=(int) $height; };
	//get image into memory handle
  switch($extension=strtolower(pathinfo($image,PATHINFO_EXTENSION))) {
    case "jpg" : case "jpeg" :
      $imagetype="jpeg";
      $handle = imagecreatefromjpeg($image);
      break;
    case "png" :
      $imagetype="png";
      $handle = imagecreatefrompng($image);
      break;
    case "gif" :
      $imagetype="gif";
      $handle = imagecreatefromgif($image);
      break;
    default :
      echo "Error: Image file extension unrecognized\n";
      $handle = false;
  };//end switch
	if ($handle) {
		$x=imagesx($handle);
		$y=imagesy($handle);
		//get proportional sizes for image, max the given w & h
		if ($width/$x > $height/$y) {$width = ceil($height/$y * $x);} else {$height = ceil($width/$x * $y);};
		//echo "$x;$width;$y;$height";die;

		//create small image
		$black_picture = imageCreatetruecolor($width,$height);
		imagefill($black_picture,0,0,imagecolorallocate($black_picture, 255, 255, 255));
		imagecopyresampled($black_picture, $handle, 0, 0, 0, 0,$width, $height, imagesx($handle), imagesy($handle));
		imagedestroy($handle);

    // send image to output
    // but first ensure caching of the thumbnail not to exceed the memory limit
    session_start(); 
    header("Cache-Control: private, max-age=10800, pre-check=10800");
    header("Pragma: private");
    header("Expires: " . date(DATE_RFC822,strtotime("+14 days")));
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == filemtime($image))) {
      // send the last mod time of the file back
      header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($image)).' GMT', true, 304);
    };//end if modified since
    
    // generate a thumbnail off the $img file, and tell the browser to cache the result.
    

    // and here we send the image to the browser with all the stuff required for tell it to cache
    header("Content-type: image/jpeg");
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($image)) . ' GMT');
		imagejpeg($black_picture,NULL, '80');
		imagedestroy($black_picture);

	} else {
		echo "Error: Image handling library not working\n";
	};//end if
};//end HandleImage
?>