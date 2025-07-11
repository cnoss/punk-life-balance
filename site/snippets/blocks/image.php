<?php

/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This image snippet overwrites
  Kirby's default image block to add custom classes
  and data attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/

$alt      = $block->alt();
$caption  = $block->caption();
$contain  = $block->crop()->isFalse();
$link     = $block->link();
$ratio    = $block->ratio()->or('auto');
$class    = $ratio != 'auto' ? 'img' : 'auto';
$src      = null;
$lightbox = $link->isEmpty();

if ($block->location() == 'web') {
    $src      = $block->src();
    $srcValue = $src->escape('attr');
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    $src = $srcValue = $image->resize(1200,1200)->url();
}

if ($ratio !== 'auto') {
  $ratio = Str::split($ratio, '/');
  $w = $ratio[0] ?? 1;
  $h = $ratio[1] ?? 1;
}

?>
<?php if ($srcValue): ?>
<figure>
  <img src="<?= $srcValue ?>" alt="<?= esc($alt, 'attr') ?>">

  <?php if ($caption->isNotEmpty()): ?>
  <figcaption class="img-caption">
    <?= $caption ?>
  </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>
