<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This video snippet overwrites
  Kirby's default video block to add custom classes
  and style attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<?php if ($block->url()->isNotEmpty()): ?>
<figure>
  <div class="video">
    <iframe width="560" height="315" src="<?= $block->url() ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="video-caption"><?= $block->caption() ?></figcaption>
  <?php endif ?>
</figure>
<?php endif ?>
