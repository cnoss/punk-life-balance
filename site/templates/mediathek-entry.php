<?php snippet('page-header') ?>
<?php
$artist = !$page->artist()->isEmpty() ? "<h2 class=\"subtitle\">{$page->artist()}</h2>" : '';
$youtube = !$page->content()->youtube()->isEmpty() ? $page->youtube() : '';
$teaserImageSrc = $page->cover() ? $page->cover() : false;
$teaserImage = $teaserImageSrc ? "<img src=\"{$teaserImageSrc->resize(800, 800)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';

$images = [];
foreach ($page->images() as $image) {
  array_push($images, "<img src=\"{$image->resize(800, 800)->url()}\" alt=\"{$image->alt()}\">");
}

$media = $youtube ? $youtube : false;
$mediaContainer = $media ? "<div class=\"media\">{$media}</div>" : '';
$audioContainer = $page->audio()->isEmpty() ? '' : $page->audioContainer();

$cover = count($images) > 1 
  ? "<div class=\"media is-grid\">".implode('', $images)."</div>"
  : "<div class=\"media\">{$teaserImage}</div>";


?>

<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <?php snippet('breadcrumb'); ?>

  <header>
    <h1 class="title"><?= $page->title() ?></h1>
    <?= $artist ?>
  </header>

  <?= $cover ?>

  <div class="copytext">
    <?= $page->copytext()->kt() ?>
  </div>
  <?= $mediaContainer ?>
  <?= $audioContainer ?>

</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
