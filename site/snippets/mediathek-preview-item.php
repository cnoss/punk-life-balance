<?php

$artist = !$item->artist()->isEmpty() ? "<h4 class=\"subtitle\">{$item->artist()}</h4>" : '';
$youtube = !$item->content()->youtube()->isEmpty() ? $item->youtube() : false;
$teaserImageSrc = $item->cover() ? $item->cover() : false;
$teaserImage = $teaserImageSrc ? "<img loading=\"lazy\" src=\"{$teaserImageSrc->resize(500, 500)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';

?>
<a href="<?= $item->url() ?>">
  <?= $teaserImage ?>
</a>

