<?php
$langSwitchText = $kirby->language() == 'de' ? 'EN' : 'DE';
$newLanguage = $kirby->language() == 'de' ? 'en' : 'de';
$landSwitchUrl = $page->url($newLanguage);

?>

<header class="main-header" data-js-menu-state="menu-is-closed">

  <button class="menu-button" data-js-menu aria-label="Menü Button">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </button>


  <nav class="menu">
    <ul class="main-navigation">
    <?php foreach ($site->children()->listed() as $item): ?>
      <li class="funky-link"><a <?php e($item->isOpen(), 'aria-current="page"')?> href="<?=$item->url()?>"><?=$item->title()->esc()?></a></li>
    <?php endforeach?>
    <!--li><a href="<?=$landSwitchUrl?>"><?=$langSwitchText?></a></li-->
    </ul>
  </nav>
  
</header>
