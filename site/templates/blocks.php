<?php snippet('page-header') ?>

<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>


<main id="main-content" class="has-torn-edge black-edge">
  <h1 class="title"><a data-js-back class="back"></a><?= $page->title() ?></h1>

  <?php foreach ($page->Blocks()->toBlocks() as $block): ?>
    <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">

    <?php snippet('blocks/' . $block->type(), [
      'block' => $block,
    ]) ?>
    </div>
  <?php endforeach ?>
</main>
<?php snippet('footer') ?>
