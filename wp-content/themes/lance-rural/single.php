<?php get_header(); ?>
    <?php get_template_part( 'components/content', 'banner-mini' ); ?>

    <div class="articlePost">
        <div class="container">
        
            <h2>Notícias</h2>

            <div class="breadcrumb">
                <a href="<?= get_site_url(); ?>">Pagina Inicial <span>></span></a>
                <a href="<?= get_site_url() ?>/noticias">Notícias <span>></span></a>
                <a href="#">Primeira edição do Beef Dinner celebra a pecuária brasileira em São Paulo</a>
            </div>
            
            <div class="d-grid">
                
                <?php if (have_posts()): ?>
                    <?php while (have_posts()) : the_post();?>
                        <article>
                            <div class="socialShare">
                                <p>Compartilhar:</p>

                                <div class="socialShare__media">
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/FacebookLogo.png' ?>" alt="Ícone da rede social facebook">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/XLogo.png' ?>" alt="Ícone da rede social X">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/TelegramLogo.png' ?>" alt="Ícone da rede social Telegram">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/WhatsappLogo.png' ?>" alt="Ícone da rede social WhatsApp">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/LinkedinLogo.png' ?>" alt="Ícone da rede social LinkedIn">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/Envelope.png' ?>" alt="Ícone de e-mail">
                                    </a>
                                </div>
                            </div>

                            <div class="content">
                                <div class="content__title">
                                    <h1><?php the_title();?></h1>
                                </div>

                                <div class="content__post">
                                    <?php the_content();?>
                                </div>
                            </div>

                            <div class="socialShare">
                                <p>Compartilhar:</p>

                                <div class="socialShare__media">
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/FacebookLogo.png' ?>" alt="Ícone da rede social facebook">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/XLogo.png' ?>" alt="Ícone da rede social X">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/TelegramLogo.png' ?>" alt="Ícone da rede social Telegram">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/WhatsappLogo.png' ?>" alt="Ícone da rede social WhatsApp">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/LinkedinLogo.png' ?>" alt="Ícone da rede social LinkedIn">
                                    </a>
                                    <a href="#">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/icones/Envelope.png' ?>" alt="Ícone de e-mail">
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php endif;?>

                <div class="sidebar">
                    <img src="<?= get_template_directory_uri() . '/assets/img/card.png' ?>" alt="">

                    <div class="socials">
                        <h3>Redes Sociais</h3>

                        <ul class="socials__media">
                            <li>
                                <a href="#" target="_blank">
                                    <img src="<?= get_template_directory_uri() . '/assets/img/facebook.png' ?>" alt="Ícone do Facebook" />
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="<?= get_template_directory_uri() . '/assets/img/instagram.png' ?>" alt="Ícone do Instagram" />
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <img src="<?= get_template_directory_uri() . '/assets/img/youtube.png' ?>" alt="Ícone do YouTube" />
                                </a>
                            </li>
                        </ul>
                    </div>

                    <h2 class="title">Últimas notícias</h2>
                    <?php get_template_part( 'components/content', 'news', array('qtdNews' => 4, 'showBtn' => 'none') ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php get_template_part( 'components/content', 'banner-mini' ); ?>
        <br>
        <br>
    </div>

    <div class="container seeToo">
        <h2 class="title">Veja também</h2>
        <?php get_template_part( 'components/content', 'news', array('qtdNews' => 4) ); ?>

        <?php if ( wp_is_mobile() ): ?>
            <?php get_template_part( 'components/content', 'schedule-auction-mobile' ); ?>
        <?php else: ?>
            <?php get_template_part( 'components/content', 'schedule-auction' ); ?>
        <?php endif; ?>
    </div>
    <?php get_template_part( 'components/content', 'banner-bottom' ); ?>

<?php get_footer(); ?>