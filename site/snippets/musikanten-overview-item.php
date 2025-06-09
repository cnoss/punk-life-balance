<?php

$teaserImageSrc = $item->cover() ? $item->cover() : false;
$teaserImage = $teaserImageSrc ? "<img src=\"{$teaserImageSrc->toFile()->resize(800, 800)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';

?>

<article>

    <div class="media">
      <a href="<?= $item->url() ?>" class="simple-link">
        <?= $teaserImage ?>
      </a>
    </div>
    <div class="funky-link">
      <a href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a>
    </div>
  </a>
</article>
