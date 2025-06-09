<?php
$title = "{$site->pagetitle()->esc()} | {$page->title()->esc()}";
$desc = $page->desc()->or($site->desc());
$url = $page->url();
$socialImage = !$site->socialimage()->isEmpty() ? $site->socialimage()->toFile()->url() : '';
$bodyCssClass = isset($bodyCssClass) ? $bodyCssClass : $page->id();
?>
<!DOCTYPE html>
<html lang="de">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $title ?></title>

  <?= css([
    'assets/_compiled/styles/combined-styles.css',
    '@auto'
  ]) ?>

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('assets/icons/favicons/favicon.ico') ?>">

  
  <meta property="og:title" content="<?= $title ?>">
  <meta name="twitter:title" content="<?= $title ?>">
  <meta property="og:description" content="<?= $desc ?>">
  <meta name="twitter:description" content="<?= $desc ?>">
  <meta property="og:url" content="<?= $url ?>">
  <meta property="og:image" content="<?= $socialImage ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="<?= $socialImage ?>">
  <meta name="description" content="<?= $desc ?>">
</head>
<body class="<?= $bodyCssClass ?>" data-template="<?= $page->template() ?>">