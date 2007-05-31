<?php
require_once ("menus.php");
require_once ("profilepage_header.php");

function DisplayMyVisitors($TData, $m) {
	global $title, $_SYSHCVOL;
	$title = ww('MyVisitors');
	require_once "header.php";

	Menu1(); // Displays the top menu
	Menu2("mypreferences.php", ww('MainPage')); // Displays the second menu

	// Header of the profile page
	DisplayProfilePageHeader( $m );

  menumember("myvisitors.php?cid=" . $m->id, $m);

	ShowActions($MenuAction); // Show the Actions
	ShowAds(); // Show the Ads
	
	// col3 (middle column)
	echo "      <div id=\"col3\"> \n"; 
	echo "	    <div id=\"col3_content\" class=\"clearfix\"> \n"; 
	echo "  			<div class=\"info\">";

	$iiMax = count($TData);
	echo "<table>";
	if ($iiMax == 0) {
		echo "<tr><td align=center>", ww("NobodyHasYetVisitatedThisProfile"), "</td>";
	}
	for ($ii = 0; $ii < $iiMax; $ii++) {
		$rr = $TData[$ii];
		echo "<tr align=left>";
		echo "<td valign=center align=center>";
		if (($rr->photo != "") and ($rr->photo != "NULL")) {
			echo "<div id=\"topcontent-profile-photo\">\n";
			echo LinkWithPicture($rr->Username,$rr->photo),"\n<br>";
			echo "</div>";
		}
		echo "</td>";
		echo "<td valign=center>", LinkWithUsername($rr->Username), "</td>";
		echo " <td valign=center>", $rr->countryname, "</td> ";
		echo "<td valign=center>";
		if ($rr->ProfileSummary > 0)
			echo FindTrad($rr->ProfileSummary);

		echo "</td>";
		echo "<td>";
		echo $rr->datevisite;
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";

	require_once "footer.php";

}
?>
