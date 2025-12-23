<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $resultado = get_leiloes($paged, 4);

    if (!$resultado["total"] > 0) return;

    $firstLeilao = $resultado['leiloes'][0];
    $leiloes = array_slice($resultado['leiloes'], 1);
?>
<?php if (isset($resultado['leiloes']) || !empty($resultado['leiloes'])): ?>
    <section class="scheduleAuction">
        <h2 class="title">Próximos leilões</h2>
        
        <div class="d-flex">
            <div class="cardLeilao">
                <a href="<?= get_site_url() . "/leiloes/" . $firstLeilao['slug']  . '?h=' . $firstLeilao['param'] ?>">
                    <img fetchpriority="high" decoding="async" src="<?= $firstLeilao['imagem']; ?>" alt="<?= $firstLeilao['titulo']; ?>" />
                </a>

                <div class="cardLeilao__info">
                    <p>
                        <img src="<?= get_template_directory_uri() . '/assets/img/relogio-verde.svg'; ?>" alt="ícone de Relógio" />
                        <?= date('H\hi', strtotime($firstLeilao['abertura'])); ?> 
                        <span><?= $firstLeilao['programa']; ?></span> 
                        <strong><?= $firstLeilao['local']; ?></strong>
                    </p>
                    <h2><?= $firstLeilao['titulo']; ?></h2>
                    <a href="<?= get_site_url() . "/leiloes/" . $firstLeilao['slug']  . '?h=' . $firstLeilao['param'] ?>" class="btn">Conferir<span></span></a>
                </div>
            </div>

            <div class="d-flex-column">
                <?php foreach ($leiloes as $leilao): ?>
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
                <?php endforeach;?>
            </div>
        </div>

        <div class="seeMore">
            <a href="/agenda" class="btn"><span></span>Confira agenda completa</a>
        </div>
    </section>
<?php endif;?>
