<?php 
    /* Template Name: Home */
    get_header();
?>

<?php get_template_part( 'components/content', 'slider-auction' ); ?>

<div class="container">
    <?php if ( wp_is_mobile() ): ?>
        <?php get_template_part( 'components/content', 'schedule-auction-mobile' ); ?>
    <?php else: ?>
        <?php get_template_part( 'components/content', 'schedule-auction' ); ?>
    <?php endif; ?>

    <h2 class="title">Notícias</h2>
    <?php get_template_part( 'components/content', 'news', array('qtdNews' => 12) ); ?>

    <?php get_template_part( 'components/content', 'lance-cast' ); ?>
</div>

<?php get_template_part( 'components/content', 'banner-bottom' ); ?>

<?php get_footer();?>