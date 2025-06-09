<?php
  
  $dateOfGig = $dateOfGig->isNotEmpty() 
    ? date('d.m.Y', strtotime($dateOfGig))
    : '';

  $startingTime = $begin->isNotEmpty() 
        ? date('H:i', strtotime($begin))
        : '';

  $venueHtml = $venue->isNotEmpty()
    ? "<li class=\"venue\"><i class=\"icon icon-inline\">location_on</i>{$venue}</li>"
    : '';
  $beginHtml = $begin->isNotEmpty()
    ? "<li class=\"begin\"><i class=\"icon icon-inline\">schedule</i>{$startingTime} Uhr</li>"
    : '';
  $price = $price->isNotEmpty()
    ? "<li class=\"price\"><i class=\"icon icon-inline\">payments</i>{$price}</li>"
    : '';


?>

<ul class="gig-info">
  <li class="date"><i class="icon icon-inline">event</i><?= $dateOfGig ?></li>
  <?= $beginHtml ?>
  <?= $venueHtml ?>
  <?= $price ?>
</ul>