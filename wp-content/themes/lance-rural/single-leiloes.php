<?php 
    global $post;

    $leilaoLive = [];
    $horario = esc_html(get_query_var('h'));
    $postSlug = urlencode(get_permalink($post->ID) . '?h=' . $horario);

    $leiloeira = get_field('leiloeira', $post->ID);
    $local = get_field('local', $post->ID);
    $programa = get_field('programa', $post->ID);
    $whatsapp = get_field('whatsapp', $post->ID);
    $fone = get_field('fone', $post->ID);
    $raca = get_field('raca', $post->ID);
    $forma_de_pagamento = get_field('forma_de_pagamento', $post->ID);
    $frete = get_field('frete', $post->ID);
    $catalogo_leilao = get_field('catalogo_leilao', $post->ID);
    $ordem_de_entrada = get_field('ordem_de_entrada', $post->ID);
    $lotes_catalogo = get_field('lotes_catalogo', $post->ID);

    if($post->post_type == 'leiloes') {
        $horario = esc_html(get_query_var('h'));
        $data_abertura = get_field('dias_transmissao', $post->ID);

        foreach ($data_abertura as $abertura) {
            $data_leilao = $abertura["data_transmissao"];
            foreach ($abertura["horario_transmissao"] as $hora_transmissao) {
                $hora_abertura = $hora_transmissao["abertura_transmissao"];
                $hora_encerramento = $hora_transmissao["encerramento_transmissao"];

                $data_hora_abertura = DateTime::createFromFormat('Y-m-d H:i:s', $data_leilao . ' ' . $hora_abertura);
                $data_hora_encerramento = DateTime::createFromFormat('Y-m-d H:i:s', $data_leilao . ' ' . $hora_encerramento);
            
                if ($data_hora_encerramento <= $data_hora_abertura) {
                    $data_hora_encerramento->modify('+1 day');
                }
                
                $data_abertura_l = $data_hora_abertura->format('d/m/Y');
                $data_encerramento = $data_hora_encerramento->format('d/m/Y');
            }
        }
        
        $horario = esc_html(get_query_var('h'));
        
        if ($horario) {
            $dataSplit = explode("_", $horario);
            $horaIni = str_replace('-', 'h', $dataSplit[0]);
            $horaFim = str_replace('-', 'h', $dataSplit[1]);
        }

        $filtroHoraIni = str_replace('-', ':',$dataSplit[0]). ':00';
        $filtroHoraFim = str_replace('-', ':',$dataSplit[0]). ':00';
        $data_abertura = get_field('dias_transmissao', $post->ID);

        foreach ($data_abertura as $abertura) {
            $data_leilao = $abertura["data_transmissao"];

            foreach ($abertura["horario_transmissao"] as $hora_transmissao) {

                if($filtroHoraIni == $hora_transmissao['abertura_transmissao'] && $hora_transmissao['live_highlights'][0] == 'auction_live' ) {
                    $leilaoLive[] = array(
                        'stream' => $hora_transmissao['live_streming_site'],
                        'live_streming' => $hora_transmissao['live_highlights'][0],
                    );
                }
            }
        }
    }

?>
<?php get_header(); ?>

<?php if($leilaoLive[0]["live_streming"] == "auction_live"): ?>
    <section class="bannerSingle live">
        <div class="container">
            <strong>acontecendo agora</strong>
            <h1><?= get_the_title(); ?></h1>
            <p><?= $leiloeira ?></p>
            <div class="embed-responsive embed-responsive-16by9 leilaoStream">
                <iframe class="embed-responsive-item" src="<?= $leilaoLive[0]['stream']; ?>"></iframe>
            </div>
            <div class="bannerSingle__info">
                <div class="txt">
                    <div class="date">
                        <div class="date__ini">
                            <h3>abertura</h3>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/date-icon.svg" height="18" alt=""/><?= $data_abertura_l; ?></p>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/hour-icon.svg" height="18" alt=""/><?= $horaIni; ?></p>
                        </div>
                        <div class="date__end">
                            <h3>Encerramento</h3>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/date-icon.svg" height="18" alt=""/> <?= $data_encerramento; ?></p>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/hour-icon.svg" height="18" alt=""/> <?= $horaFim; ?></p>        
                        </div>
                    </div>
                    <?php get_template_part( 'components/content', 'social-share' ); ?>
                </div>
                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?= get_the_title($post->ID); ?>">
            </div>
        </div>
    </section>

