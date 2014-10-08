<?php
/** 
* Post type: Portfolio
*/

add_action( 'init', array( 'CPT_Zee_Portfolio', 'register' ) );

class CPT_Zee_Portfolio {

	static function register() {
		$labels = array(
			'name'                      => __( 'Portfolio',                         ZEETEXTDOMAIN ),
			'singular_name'             => __( 'Portfolio',                         ZEETEXTDOMAIN ),
			'menu_name'                 => __( 'Portfolios',                        ZEETEXTDOMAIN ),
			'all_items'                 => __( 'All Portfolios',                    ZEETEXTDOMAIN ),
			'add_new'                   => __( 'Add New',                           ZEETEXTDOMAIN ),
			'add_new_item'              => __( 'Add New Portfolio',                 ZEETEXTDOMAIN ),
			'edit_item'                 => __( 'Edit Portfolio',                    ZEETEXTDOMAIN ),
			'new_item'                  => __( 'New Portfolio',                     ZEETEXTDOMAIN ),
			'view_item'                 => __( 'View Portfolio',                    ZEETEXTDOMAIN ),
			'search_items'              => __( 'Search Portfolios',                 ZEETEXTDOMAIN ),
			'not_found'                 => __( 'No Portfolio item found',           ZEETEXTDOMAIN ),
			'not_found_in_trash'        => __( 'No Portfolio item found in Trash',  ZEETEXTDOMAIN )
		);

		$args = array(
			'labels'                        => $labels,
			'public'                        => true,
			'has_archive'                   => false,
			'exclude_from_search'           => true,
			'menu_icon'                     => get_template_directory_uri() . '/admin/images/icon-portfolio.png',
			'rewrite'                       => array( 'slug' => 'portfolio'),
			'capability_type'               => 'post',
			'supports'                      => array('title', 'editor', 'thumbnail', 'revisions')
		);

		register_post_type('zee_portfolio', $args);

		register_taxonomy('cat_portfolio', array('zee_portfolio'), array(
			'label'                     => __('Categories',             ZEETEXTDOMAIN), 
			'hierarchical'              => false,
			'singular_label'            => __('Portfolio Categories',   ZEETEXTDOMAIN), 
			'rewrite'                   => true
		) );
	}
}
