<?php 
    /* Template Name: Institucional APP */
    get_header();
?>
<div class="page-app">
    <section class="contentApp">
        <div class="container">
            <div class="contentApp__info">
                <div class="txt">
                    <span>Aplicativo iOS e Android</span>
                    <h1>A maior plataforma digital de pecuária do Brasil está ao seu alcance!</h1>
                    <p>Os principais leilões, eventos, julgamentos, exposições e provas da pecuária nacional e internacional na palma da sua mão.</p>

                    <div class="d-flex">
                        <a href="https://play.google.com/store/apps/details?id=com.canalrural" target="_blank">
                            <img src="<?= get_template_directory_uri() . '/assets/img/btn_google_play.png'?>" alt="Imgaem do botão com link para o app no Google Play" />
                        </a>
                        <a href="https://apps.apple.com/br/app/lance-rural/id1492354675" target="_blank">
                            <img src="<?= get_template_directory_uri() . '/assets/img/btn_app_store.png'?>" alt="Imgaem do Botão com link para a app store" />
                        </a>
                        <img src="<?= get_template_directory_uri() . '/assets/img/stars.png'?>" height="56" alt="">
                    </div>
                </div>
                <img src="<?= get_template_directory_uri() . '/assets/img/app.png'?>" alt="">
            </div>
        </div>
    </section>

    <div class="bannerApp">
        <div class="container d-flex">
            <img src="<?= get_template_directory_uri() . '/assets/img/cellular.png'?>" alt="">
            <div class="aboutApp">
                <span>Sobre o App</span>
                <h2>O Lance Rural</h2>
                <p>Há quase uma década no mercado, o Lance Rural lançou seu aplicativo em 2020 e já conta com mais de 50 mil usuários, sendo líder em número de eventos transmitidos e audiência do segmento. Não perca nada dos maiores eventos de pecuária do país!</p>
                <ul>
                    <li><img src="<?= get_template_directory_uri() . '/assets/img/icones/tecnologia.png'?>" alt=""> Tecnologia própria</li>
                    <li><img src="<?= get_template_directory_uri() . '/assets/img/icones/timer.png'?>" alt=""> Delay mais baixo do mercado</li>
                    <li><img src="<?= get_template_directory_uri() . '/assets/img/icones/conector.png'?>" alt=""> Interação sem perder nenhum detalhe do leilão</li>
                    <li><img src="<?= get_template_directory_uri() . '/assets/img/icones/money.png'?>" alt=""> Promoção do seu evento no Canal Rural</li>
                </ul>
            </div>
        </div>
    </div>

    <?php get_template_part( 'components/content', 'banner-mini' ); ?>
</div>

<?php get_footer();?>