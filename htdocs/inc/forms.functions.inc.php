<?php
include_once($incdir."forms.countries.inc.php");

function SaveForm($table="forms", $method="POST") {
	if ((($method == "GET") ? $_GET["robot"] : $_POST["robot"]) == "nospam") {
		$heading = str_pad("Date and time",20);
		$values  = str_pad(date("d.m.Y H:i:s"),20);
		foreach ((($method == "GET") ? $_GET : $_POST) as $key => $value) {
			if ($key != "robot") {
				$strlen = max(strlen($key),strlen($value),20)+1;
				$heading .= "|".str_pad($key,$strlen);
				$values .= "|".str_pad($value,$strlen);
			};//endif robot
		};//end foreach $_POST[]
		$strSQLi = "INSERT INTO $table (content) VALUES ('$heading'),('$values');";
		$conn = OpenConnection();
			if (RunSQL($conn,$strSQLi)) { $result  = "Formulář uložen!"; } else { $result = false; };
		CloseConnection($conn);
	} else {
		$result = "nospam";
	};//endif robot
	return($result);
};//end SaveForm

function BackupForms() {
	$data = array();
	$strSQL = "SELECT formid, content FROM forms";
	$conn = OpenConnection();
		$rs = RunSQL($conn, $strSQL);
	CloseConnection($conn);
	while ($row = MoveRS($rs)) {
		echo $row["content"]."\n";
	};//end for
};//end function FormsMenu
?>