<?php
$youtube = $site->youtube();
$facebook = $site->facebook();
$instagram = $site->instagram();
?>
<ul class="social">
  <li>
    <a href="<?= $youtube ?>" aria-label="<?= I18n::translate('youtube') ?>">
      <?= svg('assets/icons/youtube-i.svg') ?>
    </a>
  </li>
  <li>
    <a href="<?= $facebook ?>" aria-label="<?= I18n::translate('facebook') ?>">
      <?= svg('assets/icons/facebook-i.svg') ?>
    </a>
  </li>
  <li>
    <a href="<?= $instagram ?>" aria-label="<?= I18n::translate('instagram') ?>">
      <?= svg('assets/icons/instagram-i.svg') ?>
    </a>
  </li>

</ul>
