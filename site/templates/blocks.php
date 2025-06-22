<?php snippet('page-header')?>

<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>

<?php
$date = $page->date()->toDate(); // Unix-Timestamp
$formatter = new IntlDateFormatter('de_DE', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$formatter->setPattern('dd. MMMM yyyy');
?>

<main id="main-content" class="has-torn-edge black-edge">
  <?php snippet('breadcrumb'); ?>
  
  <h1 class="title"><a data-js-back class="back"></a><?php echo $page->title() ?></h1>
  <p class="date subtitle"><?= $formatter->format($date); ?></p>
  <?php foreach ($page->layout()->toLayouts() as $layout): ?>
  <section class="layout-grid<?php echo $layout->attrs()->class() ?>" id="<?php echo $layout->id() ?>" data-grid="6">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="column" data-column-span="<?php echo $column->span(6) ?>">
      <div class="blocks">
        <?php foreach ($column->blocks() as $block): ?>
        <div class="block block-type-<?php echo $block->type()?>">
          <?php echo $block?>
        </div>
        <?php endforeach?>
      </div>
    </div>
    <?php endforeach?>
  </section>
  <?php endforeach?>
</main>

<?php snippet('title-group'); ?>
<?php snippet('footer')?>
