<?php
$items = $site->navigation()->toStructure();

if ($items && $items->isNotEmpty()):
    ?>

    <?php foreach ($items as $item):
      $text   = (string) $item->text()->value();
      $type   = $item->type()->value();
      $target = $item->target()->or('_self')->value();
      $id     = Str::slug($text);

        $href = '#';
        if ($type === 'anchor') {
            // akzeptiert Werte mit oder ohne führendes #
            $anchor = ltrim((string) $item->anchor()->value(), '#');
            $href   = 'https://punklifebalance.de/#' . $anchor;
        } elseif ($type === 'url') {
            $href = (string) $item->url()->value();
        }
        ?>
      <li<?php echo $id !== '' ? ' id="' . html($id) . '"' : ''?> class="funky-link">
        <a href="<?php echo html($href)?>" target="<?php echo html($target)?>">
          <?php echo html($text)?>
        </a>
      </li>
    <?php endforeach?>
<?php endif?>