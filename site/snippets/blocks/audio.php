<?php
/** @var \Kirby\Cms\Block $block */
?>
<?php if ($file = $block->source()->toFile()): ?>
<div class="audio">
  <?php if ($poster = $block->poster()->toFile()): ?>
  <figure class="audio-poster">
    <img
      src="<?= $poster->resize(400)->url() ?>"
      alt="<?= esc($poster->alt()->or($block->title()), 'attr') ?>"
      loading="lazy"
    >
  </figure>
  <?php endif ?>

  <div class="audio-body">
    <?php if ($block->title()->isNotEmpty()): ?>
    <div class="audio-title"><?= $block->title()->esc() ?></div>
    <?php endif ?>

    <?php if ($block->caption()->isNotEmpty()): ?>
    <div class="audio-caption">
      <?= $block->caption()->kt() ?>
    </div>
    <?php endif ?>

    <audio
      class="audio-player"
      <?= $block->controls()->isTrue() ? 'controls' : '' ?>
      <?= $block->autoplay()->isTrue() ? 'autoplay' : '' ?>
      preload="none"
    >
      <source src="<?= $file->url() ?>" type="<?= $file->mime() ?>">
      Your browser does not support the <code>audio</code> element.
    </audio>
  </div>
</div>
<?php endif ?>
