<?php

add_action('acf/init', 'my_acf_init');

function my_acf_init() {
	
	if( function_exists('acf_add_options_page') ) {

		$option_page = acf_add_options_page(array(
			'page_title' 	=> __('Texto Institucional', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Texto Institucional', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'Texto Institucional',
		));
		
		$option_page1 = acf_add_options_page(array(
			'page_title' 	=> __('Política de Privacidade', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Política de Privacidade', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'politica-de-privacidade',
		));

		$option_page2 = acf_add_options_page(array(
			'page_title' 	=> __('Player Ao Vivo', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Player Ao Vivo', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'player-ao-vivo',
		));

		$option_page3 = acf_add_options_page(array(
			'page_title' 	=> __('Forçar Atualização', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Forçar Atualização', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'forcar-atualizacao',
		));
		
		$option_page4 = acf_add_options_page(array(
			'page_title' 	=> __('Config - Notificações', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Config - Notificações', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'config-notificacoes',
		));
		
		$option_page5 = acf_add_options_page(array(
			'page_title' 	=> __('Termos de Uso', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Termos de Uso', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'termos-de-uso',
		));
		
		$option_page5 = acf_add_options_page(array(
			'page_title' 	=> __('Publicidade', 'seox-options-portal-lance-rural-lang'),
			'menu_title' 	=> __('Publicidade', 'seox-options-portal-lance-rural-lang'),
			'menu_slug' 	=> 'publicidade',
		));
		
	}
	
}