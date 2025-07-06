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
  <script defer src="https://cloud.umami.is/script.js" data-website-id="1ad97170-6376-46f7-b7ba-72121c611ed2"></script>
  <meta name="google-site-verification" content="tXKYUC8jflHKMsiUkJ0RbzIcFleZFwNKle0oEyIfPyU" />
  <?php snippet('seo/head'); ?>
</head>
<body class="<?= $bodyCssClass ?>" data-template="<?= $page->template() ?>">