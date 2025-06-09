<?php

$subTitle = !$item->subTitle()->isEmpty() ? "<h4 class=\"subtitle\">{$item->subTitle()}</h4>" : '';
$youtube = !$item->content()->youtube()->isEmpty() ? $item->youtube() : false;
$teaserImageSrc = $item->cover() ? $item->cover() : false;
$teaserImage = $teaserImageSrc ? "<img src=\"{$teaserImageSrc->resize(800, 800)->url()}\" alt=\"{$teaserImageSrc->alt()}\">" : '';
$media = $youtube ? $youtube : $teaserImage;
$mediaContainer = $media ? "<div class=\"media\">{$media}</div>" : '';
$type = $item->kind() == 'termin' ? 'termin' : 'news';
$visibleDate = $type === 'termin' ? $item->dateOfGig() : $item->date();
$gigInfo = $type === 'termin' ? $item->gigInfo($item) : false;
$multiDates = $item->fieldsForMultipeDates()->toStructure()->count() > 1 
  ? $item->fieldsForMultipeDates()->toStructure() : false;

$linktext = $item->linktext()->isNotEmpty()
  ? $item->linktext()
  : 'Weitere Infos';
$link = $item->link()->isNotEmpty()
  ? "<a href=\"{$item->link()}\">{$linktext}</a>"
  : '';       

?>

<article>
  <div class="news-item-content">
    <?php if(!isset($options) || $options !== "no-headline"): ?>
    <h3 class="title"><?= $item->title() ?></h3>
    <?php endif ?>
    
    <?php if($multiDates === false): ?>
    <p class="subtitle date"><?= snippet('date', ['dateString' => $visibleDate ]) ?></p>
    <?php endif ?>
    <?= $subTitle ?>
    <?= $mediaContainer ?>
    <?= $item->text()->kt() ?>
    <?= $link ?>
  </div>

  <?php  if($type === 'termin' && $multiDates === false): ?>
  <?= $gigInfo ?>
  <?php endif ?>



  <?php if ($multiDates): ?>
    <h4><?= I18n::translate('termine') ?></h4>

    <ul class="gig-list">
      <li class="gig-info-wrap">
        <?= snippet("gig-date", ['dateOfGig' => $item->dateOfGig(), 'begin' => $item->begin(), 'price' => $item->price(), 'venue' => $item->venue() ]) ?>
      </li>

        <?php 

          $lastDateOfGig = $item->dateOfGig();
          $lastVenue = $item->venue();
          $lastPrice = $item->price();
          $lastBegin = $item->begin();

          foreach ($multiDates as $serialDateItem): 

            $dateOfGig = $serialDateItem->dateOfGig()->isNotEmpty() && $serialDateItem->dateOfGig() !== $lastDateOfGig 
              ? $serialDateItem->dateOfGig() : $lastDateOfGig;

            $venue = $serialDateItem->venue()->isNotEmpty() && $serialDateItem->venue() !== $lastVenue 
              ? $serialDateItem->venue() : $lastVenue;

            $price = $serialDateItem->price()->isNotEmpty() && $serialDateItem->price() !== $lastPrice 
              ? $serialDateItem->price() : $lastPrice;

            $begin = $serialDateItem->begin()->isNotEmpty() && $serialDateItem->begin() !== $lastBegin 
              ? $serialDateItem->begin() : $lastBegin;

            $lastDateOfGig = $dateOfGig;
            $lastVenue = $venue;
            $lastPrice = $price;
            $lastBegin = $begin;
            ?>

          <li class="gig-info-wrap">
          <?= snippet("gig-date", ['dateOfGig' => $dateOfGig, 'begin' => $begin, 'price' => $price, 'venue' => $venue ]) ?>
          </li>

        <?php endforeach ?>
          </ul>
  <?php endif ?>
  
</article>
