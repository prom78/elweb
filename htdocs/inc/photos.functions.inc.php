<?php
// library to show all the pictures in the folder as thumbnails using thumbnail script and end of it show the index.htm.txt
function ShowThumbs($path,$album_width = 6,$image_width = 100,$suffices="jpg|gif|png",$homedir=false,$textfile="index.htm.txt") {
	if (!$homedir) { $homedir = "{$_SERVER['DOCUMENT_ROOT']}/home"; };
	//print images
	if (is_dir($homedir.$path)) {
		//get all images in folder
		$images=array();
		$suffices=explode("|",$suffices);
		//$images=array_merge($images,glob(rtrim($homedir.$path,"/")."/*.".$suffix));
		if($dh=opendir($homedir.$path)) {
			while($file=readdir($dh)) {
				if(in_array(array_pop(explode(".",strtolower($file))),$suffices)) { $images[]=$file; };
			};//end while
		closedir($dh);
		};//end if
		//sort images in folder
		sort($images);
		//show images
		if (count($images)) {
			//write the album images
			echo "<DIV CLASS=\"gallery\">\n";
			$album_position = 0;
			while ($album_position<count($images)) {
				for ($i=0;$i<$album_width;$i++) {
					if ($album_position<count($images)) {
						//image thumbnail
						echo "<DIV CLASS=\"galleryitem\" STYLE=\"width:".($image_width+20)."\">";
						switch(strtolower(array_pop(explode(".",$images[$album_position])))) {
							case "jpg": case "gif": case "png":
								echo '<A HREF="'.$_SERVER['PHP_SELF'].'?action=image&image='.urlencode("$path/{$images[$album_position]}").'" TITLE="'.$images[$album_position].'">';
								echo '<IMG SRC="/inc/thumbnail.inc.php?image='.urlencode($path).'/'.urlencode($images[$album_position]).'">';
								echo '</A>';
								echo "<DIV>{$images[$album_position]}</DIV>";
							break;
							case "mpg":
								$avithumbnail = substr($image["name"],0,strlen($image["name"])-strlen($image["suffix"]))."thm";
								if (!file_exists($folder."/".$avithumbnail)) { $avithumbnail = "pic/avi.jpg"; };
								echo "<A HREF=\"".urlencode("$folder/{$image["name"]}")."\" TITLE=\"".$image["name"]."\"><IMG SRC=\"/inc/thumbnail.php?image=/".urlencode("$folder/$avithumbnail")."\"></A>";
							break;
						};//end switch
						echo "</DIV>\n";
					};//end if
					$album_position++;
				};//end for
			};//end while
			echo "</DIV><!-- gallery -->\n";
		};//end if image found
	};//end if folder
};//end function

//show one individual image
function ShowImage($image=false,$width=false,$homedir=false) {
	if($image) { $path=dirname($image); } else { $image=false;$path="/"; };
	if (!$homedir) { $homedir = "{$_SERVER['DOCUMENT_ROOT']}/home"; };
	if (!$width) { $width = 640; } else { $width= (int) $width; };
	//get all the images in the folder to count the position of the image and the total number
	if (is_dir($homedir.$path)) {
		//get all images in folder
		$images = array();
		$dh = opendir($homedir.$path);
		while (($diritem = readdir($dh)) !== false) {
			if (strpos(strtolower($diritem),".jpg")) {//must be limited to the jpg only because the resizing sofar works only for jpg
				$images[] = $diritem;
			};//end if
		};//end while
		//sort images in folder
		sort($images);
	};//end if is_dir
//var_dump($images);
	if (file_exists($homedir.$image)) {
		$position=array_search(basename($image),$images)+1;
		$count=count($images);
		$image_prev=$path."/".basename($images[($position-2+$count)%$count]);//minus because of zero based array
		$image_next=$path."/".basename($images[($position+$count)%$count]);
		$fullpath="/".array_pop(explode("/",$homedir));
		echo "<DIV CLASS=\"center\">\n";
		echo "<DIV CLASS=\"caption\">".basename($image,".jpg")." <SPAN CLASS=\"position\">($position/$count)</SPAN></DIV>";
		echo "<DIV CLASS=\"position\">";
		//move prev, next
		echo "<TABLE ALIGN=\"center\" WIDTH=\"$width\" BORDER=\"0\"><TD ALIGN=\"left\" WIDTH=\"100\"><A HREF=\"".$_SERVER['PHP_SELF']."?action=image&image=".urlencode($image_prev)."&width=$width\">< předchozí</A> </TD>";
		//resize image size
		echo "<TD ALIGN=\"center\"><SPAN STYLE=\"font-size:small;\"><A HREF=\"".$_SERVER['PHP_SELF']."?action=image&image=".urlencode($image)."&width=480\">small(480x320)</A></SPAN> <SPAN STYLE=\"font-size:normal;\"><A HREF=\"".$_SERVER['PHP_SELF']."?action=image&image=".urlencode($image)."&width=640\">middle(640x480)</A></SPAN> <SPAN STYLE=\"font-size:large;\"><A HREF=\"".$_SERVER['PHP_SELF']."?action=image&image=".urlencode($image)."&width=800\">large(800x600)</A></SPAN></TD>";
		echo "<TD ALIGN=\"right\" WIDTH=\"100\"><A HREF=\"".$_SERVER['PHP_SELF']."?action=image&image=".urlencode($image_next)."&width=$width\">další ></A></TD></TABLE>\n";
		echo "</DIV>";
		echo "<DIV CLASS=\"center\">";
		echo "<IMG SRC=\"/inc/thumbnail.inc.php?image=".urlencode($image)."&width=$width\">";
		echo "</DIV>\n";
		echo "</DIV>\n";
	};//end if
};//end function show image
?>
