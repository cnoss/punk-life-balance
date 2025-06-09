<?php

$home = page('home');

$videoUrl = !$page->Backgroundvideourl()->isEmpty() ? $page->Backgroundvideourl() : $home->Backgroundvideourl();
$videoStartTime = !$page->Startofbackgroundvideo()->isEmpty() ? $page->Startofbackgroundvideo()->toInt() : 0;
$videoDuration = !$page->Durationofbackgroundvideo()->isEmpty() ? $page->Durationofbackgroundvideo()->toInt() : 5;
$posterImageSrc = !$home->files()->isEmpty() ? $home->files()->first() : false;

if (!$videoUrl) {
    return;
}

$videoOptions = [];
$videoFilters = [
  'grayscale' => 'grayscale(100%)',
  'lighten' => 'brightness(1.3)',
  'darken' => 'opacity(.8)'
];

foreach ($page->videoOptions()->split() as $option) {
    array_push($videoOptions, $videoFilters[$option]);
}

$videoFilter = count($videoOptions) > 0
  ? 'filter: ' . implode(' ', $videoOptions)
  : '';

$endTime = intval($videoStartTime) + intval($videoDuration);

$completeVideoUrl = $videoUrl . '#t=100,200'
?>

<video id="fs-video" class="fs-video" style="<?= $videoFilter ?>" playsinline muted loop autoplay poster="<?= $posterImageSrc->resize(1600, 1200)->url() ?>">
  <source src="<?= $videoUrl ?>" type="video/mp4">
</video>

<script>
  const video = document.getElementById('fs-video');
  // video.currentTime = <?= $videoStartTime ?>;
  // video.play();
  // video.onended = function() {
  //   video.currentTime = <?= $videoStartTime ?>;
  //   video.play();
  // };
</script>