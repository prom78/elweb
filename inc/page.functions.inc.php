<?php
function Navigace($path = "", $homedir = false ) {
	$data = array();//init data
	//get ancestors pagelefts
	ItemAdding($data,$path,"/",$homedir);
	//sort($data);//sorting the dataitems, i.e. the folders to appear in aplhabetical order in the left menu
	return($data);
};//end navigace

function ItemAdding(&$data,$path="/",$current,$homedir=false,$aquo=1) {//recursive function adding children items until item within which pageleft is found
	if (!$homedir) { $homedir = "{$_SERVER['DOCUMENT_ROOT']}/home"; };
	$peers=GetChildren($homedir.$current);
	sort($peers);
	foreach($peers as $peer) {
		if ($peer[0]!=".") {//skip hidden directories and backpath
			$data[] = "<A CLASS=\"leftpanelink$aquo\" HREF=\"{$_SERVER['PHP_SELF']}?path=".rtrim($current,"/")."/$peer\">$peer</A>";
			if (stristr($path,rtrim($current,"/")."/".$peer)) {
				ItemAdding($data,$path,rtrim($current,"/")."/".$peer,$homedir,$aquo+1);
			};//endif
		};//endif
	};//foreach
};//end AddMenuItem

function GetChildren($path,$getdirs=true) {//get the items on the imediately lower level, dirs for directories, false for files
	$dirs = array();
	if(is_dir($path)){
		if($dh=opendir($path)){
			while(($file = readdir($dh)) !== false){
				if ($getdirs) {
					if (is_dir($path."/".$file)&&($file[0]!=".")) { $dirs[]=$file; };
				} else {
					if (is_file($path."/".$file)) { $dirs[]=$file; };
				};//endif
			};//end while
		};//end if
	};//end if
	return($dirs);
};//end GetChildren

function WriteText($path="/",$filename="index",$suffix=".htm.txt",$home=false) {
	if (!$home) { $homedir = "{$_SERVER['DOCUMENT_ROOT']}/home"; } else { $homedir = "{$_SERVER['DOCUMENT_ROOT']}/$home"; };
	$text = (file_exists($homedir.rtrim($path,"/")."/".$filename.$suffix)) ? file_get_contents($homedir.rtrim($path,"/")."/".$filename.$suffix) : false ;
	if (count(GetChildren($homedir.$path,false))==0) {
		$peers=GetChildren($homedir.$path);
		foreach($peers as $peer) {
			echo "<DIV> <A CLASS=\"leftpanelink\" HREF=\"{$_SERVER['PHP_SELF']}?path=".rtrim($path,"/")."/$peer\">$peer</A></DIV>\n";
		};//end foreach
	};//end if
	$text = ReplaceRules($text);
	echo $text;
};//end Write Text

function ReplaceRules($text = "",$pageleft=false,$fotodir = "pict/") {
	//replace paragraph and break tags
	$re_search = "/\n\\*/";  $re_replace = "\n[LI]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/\n(.){0,1}\n/";  $re_replace = "\n\n[P]";
	$text = preg_replace($re_search, $re_replace, $text);

	//link tags replacement
	$re_search = "/\\[path\"([^\"]+)\"]/"; $re_replace = "[A HREF=\"index.php?path=\\1\"]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "#\\[/path]#";$re_replace = "[/A]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/\\[link(\"[^\"]+\")]/"; $re_replace = "[A HREF=\\1]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "#\\[/link]#"; $re_replace = "[/A]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/\\[linkpage([0-9]+)]/"; $re_replace = "[A HREF=\"".$_SERVER["PHP_SELF"]."?pageid=\\1\"]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "#\\[/linkpage]#"; $re_replace = "[/A]";
	$text = preg_replace($re_search, $re_replace, $text);

	//image tags replacement
	$re_search = "/\\[image\"([^\"]+)\"([a-zA-Z]*)]/"; $re_replace = "[IMG SRC=\"\\1\" BORDER=\"0\" ALIGN=\"\\2\"]";
	$text = preg_replace($re_search, $re_replace, $text);

	//layout tags replacement
	$re_search = "/\\[r]/"; $re_replace = "[SPAN CLASS=\"right\"]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "#\\[/r]#"; $re_replace = "[/SPAN]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/\\[c]/"; $re_replace = "[SPAN CLASS=\"center\"]";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "#\\[/c]#"; $re_replace = "[/SPAN]";
	$text = preg_replace($re_search, $re_replace, $text);
	
	//final catch all - replace brackets and square brackets back for _(..._)
	$re_search = "/\[/";
	$re_replace="<";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/]/";
	$re_replace=">";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/_\(/";
	$re_replace="[";
	$text = preg_replace($re_search, $re_replace, $text);
	$re_search = "/_\)/";
	$re_replace="]";
	$text = preg_replace($re_search, $re_replace, $text);
//	$text = str_replace(array("[","]"),array("<",">"),$text);
  return($text);
};//end function replace rules

function WriteP($data, $heading = false, $vertical = true, $class = "table") {
	echo "<DIV CLASS=\"$class\">\n";
	$tag = $vertical ? "DIV" : "SPAN";
	if ($heading) {
		echo "<$tag CLASS=\"head\">$heading</$tag>\n";
	};//end if heading
	foreach($data as $item) {
		echo "<$tag CLASS=\"item\">";
		echo $item;
		echo "</$tag>\n";
	};//end foreach data
	echo "</DIV> <!-- table -->\n";
};//end Write Table

function CheckFiles($pageleft = 1, $filedir = "") {
	$strSQL  = "SELECT t1.* FROM files t1, pages t2 WHERE t2.left = '$pageleft' AND t2.pageid = t1.pageid";
	$conn = OpenConnection();
		$result = MoveRS(RunSQL($conn, $strSQL));
	CloseConnection($conn);
	return($result);
};//end CheckFiles

?>