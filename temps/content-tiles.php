<section class="content__tiles">
  <div class="inner">

    <h2 class="head-line"><?php echo $tiles_head; ?></h2>

    <p class="content__tiles__head-sub"><?php echo $tiles_desc; ?></p>

    <div class="content__tiles__row">
      <a target="" class="content__tiles__row__card" href='<?php echo $config[$url]['sports_link']; ?>'>
        <img src="assets/images/thumbs/tile-sports.png" alt="">
        <div class="content__tiles__row__txts">
          <h3><?php echo $sports; ?></h3>
          <p class="push--margin"><?php echo $sports_txt; ?></p>
          <span href="" class="btn btn--gold md-mb disabled" data-cta="cta-tile-1"><?php echo $tile_btn; ?></span>
        </div>
      </a>
      <a target="" class="content__tiles__row__card" href='<?php echo $config[$url]['livecasino_link']; ?>'>
        <img src="assets/images/thumbs/tile-live-casino.png" alt="">
        <div class="content__tiles__row__txts">
          <h3><?php echo $live_casino; ?></h3>
          <p class="push--margin"><?php echo $live_casino_txt; ?></p>
          <span href="" class="btn btn--gold md-mb disabled" data-cta="cta-tile-2"><?php echo $tile_btn; ?></span>
        </div>
      </a>
    </div>
    <div class="content__tiles__row">
      <a target="" class="content__tiles__row__card" href='<?php echo $config[$url]['casino_link']; ?>'>
        <img src="assets/images/thumbs/tile-casino-fishing.png" alt="">
        <div class="content__tiles__row__txts">
          <h3><?php echo $casino_fishing; ?></h3>
          <p class="push--margin"><?php echo $casino_fishing_txt; ?></p>
          <span href="" class="btn btn--gold md-mb disabled" data-cta="cta-tile-3"><?php echo $tile_btn; ?></span>
        </div>
      </a>
      <a target="" class="content__tiles__row__card" href='<?php echo $config[$url]['knlt_link']; ?>'>
        <img src="assets/images/thumbs/tile-keno-lotto.png" alt="">
        <div class="content__tiles__row__txts">
          <h3><?php echo $keno_lotto; ?></h3>
          <p class="push--margin"><?php echo $keno_lotto_txt; ?></p>
          <span href="" class="btn btn--gold md-mb disabled" data-cta="cta-tile-4"><?php echo $tile_btn; ?></span>
        </div>
      </a>
    </div>

  </div>
</section>