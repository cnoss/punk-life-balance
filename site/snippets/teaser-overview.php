<ul class="teaser-overview">
<?php foreach($pages->find('sangerin', 'komposition', 'coaching', 'about-lia') as $subpage): ?>
  <li class="teaser-card">
    <a href="<?= $subpage->url() ?>">
      <figure>        
        <img src="<?= $subpage->Teaserimage()->toFile()->resize(800,800)->url() ?>" alt="<?= $subpage->title() ?>">
        <figcaption>
          <div class="teaser-card-text">
            <h3 class="simple-link"><?= html($subpage->title()) ?>&nbsp;<?= snippet('arrow-right') ?></h3>
            <p><?= html($subpage->Teasertext()) ?></p>
          </div>
        </figcaption>
      </figure>
    </a>
  </li>
<?php endforeach ?>
</ul>
