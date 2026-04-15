<?php
$langSwitchText = $kirby->language() == 'de' ? 'EN' : 'DE';
$newLanguage    = $kirby->language() == 'de' ? 'en' : 'de';
$landSwitchUrl  = $page->url($newLanguage);

?>

<header class="main-header">
  <nav class="menu">
    <button class="menu-toggle" type="button" aria-controls="menu-panel" aria-expanded="false">
      <span class="menu-toggle__icon" aria-hidden="true"></span>
      <span class="menu-toggle__text">Menü</span>
    </button>

    <div class="menu-panel" id="menu-panel">
      <ul class="main-navigation" id="main-navigation">
        <?php echo snippet('navigation')?>
      </ul>

      <?php echo snippet('social')?>
    </div>
  </nav>
</header>
