<?php

add_action( 'init', array( 'CPT_Zee_PricingTables', 'register' ) );

/* Pricing Tables */
class CPT_Zee_PricingTables {
	static function register() {

		$labels = array(
			'name'                      => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
			'singular_name'             => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
			'menu_name'                 => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
			'all_items'                 => __( 'All Items',                 ZEETEXTDOMAIN ),
			'add_new'                   => __( 'Add New',                   ZEETEXTDOMAIN ),
			'add_new_item'              => __( 'Add New Item',              ZEETEXTDOMAIN ),
			'edit_item'                 => __( 'Edit Item',                 ZEETEXTDOMAIN ),
			'new_item'                  => __( 'New Item',                  ZEETEXTDOMAIN ),
			'view_item'                 => __( 'View Item',                 ZEETEXTDOMAIN ),
			'search_items'              => __( 'Search Items',              ZEETEXTDOMAIN ),
			'not_found'                 => __( 'No item found',             ZEETEXTDOMAIN ),
			'not_found_in_trash'        => __( 'No item found in Trash',    ZEETEXTDOMAIN )
		);

		$args = array(
			'labels'                    => $labels,
			'public'                    => true,
			'has_archive'               => false,
			'exclude_from_search'       => true,
			'menu_icon'                 => get_template_directory_uri() . '/admin/images/icon-pricing.png',
			'rewrite'                   => true,
			'capability_type'           => 'post',
			'supports'                  => array('title', 'page-attributes', 'editor', 'revisions'),
			'register_meta_box_cb'      => array( __CLASS__, 'metaboxes' )
		);

		register_post_type('zee_pricing', $args);

		register_taxonomy('cat_pricing', array('zee_pricing'), array(
			'label'                 => __('Categories', ZEETEXTDOMAIN), 
			'hierarchical'          =>    true,
			'singular_label'        => __('Category', ZEETEXTDOMAIN)
		) );
	}

	static function metaboxes() {
		$prefix = 'pricing_';
		$fields = array(

			array( 
				'label' => __('Featured', ZEETEXTDOMAIN), 
				'id'    => $prefix.'featured',
				'type'  => 'checkbox'
			),

			array( 
				'label' => __('Price', ZEETEXTDOMAIN), 
				'desc'  => __('Price with currency symbol. eg. $49', ZEETEXTDOMAIN), 
				'id'    => $prefix.'price', 
				'type'  => 'text'
			),

			array( 
				'label' => __('Price duration', ZEETEXTDOMAIN), 
				'desc'  => __('Pricing duration. eg. Moth, Day, Year etc.', ZEETEXTDOMAIN), 
				'id'    => $prefix.'duration', 
				'type'  => 'text' 
			),

			array( 
				'label' => __('Button Text', ZEETEXTDOMAIN), 
				'desc'  => __('Pricing table button text, eg. Sign up', ZEETEXTDOMAIN), 
				'id'    => $prefix.'button_text', 
				'type'  => 'text' 
			),

			array( 
				'label' => __('Button URL', ZEETEXTDOMAIN),
				'desc'  => __('Pricing table button url, eg. http://www.zeetheme.com/buy-now', ZEETEXTDOMAIN),
				'id'    => $prefix.'button_url', 
				'type'  => 'text' 
			)
		);

		new Custom_Add_Meta_Box( 'zee_pricing_box', __('Price Settings', ZEETEXTDOMAIN), $fields, 'zee_pricing', true );

	}
}

