<?php
$reviews = $pages->find('rezensionen')->items();
if ($reviews->count() === 0) {
    return;
}
$reviewItems = $reviews->shuffle()->first();
?>

<div class="review-wrap">
  <blockquote>
    <p><?= $reviewItems->copy() ?></p>
    <footer><?= $reviewItems->author() ?></footer>
  </blockquote>
</div>