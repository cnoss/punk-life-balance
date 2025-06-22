<?php snippet('page-header') ?>

<?php
$musikerItems = collection('musiker');
?>

<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content" class="has-torn-edge line-edge">

  <?php snippet('breadcrumb'); ?>

  <h1 class="title"><a data-js-back class="back"></a><?= $page->title() ?></h1>
  <section class="intro-text">
    <?= $page->copytext()->kt() ?>
  </section>

  <ul class="has-grid musikanten-overview" data-cols="2">
    <?php foreach ($musikerItems as $item): ?>
    <li class="grid-item">
      <?php snippet('musikanten-overview-item', ['item' => $item]) ?>
    </li>
    <?php endforeach ?>
  </ul>
</main>

<?php snippet('footer') ?>
