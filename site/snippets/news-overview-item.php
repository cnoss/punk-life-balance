<?php
$type = $item->kind() == 'termin' ? 'termin' : 'news';
$visibleDate = $type === 'termin' ? $item->dateOfGig() : $item->date();
?>

<figure class="has-rotation">
  <a href="<?= $item->url() ?>" class="simple-link">
    <?php snippet('small-image', ['width' => 1200, 'image' => $item->teaserimage()->toFile(), 'alt' => $item->title() ]) ?>
  </a>

  <figcaption>
    <h3 class="title"><a href="<?= $item->url() ?>"><?= $item->title() ?></a></h3>
    <h4 class="date"><?= snippet('date', ['dateString' => $visibleDate ]) ?></h4>
  </figcaption>
</figure>


