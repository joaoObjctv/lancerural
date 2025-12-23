<?php
    /*
        Template Name: Fale Conosco
    */
    get_header();
?>

<?php get_template_part( 'components/content', 'banner-mini' ); ?>

<br/>
<br/>

<div class="container">
    <h1 class="title">Fale Conosco</h1>

    <div class="formContact">
        <div class="formContact__info">
            <h2>Alguma <span>Dúvida?</span></h2>
            <p>Entre em contato com a equipe do Lance Rural e conecte-se às transmissões do mundo rural dentro do maior portal do agronegócio: o Canal Rural!</p>
            
            <div class="contactLink">
                <p>Não perca a oportunidade de se destacar no mercado!</p>
                <a href="tel:+55 51 98081164">
                    <img src="<?= get_template_directory_uri() . '/assets/img/icones/phone.png'?>" alt="" />
                    51 9808-1164
                </a>
                <a href="mailto:mercadoleilao@canalrural.com.br">
                    <img src="<?= get_template_directory_uri() . '/assets/img/icones/mail.png'?>" alt="" />
                    mercadoleilao@canalrural.com.br
                </a>
            </div>
        </div>

        <div class="formContact__form">
            <?php echo do_shortcode('[gravityform id="1" title="true"]'); ?>
        </div>
    </div>
    
    <div class="formSocial">
        <a href="https://www.facebook.com/830446376978552?ref=embed_page" target="_blank" >
            <img src="<?= get_template_directory_uri() . '/assets/img/facebook-follow.png'?>" alt="Bloco de seguir no FaceBook">
        </a>
        <div class="text">
            <h4>Lance Rural e você!</h4>
            <p>O Lance Rural é um site de leilões administrado pelo Canal Rural</p>
            <p>Nos acompanhe no Facebook também!</p>
        </div>
    </div>

</div>

<?php get_template_part( 'components/content', 'banner-bottom' ); ?>

<?php get_footer(); ?>
