<footer class="main-footer has-grid" data-cols="2">
    <ul class="footer-links">
      <?php echo snippet('navigation')?>
      <li class="funky-link wobble"><a href="/de/impressum">Impressum</a></li>
    </ul>
    <div class="footer-social">
      
    </div>

</footer>

<?= js([
  'assets/scripts/main.js',
  '@auto'
]) ?>
    <?php snippet('seo/schemas'); ?>
</body>
</html>