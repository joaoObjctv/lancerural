<?php
    $data_atual = current_time('d-m-Y H:i:s');
    global $wpdb;

    $results = $wpdb->get_results("
        SELECT pm.post_id
        FROM {$wpdb->prefix}postmeta pm
        INNER JOIN {$wpdb->prefix}posts p ON pm.post_id = p.ID
        WHERE pm.meta_key LIKE 'dias_transmissao_%_horario_transmissao_%_live_highlights'
            AND pm.meta_value LIKE '%auction_live%'
            AND p.post_type = 'leiloes'
            AND p.post_status = 'publish'
    ");

    $leiloes = [];

    foreach ($results as $key => $post) {

        $data_abertura = get_field('dias_transmissao', $post->post_id);
        $post_id = $post->post_id;

        // Pega todos IDs já adicionados em $leiloes
        $ids_existentes = array_column($leiloes, 'id_leilao_lance');

        if (!in_array($post_id, $ids_existentes)) {
            foreach ($data_abertura as $abertura) {
                $data_leilao = $abertura["data_transmissao"];

                foreach ($abertura["horario_transmissao"] as $hora_transmissao) {

                    $data_hora_abertura = DateTime::createFromFormat('Y-m-d H:i:s', $data_leilao . ' ' . $hora_transmissao["abertura_transmissao"]);
                    $data_hora_encerramento = DateTime::createFromFormat('Y-m-d H:i:s', $data_leilao . ' ' . $hora_transmissao["encerramento_transmissao"]);
                
                    if ($data_hora_encerramento <= $data_hora_abertura) {
                        $data_hora_encerramento->modify('+1 day');
                    }
                    
                    $data_abertura = $data_hora_abertura->format('d-m-Y H:i:s');
                    $data_encerramento = $data_hora_encerramento->format('d-m-Y H:i:s');

                    $param = str_replace('/:/', '-',  date('H:i', strtotime($hora_transmissao["abertura_transmissao"])) . "_" . date('H:i', strtotime($hora_transmissao["encerramento_transmissao"])));;
                
                    if(!empty($hora_transmissao['live_highlights'][0]) && isset($hora_transmissao['live_highlights'][0])) { //line 44
                        if($hora_transmissao['live_highlights'][0] == 'auction_live' && $data_encerramento >= $data_atual) {
                            $leiloes[] = array(
                                'id_leilao_lance'     => $post->post_id,
                                'titulo'              => get_the_title($post->post_id),
                                'imagem'              => get_the_post_thumbnail_url($post->post_id, 'full'),
                                'slug'                => get_post_field('post_name', $post->post_id),
                                'date_post'           => date('d-m-Y H:i:s', strtotime(get_post_field('post_date', $post->post_id))),
                                'date_modified'       => date('d-m-Y H:i:s', strtotime(get_post_field('post_modified', $post->post_id))),
                                'param'               => $param,
                                'abertura'            => $data_abertura,
                                'fechamento'          => $data_encerramento,
                                'leiloeira'           => get_field('leiloeira', $post->post_id),
                                'programa'            => get_field('programa', $post->post_id),
                                'local'               => get_field('local', $post->post_id),
                            );
                        }
                    }
                }
                
            }
        }
    }

    usort($leiloes, function($a, $b) {
        return strtotime($a['abertura']) - strtotime($b['abertura']);
    });

    $formatter = new IntlDateFormatter(
        'pt_BR',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'America/Sao_Paulo',
        IntlDateFormatter::GREGORIAN,
        "MMM"
    );
?>

<?php if($leiloes): ?>
    <?php get_template_part( 'components/content', 'banner-mini' ); ?>
    
    <div class="swiper" id="swiperLive">
        <div class="swiper-wrapper">
            <?php foreach ($leiloes as $leilao): ?>
                <?php $timestamp = strtotime($leilao['abertura']);
                $mes = $formatter->format($timestamp);?>
                <div class="swiper-slide">
                    <div class="auctionSwiper">
                        <div class="auctionSwiper__txt">
                            <h5 class="live live--mb">AO VIVO</h5>
                            <div class="date-time">
                                <p class="now"><img src="<?= get_template_directory_uri() . '/assets/img/relogio-branco.svg'; ?>" alt="ícone de Relógio" /> Agora</p>
                                <h5>
                                    <span class="data-month">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/calendario.svg'; ?>" alt="ícone de calendário" />
                                        <?= date('d', strtotime($leilao['abertura'])); ?>
                                        <?= ucfirst($mes); ?>
                                    </span>
                                    <span class="hour-title">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/relogio-verde.svg'; ?>" alt="ícone de Relógio" />
                                        <?= date('H', strtotime($leilao['abertura'])); ?>h<?= date('i', strtotime($leilao['abertura'])); ?>
                                    </span>

                                </h5>
                            </div>

                            <div class="auction-locale">
                                <h2><a href="<?= get_site_url() . "/leiloes/" . $leilao['slug'] . '?h=' . $leilao['param']; ?>"><?= $leilao['titulo']; ?></a></h2>
                                <p>Transmissão: <strong><?= $leilao['programa']; ?></strong></p>
                                <p>Local: <strong><?= $leilao['local']; ?></strong></p>
                            </div>
                            
                            <div class="show show--mb">
                                <?php if($leilao['imagem']): ?>
                                    <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug'] . '?h=' . $leilao['param']; ?>">
                                        <img fetchpriority="high" decoding="async" src="<?= $leilao['imagem']; ?>" alt="<?= $leilao['titulo']; ?>" />
                                    </a>
                                <?php endif; ?>
                            </div>

                            <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug'] . '?h=' . $leilao['param']; ?>" class="btn">Conferir <span></span></a>
                        </div>

                        <div class="show show--desk">
                            <h5 class="live">AO VIVO</h5>
                            
                            <?php if($leilao['imagem']): ?>
                                <a href="<?= get_site_url() . "/leiloes/" . $leilao['slug'] . '?h=' . $leilao['param']; ?>">
                                    <img fetchpriority="high" decoding="async" src="<?= $leilao['imagem']; ?>" alt="<?= $leilao['titulo']; ?>" />
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

<?php else: ?>
    <?php get_template_part( 'components/content', 'banner-top' ); ?>
    
<?php endif; ?>