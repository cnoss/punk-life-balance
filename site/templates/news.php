<?php snippet('page-header')?>
<?php snippet('header')?>

<?php
$gigItems = collection('gigs');
$newsItems = collection('news');

$allItems = $gigItems->merge($newsItems);
?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  
  <h1 class="title"><a data-js-back class="back"></a><?php echo $page->title() ?></h1>

  <ul class="grid news-overview">
    <?php foreach ($allItems as $item): ?>
    <li class="news-overview-item">
      <?php snippet('news-overview-item', ['item' => $item, '']) ?>
    </li>
    <?php endforeach ?>
  </ul>
  
</main>

<?php snippet('title-group'); ?>
<?php snippet('footer') ?>
