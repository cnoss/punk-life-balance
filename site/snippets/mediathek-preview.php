<?php
$mediathekItems = collection('mediathek');
?>

<ul class="grid mediathek-preview">
  <?php foreach ($mediathekItems as $item): ?>
  <li class="mediathek-preview-item">
      <?php snippet('mediathek-preview-item', ['item' => $item]) ?>
  </li>
  <?php endforeach ?>
</ul>