<?php snippet('page-header')?>
<?php snippet('header')?>

<?php
$gigItems = collection('gigs');
$newsItems = collection('news');

$allItems = $gigItems->merge($newsItems);

$effectiveDateField = function ($item) {
    if ($item->kind() == 'termin') {
        $multiDates = $item->fieldsForMultipeDates()->toStructure();

        if ($multiDates->count() > 1) {
            for ($i = $multiDates->count() - 1; $i >= 0; $i--) {
                $dateField = $multiDates->nth($i);
                if ($dateField && $dateField->dateOfGig()->isNotEmpty()) {
                    return $dateField->dateOfGig();
                }
            }
        }

        if ($item->dateOfGig()->isNotEmpty()) {
            return $item->dateOfGig();
        }
    }

    return $item->date();
};

$today = strtotime('today');

$futureItems = $allItems->filter(function ($item) use ($effectiveDateField, $today) {
    $dateField = $effectiveDateField($item);
    return $dateField->isNotEmpty() && $dateField->toDate() >= $today;
});

$pastItems = $allItems->filter(function ($item) use ($effectiveDateField, $today) {
    $dateField = $effectiveDateField($item);
    return $dateField->isNotEmpty() && $dateField->toDate() < $today;
});

$futureItems = $futureItems->sortBy(function ($item) use ($effectiveDateField) {
    return $effectiveDateField($item)->toDate();
}, 'asc', SORT_NUMERIC);

$pastItems = $pastItems->sortBy(function ($item) use ($effectiveDateField) {
    return $effectiveDateField($item)->toDate();
}, 'desc', SORT_NUMERIC);
?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <?php snippet('breadcrumb'); ?>
  <h1 class="title"><?php echo $page->title() ?></h1>

  <?php if ($futureItems->count()): ?>
    <h2 class="title">Kommende Termine</h2>
    <ul class="grid news-overview">
      <?php foreach ($futureItems as $item): ?>
      <li class="news-overview-item">
        <?php snippet('news-overview-item', ['item' => $item, '']) ?>
      </li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>

  <?php if ($pastItems->count()): ?>
    <h2 class="title">Vergangene News &amp; Termine</h2>
    <ul class="grid news-overview">
      <?php foreach ($pastItems as $item): ?>
      <li class="news-overview-item">
        <?php snippet('news-overview-item', ['item' => $item, '']) ?>
      </li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>
  
</main>

<?php snippet('title-group'); ?>
<?php snippet('footer') ?>
