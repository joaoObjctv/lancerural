<?php
    /*
        Template Name: Noticias
    */

    get_header();
?>
<?php get_template_part( 'components/content', 'slider-auction' ); ?>

<div class="container">
    <?php get_template_part( 'components/content', 'news', array('paged' => 1, 'qtdNews' => 12, 'offSetNews' => 0, 'showBtn' => 'none') ); ?>

   <?php get_template_part( 'components/content', 'banner-mini' ); ?>

    <br />
    <br />

    <?php get_template_part( 'components/content', 'news', array('paged' => 1, 'qtdNews' => 12, 'offSetNews' => 12, 'showBtn' => 'none', 'side' => 'row-reverse') ); ?>
</div>

 <div class="container">
    <div class="lastNews">
        <div id="lista-news" class="d-grid"></div>
    </div>
   
    <div class="seeMore">
        <a href="#" id="load-more" class="btn" data-page="0">Carregar mais</a>
    </div>
</div>

<?php get_template_part( 'components/content', 'banner-bottom' ); ?>



<?php get_footer(); ?>
