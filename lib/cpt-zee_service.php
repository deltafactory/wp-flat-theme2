<?php


/* Service  */
add_action('init', array( 'CPT_Zee_Service', 'register' ) );

class CPT_Zee_Service {

	static function register() {

		$labels = array(
			'name'                  => __( 'Services',                  ZEETEXTDOMAIN ),
			'singular_name'         => __( 'Service',                   ZEETEXTDOMAIN ),
			'menu_name'             => __( 'Services',                  ZEETEXTDOMAIN ),
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
			'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-services.png',
			'rewrite'               => true,
			'capability_type'       => 'post',
			'supports'              => array('title', 'page-attributes', 'editor'),
			'register_meta_box_cb'  => array( __CLASS__, 'metaboxes' )
		);
		register_post_type('zee_service', $args);

		register_taxonomy('cat_service', array('zee_service'), array(
			'label'                 => __('Categories', ZEETEXTDOMAIN), 
			'hierarchical'          =>    true,
			'singular_label'        => __('Category',   ZEETEXTDOMAIN)
		) );

	}

	static function metaboxes() {

		$prefix = 'service_';
		$fields = array(

			array( 
				'label' => __('Icon', ZEETEXTDOMAIN), 
				'id'    => $prefix.'icon',
				'type'  => 'icons',
				'options'=>$fontawesome_icons
			),

			array( 
				'label' => __('Icon Color', ZEETEXTDOMAIN), 
				'id'    => $prefix.'color',
				'type'  => 'color'
			)
		);

		new Custom_Add_Meta_Box( 'zee_service_box', __('Styling Options', ZEETEXTDOMAIN), $fields, 'zee_service', true );
	}
}

