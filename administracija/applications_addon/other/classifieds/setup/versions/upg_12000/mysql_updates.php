<?php

$SQL[] = "ALTER TABLE classifieds_packages ADD member_groups text;";
$SQL[] = "ALTER TABLE classifieds_packages ADD pricing_format enum('flat','value') NOT NULL DEFAULT 'flat';";
$SQL[] = "ALTER TABLE classifieds_packages ADD rates text;";

$SQL[] = "UPDATE classifieds_packages SET member_groups ='*';";

$SQL[] = "ALTER TABLE classifieds_items ADD featured tinyint(1) NOT NULL default '0';";

?>
