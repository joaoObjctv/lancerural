<?php $leilao = $args; ?>

<div class="cardLeilao cardLeilao--line">
    <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug']  . '?h=' . $leilao['param'] ?>">
        <img fetchpriority="high" decoding="async" src="<?= $leilao['imagem']; ?>" alt="<?= $leilao['titulo']; ?>" />
    </a>

    <div class="cardLeilao__info">
        <p>
            <img src="<?= get_template_directory_uri() . '/assets/img/relogio-verde.svg'; ?>" alt="ícone de Relógio" />
            <?= date('d/m/Y', strtotime($leilao['abertura'])); ?>
            <span><?= date('H\hi', strtotime($leilao['abertura'])); ?></span>
            <?= $leilao['programa']; ?>
            <strong><?= $leilao['local']; ?></strong>
        </p>
        <h2><?= $leilao['titulo']; ?></h2>
        <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug']  . '?h=' . $leilao['param'] ?>" class="btn">Conferir<span></span></a>
    </div>
</div>