<?php
require_once get_template_directory() . '/includes/enqueue.php';


function theme_setup() {
    add_theme_support('menus');

    // Registrar locais de menu
    register_nav_menus([
        'primary' => __('Menu Principal', 'seutema'),
        'footer'  => __('Menu Rodapé', 'seutema'),
    ]);
}
add_action('after_setup_theme', 'theme_setup');

// Ativa suporte a thumbnails (imagens destacadas)
add_theme_support('post-thumbnails');

function getSpotifyAccessToken($clientId, $clientSecret) {
    $url = 'https://accounts.spotify.com/api/token';
    $headers = [
        'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
        'Content-Type: application/x-www-form-urlencoded'
    ];
    $data = [
        'grant_type' => 'client_credentials'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);
    return $json['access_token'] ?? null;
}

function getLastEpisodes($showId, $accessToken, $limit = 3) {
    $url = "https://api.spotify.com/v1/shows/{$showId}/episodes?limit={$limit}";

    $headers = [
        "Authorization: Bearer {$accessToken}"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Função AJAX
add_action('wp_ajax_get_news_ajax', 'get_news_ajax');
add_action('wp_ajax_nopriv_get_news_ajax', 'get_news_ajax');

function get_news_ajax() {
    // Página enviada pelo JS
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $qtdNews =  8;
    $offSetNews = 24 + ($paged - 1) * 8;

    $result = get_news($paged, $qtdNews, $offSetNews);
    $all_news = $result->posts;

    $data = [];

    foreach ($all_news as $post) {
        $thumb_url = get_the_post_thumbnail_url($post->ID, 'full'); // ou 'full'
        $categNews = getCategNews($post);

        $data[] = [
            'id' => $post->ID,
            'title' => get_the_title($post->ID),
            'excerpt' => get_the_excerpt($post->ID),
            'link' => get_permalink($post->ID),
            'thumbnail' => $thumb_url,
            'categNews' => $categNews,
            'publishDate' => date('d M Y', strtotime($post->post_date)),
        ];  
    }

    $total         = count($data);
    $max_num_pages = ceil($total / $qtdNews);

    $arrData = array(
        'news'          => $data,
        'total'         => $total,
        'max_num_pages' => $max_num_pages,
        'current_page'  => $paged
    );

    wp_send_json_success($arrData);
}

function get_news($paged, $qtdNews, $offSetNews) {
    
    $posts = new WP_Query([
        'paged'               => $paged,
        'post_type'           => 'post',
        'offset'              => $offSetNews,
        'posts_per_page'      => $qtdNews,
        'post_status'         => 'publish',
        'no_found_rows'       => true,  // evita calcular paginação
        'ignore_sticky_posts' => true,  // ignora posts fixados
        'update_post_meta_cache' => false, // não carrega metas
        'update_post_term_cache' => true, // não carrega taxonomias
    ]);

    return $posts;
}

function getCategNews($news) {
    $cats = get_the_category($news->ID);

    if (!empty($cats) && isset($cats[0])) {
        return $cats[0]->cat_name;
    }
    return 'Notícias';
}


function get_leiloes($paged = 1, $leilao_per_page = 10) {
    $data_atual = new DateTime(current_time('Y-m-d H:i:s'));   

    $args = array(
        'post_type'              => 'leiloes',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'paged'                  => 1,
        'no_found_rows'          => true,  // evita calcular paginação
        'ignore_sticky_posts'    => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    );

    $query = new WP_Query($args);
    $arrleiloes = $query->posts;

    $leiloes = [];

    foreach ($arrleiloes as $leilao) {
        $data_abertura = get_field('dias_transmissao', $leilao->ID);

        $inArray = in_array($leilao->ID, array_column($leiloes, 'id_leilao_lance'));

        if (!$inArray && is_array($data_abertura)) {
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
                    
                    $param = str_replace('/:/', '-',  date('H:i', strtotime($hora_transmissao["abertura_transmissao"])) . "_" . date('H:i', strtotime($hora_transmissao["encerramento_transmissao"])));

                    $live_status = $hora_transmissao['live_highlights'][0] ?? null;
                   
                    if($live_status != 'auction_live' && $data_hora_encerramento >= $data_atual) {
                        $leiloes[] = array(
                            'id_leilao_lance'     => $leilao->ID,
                            'titulo'              => get_the_title($leilao->ID),
                            'imagem'              => get_the_post_thumbnail_url($leilao->ID, 'full'),
                            'slug'                => get_post($leilao->ID)->post_name,
                            'param'               => $param,
                            'date_post'           => date('d-m-Y H:i:s', strtotime(get_post($leilao->ID)->post_date)),
                            'date_modified'       => date('d-m-Y H:i:s', strtotime(get_post($leilao->ID)->post_modified)),
                            'abertura'            => $data_hora_abertura->format('d-m-Y H:i:s'),
                            'fechamento'          => $data_hora_encerramento->format('d-m-Y H:i:s'),
                            'leiloeira'           => get_field('leiloeira', $leilao->ID),
                            'programa'            => get_field('programa', $leilao->ID),
                            'local'               => get_field('local', $leilao->ID),
                        );
                    }
                }
            }
        }
    }

    // Ordena os leilões pelo horário de abertura
    usort($leiloes, function($a, $b) {
        return strtotime($a['abertura']) - strtotime($b['abertura']);
    });

    $total         = count($leiloes);
    $max_num_pages = ceil($total / $leilao_per_page);
    $offset        = ($paged - 1) * $leilao_per_page;
    $leiloes_paged = array_slice($leiloes, $offset, $leilao_per_page);


    return array(
        'leiloes'       => $leiloes_paged,
        'total'         => $total,
        'max_num_pages' => $max_num_pages,
        'current_page'  => $paged
    );
}

