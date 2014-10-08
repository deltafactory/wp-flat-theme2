<?php

add_action( 'init', array( 'CPT_Zee_Accordion', 'register' ) );

/* Accordion */
class CPT_Zee_Accordion {
	static function register() {

		$labels = array(
			'name'                  => __( 'Accordions',                ZEETEXTDOMAIN ),
			'singular_name'         => __( 'Accordion',                 ZEETEXTDOMAIN ),
			'menu_name'             => __( 'Accordions',                ZEETEXTDOMAIN ),
			'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
			'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
			'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
			'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
			'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
			'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
			'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
			'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
			'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
		);

		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-accordion.png',
			'rewrite'               => true,
			'capability_type'       => 'post',
			'supports'              => array('title', 'editor', 'revisions')
		);

		register_post_type('zee_accordion', $args);

		register_taxonomy('cat_accordions', array('zee_accordion'), array(
			'label'                 => __('Categories', ZEETEXTDOMAIN), 
			'hierarchical'          => true,
			'singular_label'        => __('Category',   ZEETEXTDOMAIN), 
			'rewrite'               => true
		) );
	}
}