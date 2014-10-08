<?php

add_action( 'init', array( 'CPT_Zee_Testimonial', 'register' ) );

/* Testimonial */
class CPT_Zee_Testimonial {
	static function register() {
		$labels = array(
			'name'                  => __( 'Testimonials',              ZEETEXTDOMAIN ),
			'singular_name'         => __( 'Testimonial',               ZEETEXTDOMAIN ),
			'menu_name'             => __( 'Testimonials',              ZEETEXTDOMAIN ),
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
			'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-testimonial.png',
			'capability_type'       => 'post',
			'supports'              => array('title', 'editor'),
			'register_meta_box_cb'  => array( __CLASS__, 'metaboxes' )

		);

		register_post_type('zee_testimonial', $args);

	}

	static function metaboxes() {

		$prefix = 'testimonial_';

		$fields = array(
			array( 
				'label' => __('Designation', ZEETEXTDOMAIN), 
				'id'    => $prefix.'designation',
				'type'  => 'text'
			)
		);

		new Custom_Add_Meta_Box( 'zee_testimonial_meta', __('Testimonial Settings', ZEETEXTDOMAIN), $fields, 'zee_testimonial', true );
	}
}