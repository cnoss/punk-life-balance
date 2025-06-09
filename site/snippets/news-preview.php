<?php

$gigItems = collection('news')->limit(5);

?>
<ul class="preview-overview ">
  <?php foreach ($gigItems as $item): ?>  
    <li class="preview-item">
      <a href="<?= $item->url() ?>">
      <?php snippet('news-preview-item', ['item' => $item]) ?>
      </a>
    </li>
  <?php endforeach ?>

</ul>



