<?php
$userbarText = array();
$i18n = new MOD_i18n('apps/blog/userbar.php');
$userbarText = $i18n->getText('userbarText');
?>
      <h3>Actions</h3>
      <ul class="linklist">
		<li><a href="blog/create"><?=$userbarText['create_entry']?></a></li>
		<li><a href="blog/cat"><?=$userbarText['manage_cats']?></a></li>
      </ul>