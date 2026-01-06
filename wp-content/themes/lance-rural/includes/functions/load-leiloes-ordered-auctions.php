<?php 

class RestLeilaoQuery{

    /**
     * Init Method
     */
    public function __construct() {  
        add_filter( 'rest_leilao_query', array( $this, 'get_leilao_by_meta' ), 10, 2 );  
    }  

    private static $validLeiloes = null;
	private static $aovivosID = null;

	public static function create_external_data() {
		
	}

	public static function get_leiloes() {
		global $wpdb;

		$querystr = "SELECT in_term_r.object_id
        	FROM $wpdb->term_relationships in_term_r
            INNER JOIN $wpdb->term_taxonomy in_term_t
            	ON in_term_r.term_taxonomy_id = in_term_t.term_taxonomy_id 
            		AND in_term_t.taxonomy LIKE 'categoria'
            INNER JOIN $wpdb->terms in_term
            	ON in_term_t.term_id = in_term.term_id
            		AND in_term.slug = 'leilao'";

        $result = $wpdb->get_results($querystr, OBJECT);

        $ids = [];
        foreach ($result as $leilao) {
        	$ids[] = $leilao->object_id;
        }
        self::$validLeiloes = implode(",", $ids);
	}

	public static function extract_data_aovivo() {
		global $wpdb;

		$leiloes = self::$validLeiloes;
		$querystr = "SELECT p.ID,
	            p.post_author,
	            p.post_date,
	            p.post_date_gmt,
	            p.post_title,
	            p.post_excerpt,
	            p.post_status,
	            p.post_type,
	            p.post_name,
	            p.post_modified,
	            p.post_modified_gmt,
	            p.post_content_filtered,
	            p.post_parent,
	            p.menu_order,
	            p.post_mime_type,
	            p.comment_count,
	            term.slug as leilao_status
			FROM $wpdb->posts p
            JOIN $wpdb->term_relationships term_r
            	ON p.ID = term_r.object_id
            JOIN $wpdb->term_taxonomy term_t
            	ON term_r.term_taxonomy_id = term_t.term_taxonomy_id 
	            	AND term_t.taxonomy LIKE 'aovivo_destaque'
            JOIN $wpdb->terms term
            	ON term_t.term_id = term.term_id
	            	AND term.slug LIKE 'ao-vivo'
            WHERE p.post_type LIKE 'leilao'
	            AND p.post_status LIKE 'publish'
            	AND p.ID IN ( $leiloes )";

        $result = $wpdb->get_results($querystr, OBJECT);

        $ids = [];
        foreach ($result as &$leilao) {
        	$leilao->guid = get_the_permalink($leilao->ID);
        	$leilao->image = get_the_post_thumbnail_url($leilao->ID, 'medium');
        	$transmissao = get_post_meta($leilao->ID, 'live_streming');
        	if ($transmissao && !empty($transmissao)) {
        		$leilao->transmissao = $transmissao[0];
        	}
        	$abertura = get_post_meta($leilao->ID, 'data_hora_de_abertura');
        	if ($abertura && !empty($abertura)) {
        		$leilao->abertura = $abertura[0];
        	}
        	$local = get_post_meta($leilao->ID, 'local');
        	if ($local && !empty($local)) {
        		$leilao->local = $local[0];
        	}
        	$programa = get_post_meta($leilao->ID, 'programa');
        	if ($programa && !empty($programa)) {
        		$leilao->programa = $programa[0];
        	}
        	$ids[] = $leilao->ID;
        }

        self::$aovivosID = implode(",", $ids);

        if (!$result) {
        	return "[]";
        }
        return json_encode($result);
	}

	public static function extract_data_leiloes() {
		global $wpdb;

		$leiloes = self::$validLeiloes;
		$aovivos = self::$aovivosID;
		$aovivos = ($aovivos && $aovivos != "") ? "AND p.ID NOT IN ( $aovivos )" : "";
		
		$querystr = "
			SELECT wp.* 
			FROM(
				SELECT p.ID,
		            p.post_author,
		            p.post_date,
		            p.post_date_gmt,
		            p.post_title,
		            p.post_excerpt,
		            p.post_status,
		            p.post_type,
		            p.post_name,
		            p.post_modified,
		            p.post_modified_gmt,
		            p.post_content_filtered,
		            p.post_parent,
		            p.menu_order,
		            p.post_mime_type,
		            p.comment_count,
		            max(case when term.slug = 'destaque' then term.slug end) leilao_status,
		            max(case when meta.meta_key = 'data_hora_de_abertura' then meta.meta_value end) abertura,
					max(case when meta.meta_key = 'data_hora_de_fechamento' then meta.meta_value end) fechamento,
					max(case when meta.meta_key = 'local' then meta.meta_value end) local,
					max(case when meta.meta_key = 'programa' then meta.meta_value end) programa
				FROM $wpdb->posts p
				JOIN $wpdb->postmeta meta
					ON p.ID = meta.post_id
						AND (
							(meta.meta_key = 'data_hora_de_abertura')
							OR
							(meta.meta_key = 'data_hora_de_fechamento')
							OR
							(meta.meta_key = '_thumbnail_id')
							OR
							(meta.meta_key = 'local')
							OR
							(meta.meta_key = 'programa')
						)
	            JOIN $wpdb->term_relationships term_r
	            	ON p.ID = term_r.object_id
	            JOIN $wpdb->term_taxonomy term_t
	            	ON term_r.term_taxonomy_id = term_t.term_taxonomy_id
	            JOIN $wpdb->terms term
	            	ON term_t.term_id = term.term_id
	    		
	            WHERE p.post_type LIKE 'leilao'
	            	AND p.post_status LIKE 'publish'
	            	AND p.ID IN ( $leiloes )
	            	$aovivos

	        	GROUP BY p.ID
	        	ORDER BY leilao_status DESC, abertura
	        ) AS wp 
	        WHERE wp.abertura >= CONVERT_TZ(NOW(),'+00:00','-03:00') AND wp.fechamento > CONVERT_TZ(NOW(),'+00:00','-03:00') LIMIT 10";

        $result = $wpdb->get_results($querystr, OBJECT);

        $ids = [] ;
        foreach ($result as &$leilao) {
        	$ids[] = $leilao->ID;
        }

        return $ids ;
	}

           
    /**
     * Order by meta
     *
     * @param array $args - Args da request
     * @param object $request - Request atual.
     * @return array
     */
    public function get_leilao_by_meta( $args, $request ) {
        $sort_by_date = $request->get_param( 'sort_by_data_hora_de_abertura' );  

        if( $sort_by_date == 'true' ) {

            self::get_leiloes();
            $json_aovivo = self::extract_data_aovivo();
            $json_leiloes = self::extract_data_leiloes();
            
            $args = array(
                'post_type' => 'leilao',
                'post__in' => $json_leiloes,
            );

            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'data_hora_de_abertura';
            $args['order'] = 'ASC';
            		
        }
        return $args; 
    }
}

new RestLeilaoQuery();