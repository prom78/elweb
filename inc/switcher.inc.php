<?php $width = isset($_COOKIE["imagewidth"])?($_COOKIE["imagewidth"]):$defaulthimagewidth;$width = "640";?>
<DIV CLASS="switcher">
<FORM NAME="switcherform" ACTION="/?" METHOD="get">
	<SELECT NAME="switcher">
		<OPTION <?php if($width=="640") { echo "SELECTED"; } ?>>640x480</OPTION>
		<OPTION <?php if($width=="800") { echo "SELECTED"; } ?>>800x600</OPTION>
		<OPTION <?php if($width=="1024") { echo "SELECTED"; } ?>>1024x800</OPTION>
	</SELECT>
	<INPUT TYPE="submit" VALUE="Velikost">
	<INPUT TYPE="hidden" NAME="action" VALUE="switcher">
	<INPUT TYPE="hidden" NAME="image" VALUE="<?php echo $_GET["image"] ?>">
</FORM>
</DIV>

<?php

?>