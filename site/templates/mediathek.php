<?php snippet('page-header') ?>

<?php
$mediathekItems = collection('musiker');
?>

<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <h1 class="title"><?= $page->title() ?></h1>
  <section class="hero-text">
    <?= $page->copytext()->kt() ?>
  </section>

  <ul class="grid mediathek">
    <?php foreach ($mediathekItems as $item): ?>
    <li class="mediathek-item">
        <?php snippet('mediathek-overview-item', ['item' => $item]) ?>
    </li>
    <?php endforeach ?>
  </ul>
</main>

<?php snippet('footer') ?>
