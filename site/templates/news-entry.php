<?php snippet('page-header', ['bodyCssClass'=>"news-page"]) ?>

<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <?php snippet('breadcrumb'); ?>
  <article>
    <h1><?= $page->title() ?></h1>
    <?= snippet("news-overview-item", ['item' => $page, 'options' => "no-headline"]) ?>
  </article>
</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
