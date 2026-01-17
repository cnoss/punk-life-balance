<?php
$langSwitchText = $kirby->language() == 'de' ? 'EN' : 'DE';
$newLanguage    = $kirby->language() == 'de' ? 'en' : 'de';
$landSwitchUrl  = $page->url($newLanguage);

?>

<header class="main-header">
  <nav class="menu">
    <ul class="main-navigation">
      <?php echo snippet('navigation')?>
    </ul>
  </nav>
</header>
