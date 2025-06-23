<footer class="main-footer has-grid" data-cols="2">
    <ul class="footer-links">
      <!--li><a href="#" data-js-cookies><?= I18n::translate('cookie-einstellungen') ?></a></li-->
      <?php foreach ($site->children()->listed() as $item): ?>
        <li class="funky-link wobble"><a <?php e($item->isOpen(), 'aria-current="page"')?> href="<?=$item->url()?>"><?=$item->title()->esc()?></a></li>
      <?php endforeach?>
      <li class="funky-link wobble"><a href="/de/impressum">Impressum</a></li>
    </ul>
    <div class="footer-social">
      
    </div>

</footer>

<?= js([
  'assets/scripts/main.js',
  '@auto'
]) ?>

</body>
</html>