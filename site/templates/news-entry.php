<?php snippet('page-header')?>
<?php snippet('header')?>

<?php
$gigItems = collection('gigs');
$newsItems = collection('news');
?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>


<main id="main-content">
  <?php snippet('breadcrumb'); ?>
  <article>
    <h1 class="title"><?= $page->title() ?></h1>
    <p class="date"><?= $page->date('d.m.Y') ?></p>
    <?= snippet("news-overview-item", ['item' => $page, 'options' => "no-headline"]) ?>
  </article>
</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
