<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>


<main id="main-content">

  <div id="about" class="mission-statement hero-text is-large has-full-width">
    <?php echo $page->text()->kt() ?>
  </div>

  <section id="was-geht-ab" class="preview-section">
    <h2><a class="has-no-link-style" href="<?php echo $pages->find('news')->url() ?>"><?php echo $pages->find('news')->headline()->esc() ?></a></h2>
    <?php snippet('news-preview'); ?>
  </section>

  <?php
  if ($pages->find('mediathek')): ?>
  <section class="preview-section">
    <div class="preview-section-intro">
      <h2><a class="has-no-link-style" href="<?php echo $pages->find('mediathek')->url() ?>"><?php echo I18n::translate('mediathek') ?></a></h2>
    </div>
    <?php snippet('mediathek-preview'); ?>
  </section>

  <?php endif; ?>

  <!--div class="is-large is-dark textbox is-sticky">
    <p class="textbox-content">
      <span class="text-wrapper">
        <span class="letters">Versuch in einem Satz zu formulieren, was Du verändern willst!</span>
      </span>
    </p>
  </div-->
  
  <div id="wer">
  <?php foreach ($page->wer()->toLayouts() as $layout): ?>
  <section class="layout-grid<?php echo $layout->attrs()->class() ?>" id="<?php echo $layout->id() ?>" data-grid="6">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="column" data-column-span="<?php echo $column->span(6) ?>">
      <div class="blocks">
        <?php foreach ($column->blocks() as $block): ?>
        <div class="block block-type-<?php echo $block->type() ?>">
          <?php echo $block ?>
        </div>
        <?php endforeach?>
      </div>
    </div>
    <?php endforeach?>
  </section>
  <?php endforeach?>
  </div>

  <div id="was" class="blocks-section">
  <?php foreach ($page->was()->toLayouts() as $layout): ?>
  <section class="layout-grid<?php echo $layout->attrs()->class() ?>" id="<?php echo $layout->id() ?>" data-grid="6">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="column" data-column-span="<?php echo $column->span(6) ?>">
      <div class="blocks">
        <?php foreach ($column->blocks() as $block): ?>
        <div class="block block-type-<?php echo $block->type() ?>">
          <?php echo $block ?>
        </div>
        <?php endforeach?>
      </div>
    </div>
    <?php endforeach?>
  </section>
  <?php endforeach?>
  </div>  

  <?php snippet('title-group'); ?>
</main>

<?php snippet('footer')?>
