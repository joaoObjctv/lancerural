<?php 

add_action('rest_api_init', 'register_rest_images' );

function register_rest_images(){
    register_rest_field( array('leilao','post'),
        'imagem_original',
        array(
            'get_callback'    => 'get_rest_featured_imagem_original',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( array('leilao','post'),
        'imagem_medium',
        array(
            'get_callback'    => 'get_rest_featured_imagem_medium',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( array('leilao','post'),
        'imagem_thumbnail',
        array(
            'get_callback'    => 'get_rest_featured_imagem_thumbnail',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    
    register_rest_field( array('leilao','post'),
        'imagem_large',
        array(
            'get_callback'    => 'get_rest_featured_imagem_large',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_rest_field( array('leilao','post'),
        'imagem_medium_large',
        array(
            'get_callback'    => 'get_rest_featured_imagem_medium_large',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    
}

function get_rest_featured_imagem_original( $object, $field_name, $request) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}

function get_rest_featured_imagem_medium( $object, $field_name, $request) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_url( $object['featured_media'], 'medium');
        return $img;
    }
    return false;
}

function get_rest_featured_imagem_thumbnail( $object, $field_name, $request) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_url( $object['featured_media'], 'thumbnail');
        return $img;
    }
    return false;
}

function get_rest_featured_imagem_large( $object, $field_name, $request) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_url( $object['featured_media'], 'large');
        return $img;
    }
    return false;
}

function get_rest_featured_imagem_medium_large( $object, $field_name, $request) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_url( $object['featured_media'], 'medium_large');
        return $img;
    }
    return false;
}
