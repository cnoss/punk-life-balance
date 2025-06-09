<?php snippet('page-header') ?>

<?php
$gigItems = collection('gigs');
$newsItems = collection('news');
?>

<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <h1 class="title"><?= $page->title() ?></h1>

  <section>
    <h2>Upcoming Gigs</h2>
    <ul class="grid news">
      <?php foreach ($gigItems as $item): ?>
      <li class="news-item">
        <?php snippet('news-overview-item', ['item' => $item, '']) ?>
      </li>
      <?php endforeach ?>
    </ul>
  </section>

  <section>
    <h2>News</h2>
    <ul class="grid news">
      <?php foreach ($newsItems as $item): ?>
      <li class="news-item">
        <?php snippet('news-overview-item', ['item' => $item]) ?>
      </li>
      <?php endforeach ?>
    </ul>
  </section>

</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
