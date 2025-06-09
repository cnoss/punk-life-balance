<?php

$subTitle = !$item->subTitle()->isEmpty() ? "<h4 class=\"subtitle\">{$item->subTitle()}</h4>" : '';
$type = $item->kind() == 'termin' ? 'termin' : 'news';
$visibleDate = $type === 'termin' ? $item->dateOfGig() : $item->date();
$multiDates = $item->fieldsForMultipeDates()->toStructure()->count() > 1 ? $item->fieldsForMultipeDates()->toStructure() : false;

if ($multiDates) {
    $firstDate = $item->dateOfGig();

    /* Iterate from the last date to find the last date with a value */
    $lastDate = null;

    // Iterate through the structure from back to front
    for ($i = $item->fieldsForMultipeDates()->toStructure()->count() - 1; $i >= 0; $i--) {
        $dateField = $item->fieldsForMultipeDates()->toStructure()->nth($i);
        if ($dateField->dateOfGig()->isNotEmpty()) {
            $lastDate = $dateField->dateOfGig();
            break; // Exit the loop once we find the latest filled date
        }
    }


    $firstDateYear = date('Y', strtotime($firstDate));
    $lastDateYear = date('Y', strtotime($lastDate));

    $firstDateMonth = date('m', strtotime($firstDate));
    $lastDateMonth = date('m', strtotime($lastDate));

    $firstDateDay = date('d', strtotime($firstDate));
    $lastDateDay = date('d', strtotime($lastDate));

    $dateRange = $firstDateYear === $lastDateYear
      ? $firstDateMonth === $lastDateMonth
        ? $firstDateDay === $lastDateDay
          ? date('d.m.Y', strtotime($firstDate))
          : date('d.', strtotime($firstDate)) . ' - ' . date('d.m.Y', strtotime($lastDate))
        : date('d.m.', strtotime($firstDate)) . ' - ' . date('d.m.Y', strtotime($lastDate))
      : date('d.m.Y', strtotime($firstDate)) . ' - ' . date('d.m.Y', strtotime($lastDate));
}

?>

<p>
  <em><?= $item->title() ?></em>, <?= snippet('date', ['dateString' => $visibleDate ]) ?>
</p>