<?php else: ?>
    <section class="bannerSingle">
        <div class="container">
            <div class="bannerSingle__info">
                <div class="txt">
                    <h1><?= get_the_title(); ?></h1>
                    <p><?= $leiloeira ?></p>
                    <div class="date">
                        <div class="date__ini">
                            <h3>abertura</h3>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/date-icon.svg" height="18" alt=""/><?= $data_abertura_l; ?></p>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/hour-icon.svg" height="18" alt=""/><?= $horaIni; ?></p>
                        </div>
                        <div class="date__end">
                            <h3>Encerramento</h3>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/date-icon.svg" height="18" alt=""/> <?= $data_encerramento; ?></p>
                            <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/hour-icon.svg" height="18" alt=""/> <?= $horaFim; ?></p>        
                        </div>
                    </div>
                    <?php get_template_part( 'components/content', 'social-share' ); ?>
                </div>
                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?= get_the_title($post->ID); ?>">
            </div>
        </div>
    </section>
<?php endif ?>


<div class="container">
    <?php if($catalogo_leilao): ?>

        <a href="<?= $catalogo_leilao['url']; ?>" class="btn">
            <i class="pp-button-icon pp-button-icon-before far fa-sticky-note"></i>Catálogo
        </a>
    <?php endif; ?>

    <ul class="infoLeilao">
        <?php if($leiloeira): ?>
            <li>
                <h3>Leiloeira</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-contato.svg" height="16" alt="Leiloeira"> <?= $leiloeira; ?></p>
            </li>
        <?php endif; ?>

        <?php if($fone): ?>
            <li>
                <h3>CONTATO</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-contato.svg" height="16" alt="Contato"> <?= $fone; ?></p>
            </li>
        <?php endif; ?>

        <?php if($local): ?>
            <li>
                <h3>LOCAL DO LEILÃO</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-local.svg" height="16" alt="Leiloeira"> <?= $local; ?></p>
            </li>
        <?php endif; ?>

        <?php if($raca): ?>
            <li>
                <h3>RAÇA</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-raça.svg" height="16" alt="Leiloeira"> <?= $raca; ?></p>
            </li>
        <?php endif; ?>

        <?php if($forma_de_pagamento): ?>
            <li>
                <h3>FORMAS DE PAGAMENTO</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-pagamento.svg" height="16" alt="Leiloeira"><?= $forma_de_pagamento; ?></p>
            </li>
        <?php endif; ?>

        <?php if($frete): ?>
            <li>
                <h3>FRETE</h3>
                <p><img src="https://lancerural.com.br/wp-content/uploads/2020/01/icon-frete.svg" height="16" alt="Leiloeira"><?= $frete; ?></p>
            </li>
        <?php endif; ?>
    </ul>

    <?php if ($lotes_catalogo): ?>
        <div class="container">
            <div class="lotes-content">
                <h2>Lotes</h2>
                <div class="d-flex mb-col">
                    <?php foreach ($lotes_catalogo as $lote) : ?>
                        <div class="card-lote">
                            <a href="<?= get_site_url() ."/lotes/" . $lote->post_name; ?>">
                                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="">
                                <h3><?= $lote->post_title; ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part( 'components/content', 'banner-mini' ); ?>

    <br><br>

    <?php if ( wp_is_mobile() ): ?>
        <?php get_template_part( 'components/content', 'schedule-auction-mobile' ); ?>
    <?php else: ?>
        <?php get_template_part( 'components/content', 'schedule-auction' ); ?>
    <?php endif; ?>
</div>
<?php get_template_part( 'components/content', 'banner-bottom' ); ?>
<?php get_footer(); ?>