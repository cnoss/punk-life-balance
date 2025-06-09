<?php snippet('page-header') ?>
<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This default template must not be removed. It is used whenever Kirby
  cannot find a template with the name of the content file.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<div class="header-wrap">
  <?php snippet('header') ?>
  <?php snippet('fullsizevideo'); ?>
</div>

<main id="main-content">
  <?php snippet('breadcrumb'); ?>
  <article>
    <h1 class="h1"><?= $page->title()->esc() ?></h1>
    <?php foreach ($page->docuContent()->toBlocks() as $block): ?>
    <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
      <?= $block ?>
    </div>
    <?php endforeach ?>
  </article>
</main>

<?php snippet("back"); ?>
<?php snippet('footer') ?>
