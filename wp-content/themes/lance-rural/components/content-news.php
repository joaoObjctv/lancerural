<?php
    $qtdNews = $args['qtdNews'] ?? 8;
    $offSetNews = $args['offSetNews'] ?? 0;
    $showBtn = $args['showBtn'] ?? 'block';
    $side = $args['side'] ?? 'row';
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $posts = get_news($paged, $qtdNews, $offSetNews);

    $all_news = $posts->posts;

    // Primeiro
    $first_news = $all_news[0];
    $categFirst = getCategNews($first_news);

    // os próximos 3 (excluindo o primeiro)
    $three_news = array_slice($all_news, 1, 3);

    // o restante (excluindo os 4 primeiros)
    $rest_news = array_slice($all_news, 4);

?>

<section class="lastNews">
    <div class="d-flex listNews" style="flex-direction: <?=$side?>;">
        <div class="cardNoticias">
            <a href="/noticias/<?= $first_news->post_name; ?>">
                <img fetchpriority="high" decoding="async" src="<?= get_the_post_thumbnail_url($first_news->ID) ?>" alt="<?= 'Imagem de destaque do post: '. $first_news->post_title;?>" />
            </a>

            <div class="cardNoticias__info">
                <div class="d-flex">
                    <a href="#"><?= $categFirst; ?></a>
                    <p><?= date('d M Y', strtotime($first_news->post_date));?></p>
                </div>

                <h2><a href="<?= '/noticias/' . $first_news->post_name; ?>"><?= $first_news->post_title;?></a></h2>
                <p><?= $first_news->post_excerpt;?></p>
            </div>
        </div>
        <div class="d-flex-column">
            <?php foreach ($three_news as $sideNews): ?>
                <?php $catMidle = getCategNews($sideNews); ?>
                <div class="cardNoticias cardNoticias--line">
                    <a href="<?= '/noticias/' . $sideNews->post_name; ?>">
                        <img fetchpriority="high" decoding="async" src="<?= get_the_post_thumbnail_url($sideNews->ID) ?>" alt="'Imagem de destaque do post: '<?= $sideNews->post_title;?>" />
                    </a>

                    <div class="cardNoticias__info">
                        <div class="d-flex">
                            <?php if(isset($catMidle)): ?>
                                <a href="#"><?= $catMidle; ?></a>
                            <?php endif; ?>
                            <p><?= date('d M Y', strtotime($sideNews->post_date));?></p>
                        </div>

                        <h2><a href="<?= '/noticias/' . $sideNews->post_name; ?>"><?= $sideNews->post_title;?></a></h2>
                        <p><?= $sideNews->post_excerpt;?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if($rest_news): ?>
        <div class="d-grid">
            <?php foreach ($rest_news as $bottomNews): ?>
                <?php $catMidle = getCategNews($bottomNews); ?>
                <div class="cardNoticias">
                    <a href="<?= '/noticias/' . $bottomNews->post_name; ?>">
                        <img fetchpriority="high" decoding="async" src="<?= get_the_post_thumbnail_url($bottomNews->ID) ?>" alt="'Imagem de destaque do post: '<?= $bottomNews->post_title;?>" />
                    </a>

                    <div class="cardNoticias__info">
                        <div class="d-flex">
                            <?php if(isset($catMidle)): ?>
                                <a href="#"><?= $catMidle; ?></a>
                            <?php endif; ?>
                            <p><?= date('d M Y', strtotime($bottomNews->post_date));?></p>
                        </div>

                        <h2><a href="<?= '/noticias/' . $bottomNews->post_name; ?>"><?= $bottomNews->post_title;?></a></h2>
                        <p><?= $bottomNews->post_excerpt;?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
      
    <div class="seeMore" style="display: <?=$showBtn?>;">
        <a href="/noticias" class="btn"><span></span>Confira todas as notícias</a>
    </div>
</section>