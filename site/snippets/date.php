<?php

$publishedDay = $dateString->toDate('j');
$publishedMonth = $dateString->toDate('n');
$publishedYear = $dateString->toDate('Y');

$monate = array(1 => "Januar", 2 => "Februar", 3 => "M&auml;rz", 4 => "April", 5 => "Mai", 6 => "Juni", 7 => "Juli", 8 => "August", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Dezember");


?>
<?= $publishedDay ?>. <?= $monate[$publishedMonth] ?> <?= $publishedYear ?>