<?php

/*

Copyright (c) 2007 BeVolunteer

This file is part of BW Rox.

BW Rox is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

Foobar is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/> or 
write to the Free Software Foundation, Inc., 59 Temple Place - Suite 330, 
Boston, MA  02111-1307, USA.

*/


require_once ("menus.php");
function DisplayMessages($TMess, $lastaction = "") {
	global $countmatch;
	global $title;
	$title = "Admin mail checking";
	require_once "header.php";

	Menu1(); // Displays the top menu

	Menu2($_SERVER["PHP_SELF"]);

	DisplayHeaderShortUserContent($title);

   echo "          <div class=\"info highlight\">\n";
	
	if ($lastaction != "") {
		echo "$lastaction<br>";
	}

	$max = count($TMess);
	$count = 0;

	echo "<center>\n";
	echo "<table width=100% style=\"font-size:11;\">\n";
	if ($max == 0) {
		echo "<tr><td align=center>No pending messages to check</td>";
	} else {
		echo "\n<tr><th>Sender<br>Receiver</th><th>Message</th><th>Action</th><th>SpamInfo</th>";
	}

	echo "<form method=post>\n";
	echo "<input type=hidden name=action value=check>";
	for ($ii = 0; $ii < $max; $ii++) {
		$rr = $TMess[$ii];
		$count++;
		echo "<tr>";
		echo "<td>";
		echo LinkWithUsername($rr->Username_sender);
		echo "<br";
		echo LinkWithUsername($rr->Username_receiver);
		echo "</td>";
		echo "<td>";
		echo "(",fsince($rr->created)," ",localdate($rr->created),")<br>";
		echo "<font color=gray>",$rr->CheckerComment,"</font><br>\n";
		echo "<textarea cols=40 rows=7 readonly>";
		echo $rr->Message;
		echo "</textarea>";
		echo "</td>";
		echo "<td align=left>";
		echo "<input type=hidden name=IdMess_" . $ii . " value=" . $rr->id . ">";
		echo "<input type=checkbox name=Approve_" . $ii ;
		echo " > Approve <br>";
		echo "<input type=checkbox name=Freeze_" . $ii . " > Freeze <br>";
		$checked = "";
		$SpamInfo = "";

		if ($rr->SpamInfo != "NotSpam") { // use to pretick Spam
			$checked = "checked";
		}
		echo "<input type=checkbox name=Mark_Spam_" . $ii . " $checked> Mark Spam";
		echo "</td>";
		echo "<td>";
		echo $rr->SpamInfo;
		echo "</td>";
	}
	echo "<tr><td colspan=5 align=center><input type=submit id=submit name=submit value=submit></td>";
	echo "</form>";
	echo "\n</table><br>\n";
	
	echo "<a href=\"",$_SERVER["PHP_SELF"],"?action=view\">view 20 last mess</a>" ;

	echo "</center>";
	echo "</div>" ;

	require_once "footer.php";

} // DisplayAdminRights($username,$rightname,$TRights,$TRightsVol,$rright,$lastaction,$scope) {