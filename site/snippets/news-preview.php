<?php

$gigItems  = collection('gigs');
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
})->sortBy(function ($item) use ($effectiveDateField) {
    return $effectiveDateField($item)->toDate();
}, 'asc', SORT_NUMERIC);

$pastItems = $allItems->filter(function ($item) use ($effectiveDateField, $today) {
    $dateField = $effectiveDateField($item);
    return $dateField->isNotEmpty() && $dateField->toDate() < $today;
})->sortBy(function ($item) use ($effectiveDateField) {
    return $effectiveDateField($item)->toDate();
}, 'desc', SORT_NUMERIC);

$futurePreview = $futureItems->limit(10);
$remaining = 5 - $futurePreview->count();
$pastPreview = $remaining > 0 ? $pastItems->limit($remaining) : $pastItems->limit(0);

?>

<?php if ($futurePreview->count()): ?>
  <h3 class="preview-heading">Kommend</h3>
  <ul class="preview-overview ">
    <?php foreach ($futurePreview as $item): ?>
      <li class="preview-item">
        <a href="<?= $item->url() ?>">
        <?php snippet('news-preview-item', ['item' => $item]) ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
<?php endif ?>

<?php if ($pastPreview->count()): ?>
  <h3 class="preview-heading">Vergangen</h3>
  <ul class="preview-overview ">
    <?php foreach ($pastPreview as $item): ?>
      <li class="preview-item">
        <a href="<?= $item->url() ?>">
        <?php snippet('news-preview-item', ['item' => $item]) ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
<?php endif ?>



