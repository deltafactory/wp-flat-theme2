<?php

// Post type: Sliders

add_action( 'init', array( 'CPT_ZeeSlider', 'register' ) );

class CPT_Zee_Slider {

	static function register() {

		$labels = array(
			'name'                  => __( 'Slider',                ZEETEXTDOMAIN ),
			'singular_name'         => __( 'Slider',                ZEETEXTDOMAIN ),
			'menu_name'             => __( 'Sliders',               ZEETEXTDOMAIN ),
			'all_items'             => __( 'All Sliders',           ZEETEXTDOMAIN ),
			'add_new'               => __( 'Add New',               ZEETEXTDOMAIN ),
			'add_new_item'          => __( 'Add New Slider',        ZEETEXTDOMAIN ),
			'edit_item'             => __( 'Edit Slider',           ZEETEXTDOMAIN ),
			'new_item'              => __( 'New Slider',            ZEETEXTDOMAIN ),
			'view_item'             => __( 'View Slider',           ZEETEXTDOMAIN ),
			'search_items'          => __( 'Search Portfolios',     ZEETEXTDOMAIN ),
			'not_found'             => __( 'No item found',         ZEETEXTDOMAIN ),
			'not_found_in_trash'    => __( 'No item found in Trash',ZEETEXTDOMAIN )
		);

		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-slider.png',
			'rewrite'               => true,
			'capability_type'       => 'post',
			'supports'              => array('title', 'page-attributes', 'editor', 'thumbnail'),
			'register_meta_box_cb'  => array( __CLASS__, 'metaboxes' )
		);

		register_post_type('zee_slider', $args);
	}

	static function metaboxes() {

		// slider metaboxes

		$prefix = 'slider_';
		$fields = array(
			array( 
				'label'                     => __('Background Image',          ZEETEXTDOMAIN),
				'desc'                      => __('Show background image in slider', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'background_image',
				'type'                      => 'image'
			),

			array( 
				'label'                     => __('Button Text',          ZEETEXTDOMAIN),
				'desc'                      => __('Show Slider Button and Button Text', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'button_text',
				'type'                      => 'text'
			),

			array( 
				'label'                     => __('Button URL',       ZEETEXTDOMAIN),
				'desc'                      => __('Slider URL link.', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'button_url',
				'type'                      => 'text'
			),

			array( 
				'label'                     => __('Boxed Style',       ZEETEXTDOMAIN),
				'desc'                      => __('Show boxed Style.', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'boxed',
				'type'                      => 'select',
				'options'                   => array(

					array(
						'value'=>'no',
						'label'=>__('No', ZEETEXTDOMAIN)
					),   

					array(
						'value'=>'yes',
						'label'=>__('Yes', ZEETEXTDOMAIN)
					)
				)
			),

			array( 
				'label'                     => __('Position',       ZEETEXTDOMAIN),
				'desc'                      => __('Show slider Position.', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'position',
				'type'                      => 'select',
				'options'                   => array(

					array(
						'value'=>'left',
						'label'=>__('Left', ZEETEXTDOMAIN)
					),

					array(
						'value'=>'center',
						'label'=>__('Center', ZEETEXTDOMAIN)
					),

					array(
						'value'=>'right',
						'label'=>__('Right', ZEETEXTDOMAIN)
					),
				)
			)
		);

		$fields_video = array(
			array( 
				'label'                     => __('Video Type',       ZEETEXTDOMAIN),
				'desc'                      => __('Select video type.', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'video_type',
				'type'                      => 'radio',
				'options'                   => array(

					array(
						'value'=>'',
						'label'=>__('None', ZEETEXTDOMAIN)
					),

					array(
						'value'=>'youtube',
						'label'=>__('Youtube', ZEETEXTDOMAIN)
					),   

					array(
						'value'=>'vimeo',
						'label'=>__('Vimeo', ZEETEXTDOMAIN)
					)
				)
			),

			array( 
				'label'                     => __('Video Link',          ZEETEXTDOMAIN),
				'desc'                      => __('Video link', ZEETEXTDOMAIN), 
				'id'                        => $prefix . 'video_link',
				'type'                      => 'text'
			), 
		);

		new Custom_Add_Meta_Box( 'zee_slider_box', __('Slider Settings', ZEETEXTDOMAIN), $fields, 'zee_slider', true );
		new Custom_Add_Meta_Box( 'zee_slider_box_video', __('Video Settings', ZEETEXTDOMAIN), $fields_video, 'zee_slider', true );

	}

}
