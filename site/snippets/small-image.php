<?php
$quality = 95;
$height = ceil($width / 1.77777778);
$reveal = $width > 1200 ? '' : 'reveal';
$cssClass = isset($cssClass) ? "class='{$cssClass} {$reveal}'" : "class='{$reveal}'";

$smallImage = $image->thumb([
  'width' => $width, 
  'height' => $height, 
  'quality' => $quality,
  'format'  => 'webp',
  'sharpen' => true
]);
?>

<img src="<?= $smallImage->url() ?>" <?= $cssClass ?> alt="<?= $alt ?>" loading="lazy">