<?php
/** @var \Kirby\Cms\Block $block */
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');
?>
<figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>
  <ul class="image-gallery-grid">
    <?php foreach ($block->images()->toFiles() as $image): ?>
    <li class="gallery-grid-item masonry-animation">
      <?= $image ?>
    </li>
    <?php endforeach ?>
  </ul>
  <?php if ($caption->isNotEmpty()): ?>
  <figcaption>
    <?= $caption ?>
  </figcaption>
  <?php endif ?>
</figure>
