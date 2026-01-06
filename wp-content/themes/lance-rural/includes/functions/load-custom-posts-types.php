<?php

function cptui_register_my_taxes() {
	/**
	 * Taxonomy: Categorias.
	 */
	
	$labels = array(
		"name" => __( "Categorias", "custom-post-type-ui" ),
		"singular_name" => __( "Categoria", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Categorias", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'categoria', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "categoria",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "categoria", array( "leilao", "leiloes" ), $args );

	/**
	 * Taxonomy: Tags.
	 */
	
	$labels = array(
		"name" => __( "Tags", "custom-post-type-ui" ),
		"singular_name" => __( "Tag", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Tags", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'tags', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "tags",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "tags", array( "leilao" ), $args );

}

add_action( 'init', 'cptui_register_my_taxes' );

function cptui_register_my_cpts() {

	/**
	 * Post Type: Notificações.
	 */

	$labels = [
		"name" => esc_html__( "Notificações", "fl-automator" ),
		"singular_name" => esc_html__( "Notificação", "fl-automator" ),
	];

	$args = [
		"label" => esc_html__( "Notificações", "fl-automator" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "notificacoes", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "notificacoes", $args );

	/**
	 * Post Type: Eventos.
	 */

	$labels = [
		"name" => esc_html__( "Eventos", "fl-automator" ),
		"singular_name" => esc_html__( "Evento", "fl-automator" ),
	];

	$args = [
		"label" => esc_html__( "Eventos", "fl-automator" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "eventos", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 30,
		"menu_icon" => "dashicons-calendar-alt",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "eventos", $args );

	/**
	 * Post Type: Destaques.
	 */

	$labels = [
		"name" => esc_html__( "Destaques", "fl-automator" ),
		"singular_name" => esc_html__( "Destaque", "fl-automator" ),
	];

	$args = [
		"label" => esc_html__( "Destaques", "fl-automator" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "destaque", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 32,
		"menu_icon" => "dashicons-cover-image",
		"supports" => [ "title", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "destaque", $args );

	/**
	 * Post Type: Canais.
	 */

	$labels = [
		"name" => esc_html__( "Canais", "fl-automator" ),
		"singular_name" => esc_html__( "Canal", "fl-automator" ),
	];

	$args = [
		"label" => esc_html__( "Canais", "fl-automator" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "canal", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 31,
		"menu_icon" => "dashicons-networking",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "canal", $args );

	/**
	 * Post Type: Assinaturas.
	 */

	$labels = [
		"name" => esc_html__( "Assinaturas", "fl-automator" ),
		"singular_name" => esc_html__( "Assinatura", "fl-automator" ),
		"all_items" => esc_html__( "Todas as assinaturas", "fl-automator" ),
		"add_new" => esc_html__( "Adicionar nova", "fl-automator" ),
	];

	$args = [
		"label" => esc_html__( "Assinaturas", "fl-automator" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "assinatura", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 33,
		"menu_icon" => "dashicons-money",
		"supports" => [ "title" ],
		"show_in_graphql" => false,
	];

	register_post_type( "assinatura", $args );

	/**
	 * Post Type: Lotes.
	 */
	
	$labels = array(
		"name" => __( "Lotes", "custom-post-type-ui" ),
		"singular_name" => __( "Lote", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Lotes", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "lotes", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail", "excerpt" ),
	);

	register_post_type( "lotes", $args );


	/**
	 * Leilões novo
	 */

	register_post_type( 'leiloes', array(
		'labels' => array(
			'name' => 'Leilões (novo)',
			'singular_name' => 'Leilão (novo)',
			'menu_name' => 'Leilão Novo',
			'all_items' => 'Todos os leilões',
			'edit_item' => 'Editar Leilão',
			'view_item' => 'Ver Leilão',
			'view_items' => 'Ver Leilões (novo)',
			'add_new_item' => 'Adicionar novo Leilão',
			'add_new' => 'Adicionar novo Leilão',
			'new_item' => 'Novo Leilão ',
			'parent_item_colon' => 'Leilão ascendente:',
			'search_items' => 'Pesquisar Leilão',
			'not_found' => 'Não foi possível encontrar leilão',
			'not_found_in_trash' => 'Não foi possível encontrar leilão na lixeira',
			'archives' => 'Arquivos de Leilão',
			'attributes' => 'Atributos de Leilão',
			'insert_into_item' => 'Inserir no Leilão (novo)',
			'uploaded_to_this_item' => 'Enviado para este Leilão (novo)',
			'filter_items_list' => 'Filtrar lista de Leilão',
			'filter_by_date' => 'Filtrar leilão por data',
			'items_list_navigation' => 'Navegação na lista de leilão',
			'items_list' => 'Lista de Leilão',
			'item_published' => 'Leilão publicado.',
			'item_published_privately' => 'Leilão publicado de forma privada.',
			'item_reverted_to_draft' => 'Leilão revertido para rascunho.',
			'item_scheduled' => 'Leilão agendado.',
			'item_updated' => 'Leilão atualizado.',
			'item_link' => 'Link de Leilão',
			'item_link_description' => 'Um link para um leilão.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-editor-customchar',
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'thumbnail',
			3 => 'custom-fields',
		),
		'delete_with_user' => false,
	));
}

add_action( 'init', 'cptui_register_my_cpts' );


