<nav class="breadcrumb" aria-label="breadcrumb">
<?php

$breadcrumb = $site->breadcrumb();
$shortBreadcrumb = $breadcrumb->remove($breadcrumb->last());

?>

<ul class="breadcrumb-list">
    <?php foreach ($shortBreadcrumb as $crumb): ?>
    <li>

      <a class="simple-link" href="<?= $crumb->url() ?>" <?= e($crumb->isActive(), 'aria-current="page"') ?>>
        <?php if ($crumb->isFirst()): ?><span class="back-button"></span><?php endif ?><?= html($crumb->title()) ?>
      </a>
    </li>
    <?php endforeach ?>
    </ul>
</nav>