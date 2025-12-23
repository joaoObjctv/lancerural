<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $leiloes = get_leiloes($paged, 4)['leiloes'];

    if (!$leiloes["total"] > 0) return;
?>

<section class="scheduleAuction">
    <div class="swiper" id="swiperSchedule">
        <div class="swiper-wrapper">
            <?php foreach ($leiloes as $leilao): ?>
                <div class="swiper-slide">
                    <div class="cardLeilao cardLeilao--line">
                        <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug']  . '?h=' . $leilao['param'] ?>">
                            <img fetchpriority="high" decoding="async" src="<?= $leilao['imagem']; ?>" alt="<?= $leilao['titulo']; ?>" />
                        </a>

                        <div class="cardLeilao__info">
                            <p>
                                <img src="<?= get_template_directory_uri() . '/assets/img/relogio-verde.svg'; ?>" alt="ícone de Relógio" />
                                <?= date('H\hi', strtotime($leilao['abertura'])); ?>
                                <span><?= $leilao['programa']; ?></span>
                                <strong><?= $leilao['local']; ?></strong>
                            </p>
                            <h2><?= $leilao['titulo']; ?></h2>
                            <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug']  . '?h=' . $leilao['param'] ?>" class="btn">Conferir<span></span></a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="swiperSchedule-pagination"></div>
    </div>

    <div class="seeMore">
        <a href="/agenda" class="btn"><span></span>Confira agenda completa</a>
    </div>
</section>
