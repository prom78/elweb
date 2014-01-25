<?php

//*********** EDIT FILES *****************
function EditFiles($pageleft = 1, $filedir = "", $download = "download.php") {
	$strSQL  = "SELECT t1.* FROM files t1, pages t2 WHERE t2.left = '$pageleft' AND t2.pageid = t1.pageid";
	$conn = OpenConnection();
		$filesrs = RunSQL($conn, $strSQL);
	CloseConnection($conn);
	while ($row = MoveRS($filesrs)) {
		echo "<TR><TD>";
		echo "<A HREF=\"$download?filename=".$row["filename"]."&filedir=$filedir\">";
		echo $row["filename"]."</A>";
		echo "</TD><TD>";
		echo "(".number_format(filesize($filedir.$row["filename"])/1024,0,","," ")." KB)</TD>";
		echo "</TD><TD>";
		echo "<A HREF=\"".$_SERVER["PHP_SELF"]."?action=delfile&filename=".$row["filename"]."&pageleft=$pageleft\">&laquo;Smazat&raquo;</A>";
		echo "</TD></TR>\n";
	};//end while
};//end write files

function FilesForm($pageleft=1) {
	echo "<DIV CLASS=\"files_form\">";
	echo "<FORM NAME=\"fileform\" ENCTYPE=\"multipart/form-data\" ACTION=\"".$_SERVER["PHP_SELF"]."?action=savefile&pageleft=$pageleft\" METHOD=\"post\">\n";
	echo "<INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\">";
	echo "<INPUT TYPE=\"file\" SIZE=\"63\" NAME=\"Soubor\"> ";
	echo "<INPUT TYPE=\"submit\" VALUE=\"Uložit soubor\">";
	echo "</FORM>\n";
	echo "</DIV>";
};//function FilesForm

//*********** SAVE FILE *****************
function SaveFile($fileinput, $pageleft = 1, $filedir = "") {
	//prepare filename and path
	$filename = str_replace(array(" ","'"), "_", $fileinput['name']);//get rid of spaces, linux does not like, get name and extension
	$badextensions = array(".php", ".phtml", ".cgi", ".php3",".asp",".aspx",".htaccess",".sh");	//change forbidden extension
	str_replace($badextensions, ".txt", $filename);
	//check if file not exist
	$fext = array_pop(explode('.', $filename));
	$i = "";
	while (file_exists($filedir.basename($filename,".".$fext).$i.".".$fext)) { $i++; };
	$filename = basename($filename,".".$fext).$i.".".$fext;
	//check the file upload error state
	echo $fileinput['error'];
	switch ($fileinput['error']) {
		case UPLOAD_ERR_INI_SIZE : 	$result = "Soubor je příliš veliký - limit v PHP.INI."; return($result); break;
		case UPLOAD_ERR_FORM_SIZE :	$result = "Soubor je příliš veliký - limit prohlížeče."; return($result);  break;
		case UPLOAD_ERR_PARTIAL :	$result = "Soubor uložen je částečně."; return($result); break;
		case UPLOAD_ERR_NO_FILE :	$result = "Soubor nebyl nalezen nebo nemohl být uložen."; return($result); break;
	}; //switch
	//save and register file
	if (move_uploaded_file($fileinput['tmp_name'], $filedir.$filename)) { //saving  file
		if (!chmod($filedir.$filename, 0655)) { $result .= " Přístupová práva k souboru nebyla nastavena."; };		//chmod saved file, so can be accessed via ftp
		// register the file, is successfully uploaded
		$strSQL = "INSERT INTO files (filename, pageid) SELECT '$filename',t1.pageid FROM pages t1 WHERE t1.left = '$pageleft';";
		$conn = OpenConnection();
			RunSQL($conn, $strSQL);
		CloseConnection($conn);
    	$result .= " Soubor $filename byl přijat a uložen.";
	} else {
	   	$result .= " Soubor $filename nebyl nahrán.";
	};//end if
	return($result);
}; // end function Save_File($fileinput, $pageid);

//*********** DELETE FILE *****************
function DelFile($filename, $filedir = "") {
	$strSQL = "DELETE FROM files WHERE filename = '$filename';";
	//file registration
	$conn = OpenConnection();
		$result = (RunSQL($conn, $strSQL))? "Soubor odregistrován " : "Soubor neodregistrován ";
	CloseConnection($conn);
	//file deletion
	$result .= (@unlink($filedir.$filename)) ? "a smazán. " : "a nebyl smazán. ";
	return($result);
}; // end function Delete_File($filename);

//*********** DELETE FILES ON PAGE *****************
function DelFilesOnPage($pageleft = false, $filedir = "") {
	if ($pageleft) {
		$strSQL = "SELECT t1.* FROM files t1, pages t2 WHERE t2.left = '$pageleft' AND t1.pageid = t2.pageid";
		$conn = OpenConnection();
			$filesrs = RunSQL($conn, $strSQL);
		CloseConnection($conn);
		while ($row = MoveRS($filesrs)) {
			DelFile($row["filename"], $filedir);
		};//end while
		$result = "Soubory na stránce smazány.";
	} else {
		$result = "Neznámá stránka pro soubory.";
	};//end if
	return($result);
};//end Del Files on Page

?>