add_filter('query_vars', function ($vars) {
    $vars[] = 'h';
    return $vars;
});

add_action('wp_ajax_get_leiloes_by_date', 'get_leiloes_by_date');
add_action('wp_ajax_nopriv_get_leiloes_by_date', 'get_leiloes_by_date');


function get_leiloes_by_date() {
    $filter_date = sanitize_text_field($_GET['date']);
    $data_atual = new DateTime(current_time('Y-m-d H:i:s'));

    $args = [
        'post_type'              => 'leiloes',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'no_found_rows'          => true,
        'ignore_sticky_posts'    => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ];

    $query = new WP_Query($args);
    $arrleiloes = $query->posts;

    $leiloes = [];

    foreach ($arrleiloes as $leilao) {
        $data_abertura = get_field('dias_transmissao', $leilao->ID);

        if (!is_array($data_abertura)) {
            continue;
        }

        foreach ($data_abertura as $abertura) {
            // 🔑 data vinda do ACF
            $data_leilao = $abertura['data_transmissao'];

            // normaliza para Y-m-d
            $data_leilao_formatada = date('Y-m-d', strtotime($data_leilao));

            // ❌ se não for a data clicada, ignora
            if ($data_leilao_formatada !== $filter_date) {
                continue;
            }

            foreach ($abertura['horario_transmissao'] as $hora_transmissao) {
                $hora_abertura = $hora_transmissao['abertura_transmissao'];
                $hora_encerramento = $hora_transmissao['encerramento_transmissao'];

                $data_hora_abertura = DateTime::createFromFormat(
                    'Y-m-d H:i:s',
                    $data_leilao_formatada . ' ' . $hora_abertura
                );

                $data_hora_encerramento = DateTime::createFromFormat(
                    'Y-m-d H:i:s',
                    $data_leilao_formatada . ' ' . $hora_encerramento
                );

                if ($data_hora_encerramento <= $data_hora_abertura) {
                    $data_hora_encerramento->modify('+1 day');
                }

                $param = str_replace(
                    '/:/',
                    '-',
                    date('H:i', strtotime($hora_abertura)) . '_' .
                    date('H:i', strtotime($hora_encerramento))
                );

                $live_status = $hora_transmissao['live_highlights'][0] ?? null;

                if ($live_status !== 'auction_live' && $data_hora_encerramento >= $data_atual) {
                    $leiloes[] = [
                        'id_leilao_lance' => $leilao->ID,
                        'titulo'          => get_the_title($leilao->ID),
                        'imagem'          => get_the_post_thumbnail_url($leilao->ID, 'full'),
                        'slug'            => get_post($leilao->ID)->post_name,
                        'param'           => $param,
                        'abertura'        => $data_hora_abertura->format('Y-m-d H:i:s'),
                        'fechamento'      => $data_hora_encerramento->format('Y-m-d H:i:s'),
                        'leiloeira'       => get_field('leiloeira', $leilao->ID),
                        'programa'        => get_field('programa', $leilao->ID),
                        'local'           => get_field('local', $leilao->ID),
                    ];
                }
            }
        }
    }

    usort($leiloes, function ($a, $b) {
        return strtotime($a['abertura']) - strtotime($b['abertura']);
    });

    ob_start();
    
    if (!empty($leiloes)) { 
        foreach ($leiloes as $leilao) {
            get_template_part( 'components/content', 'card-leilao-line', $leilao );
        }
    } else {
        echo '<p class="no-results">Nenhum leilão para esta data.</p>';
    }

    // $html = ob_get_clean();
    // wp_send_json_success($html);
    wp_die();
}
