<?php snippet('page-header') ?>
<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <?php snippet('breadcrumb'); ?>
  <article>
    <h1 class="h1"><?= $page->title()->esc() ?></h1>
    <div class="text">
      <?= $page->text()->kt() ?>
    </div>
  </article>
</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
