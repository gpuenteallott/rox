<?php
$words = new MOD_words();
?>

           <h3><?php echo $words->getFormatted('Actions'); ?></h3>
           <ul class="linklist">
<?php // TODO: Add new words to database 
?>
            <li><a style="cursor:pointer;" onClick="$('FindPeopleFilter').toggle();"><?php echo $words->getFormatted('FindPeopleFilter'); ?></a></li>
            <li><a style="cursor:pointer;" onClick="$('FindPeopleResults').toggle();"><?php echo $words->getFormatted('FindPeopleResults'); ?></a></li>
	        <li><a href="searchmembers/index"><?php echo $words->getFormatted('SearchNew'); ?></a></li>
	        <li><a href="searchmembers/simple"><?php echo $words->getFormatted('SearchSimple'); ?></a></li>
<?php if ($MapOff != "mapoff") { ?>
	        <li><a href="searchmembers/index/mapoff"><?php echo $words->getFormatted('FindPeopleDisableMap'); ?></a></li>
<?php } else { ?>
	        <li><a href="searchmembers/index"><?php echo $words->getFormatted('FindPeopleEnableMap'); ?></a></li>
<?php } ?>
           </ul>
