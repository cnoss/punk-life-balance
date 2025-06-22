<?php

$artist = !$item->artist()->isEmpty() ? "<h4 class=\"subtitle\">{$item->artist()}</h4>" : '';
$youtube = !$item->content()->youtube()->isEmpty() ? $item->youtube() : false;
$teaserImageSrc = $item->cover() ? $item->cover() : false;
$teaserImage = $teaserImageSrc ? "<img src=\"{$teaserImageSrc->resize(800, 800)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';
?>


<a href="<?= $item->url() ?>" class="simple-link">
  <div class="media"><?= $teaserImage ?></div>
  <div>
    <h3 class="title"><?= $item->title() ?></h3>  
    <?= $artist ?>
    <?= $item->text()->kt() ?>
    <p class="more-button has-padding simple-link"><?= I18n::translate('mehr-zu') ?> <?= $item->title() ?>&nbsp;<?= snippet('arrow-right') ?></p>
  </div>
</a>

