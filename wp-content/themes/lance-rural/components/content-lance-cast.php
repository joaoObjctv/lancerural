<?php
    $clientId = '83f3c6a7404c453eae48b44123ceff49';
    $clientSecret = 'a14384527a4548e79fa3a2fbb7ff81f7';
    $showId = '3B8kUwZ2i2NNNwNie4TTJ1';

    $token = getSpotifyAccessToken($clientId, $clientSecret);
?>

<?php if ($token): ?>
    <?php $episodes = getLastEpisodes($showId, $token); ?>
    
    <div class="lanceCast">
        <div class="lanceCast__txt">
            <h3><img src="<?= get_template_directory_uri() . '/assets/img/spotify-icon-logo.png'?>" alt="Ícone do Spotfy"> LanceCast</h3>
            <h2>Ouça agora <strong>nosso podcast</strong></h2>
            <a href="https://open.spotify.com/show/3B8kUwZ2i2NNNwNie4TTJ1" class="btn" target="_blank">
                <div><span></span></div> Dê o play e descubra mais
            </a>
        </div>

        <div class="swiper" id="swiperCast">
            <div class="lanceCast__list swiper-wrapper">
                <?php foreach ($episodes['items'] as $ep): ?>
                    <?php if(isset($ep) && !empty($ep)): ?>
                        <div class="swiper-slide">
                            <div class="cardCast"> 
                                <a href="<?= $ep['external_urls']['spotify']; ?>" target="_blank">
                                    <img src="<?= $ep['images'][1]['url']; ?>" alt="">
                                    <h3><?= $ep['name']; ?></h3>
                                    <p>LanceCast</p>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
<?php endif; ?>