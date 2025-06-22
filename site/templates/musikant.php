<?php

$teaserImageSrc = $page->cover() ? $page->cover() : false;
$teaserImage = $teaserImageSrc ? "<img src=\"{$teaserImageSrc->toFile()->resize(800, 800)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';

?>
<?php snippet('page-header') ?>

<?php
$mediathekpages = collection('musiker');
?>

<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">

  <?php snippet('breadcrumb'); ?>
  
  <h1 class="title"><a data-js-back class="back"></a><?= $page->title() ?></h1>
  <h2 class="subtitle"><?= $page->role()->kt() ?></h2>

  <article class="has-grid">
    <?= $page->copytext()->kt() ?>
    <figure class="media is-small"><?= $teaserImage ?></figure>
  </article>

</main>

<?php snippet('footer') ?>
