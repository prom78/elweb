<?php
//pop-up window
function ChatPopup($height=300,$width=210,$incdir="inc/") {
  echo "<a href=\"{$incdir}chat.inc.php?mode=chat&height={$height}&width={$width}\" target=\"_new\">on-line chat</a>";
};//ChatPopup

//the flash application for on-line communication
function DigsbyChat($height=300,$width=210) {
  echo "
  <!-- on-line chat -->
  <embed src=\"http://w.digsby.com/dw.swf?c=q65bjanpsr98vwq6\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"$width\" height=\"$height\">
  </embed>
  ";//echo
};//DigsbyChat

if ($_GET["mode"]=="chat") {
?>

<!doctype html>
<head>
<title> Bydlení Hládkov - Zeptejte se nás on-line</title>
</head>
<body>
<?php
DigsbyChat(intval($_GET["height"]),intval($_GET["width"])); 
?>
</body>
</html>

<?php
};//end if mode chats