<?php snippet('page-header')?>
<?php snippet('header')?>

<div class="sticky-video-wrap">
  <?php snippet('fullsizevideo'); ?>
</div>


<main id="main-content">


  <!--div class="review-section">
    <?php
        //  snippet('review');
?>
  </div-->

  <div class="mission-statement hero-text is-fullsize-sticky has-full-width">
    <?php echo $page->text()->kt()?>
  </div>

  <section class="preview-section is-sticky has-bg-color-2 has-torn-edge">
    <h2><a class="has-no-link-style" href="<?php echo $pages->find('news')->url()?>"><?php echo $pages->find('news')->headline()->esc()?></a></h2>
    
    <div class=" has-grid">
    <p><?php echo $pages->find('news')->intro()->esc()?></p>
    <?php snippet('news-preview'); ?>
    </div>
  </section>

  <?php
  if ($pages->find('mediathek')): ?>
  <section class="preview-section">
    <div class="preview-section-intro">
      <h2><a class="has-no-link-style" href="<?php echo $pages->find('mediathek')->url()?>"><?php echo I18n::translate('mediathek')?></a></h2>
    </div>
    <?php snippet('mediathek-preview'); ?>
  </section>

  <?php endif; ?>

  <section class="title-group">
    <p class="page-title">
      <a class="logo" href="<?php echo $site->url()?>">
        <?php echo $site->title()->esc()?>
      </a>
    </p>
    //
    <p class="page-tagline">
      <?php echo $site->tagline()->esc()?>
    </p>
  </section>
</main>

<?php snippet('footer')?>
