<?php

add_action( 'init', array( 'CPT_Zee_Team', 'register' ) );

// Post type:  Team
class CPT_Zee_Team {

	static function register() {
		$labels = array(
			'name'                  => __( 'Team',                      ZEETEXTDOMAIN ),
			'singular_name'         => __( 'Team',                      ZEETEXTDOMAIN ),
			'menu_name'             => __( 'Team',                      ZEETEXTDOMAIN ),
			'all_items'             => __( 'Team Members',              ZEETEXTDOMAIN ),
			'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
			'add_new_item'          => __( 'Add New Member',            ZEETEXTDOMAIN ),
			'edit_item'             => __( 'Edit Member',               ZEETEXTDOMAIN ),
			'new_item'              => __( 'New Member',                ZEETEXTDOMAIN ),
			'view_item'             => __( 'View Member',               ZEETEXTDOMAIN ),
			'search_items'          => __( 'Search Member',             ZEETEXTDOMAIN ),
			'not_found'             => __( 'No Member found',           ZEETEXTDOMAIN ),
			'not_found_in_trash'    => __( 'No Member found in Trash',  ZEETEXTDOMAIN )
		);

		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-team.png',
			'rewrite'               => true,
			'capability_type'       => 'post',
			'supports'              => array('title', 'editor', 'thumbnail'),
			'register_meta_box_cb'  => array( __CLASS__, 'metaboxes' )
		);

		register_post_type('zee_team', $args);
	}

	static function metaboxes() {

		// team metaboxes

		$prefix = 'team_';

		$fields = array(

			array( 
				'label' => __('Designation',                    ZEETEXTDOMAIN), 
				'id'    => $prefix.'designation',
				'type'  => 'text'
			),

			array( 
				'label' => __('Facebook',                       ZEETEXTDOMAIN), 
				'desc'  => __('Facebook link of team member',   ZEETEXTDOMAIN), 
				'id'    => $prefix.'facebook', 
				'type'  => 'text'
			),

			array( 
				'label' => __('Twitter', ZEETEXTDOMAIN), 
				'desc'  => __('Twitter link of team member',    ZEETEXTDOMAIN), 
				'id'    => $prefix.'twitter', 
				'type'  => 'text'
			),

			array( 
				'label' => __('Google Plus', ZEETEXTDOMAIN), 
				'desc'  => __('Google Plus link of team member', ZEETEXTDOMAIN), 
				'id'    => $prefix.'gplus', 
				'type'  => 'text'
			),

			array( 
				'label' => __('Pinterest', ZEETEXTDOMAIN), 
				'desc'  => __('Pinterest link of team member',   ZEETEXTDOMAIN), 
				'id'    => $prefix.'pinterest', 
				'type'  => 'text'
			),

			array( 
				'label' => __('Linkedin', ZEETEXTDOMAIN), 
				'desc'  => __('Linkedin link of team member',    ZEETEXTDOMAIN), 
				'id'    => $prefix.'linkedin', 
				'type'  => 'text'
			)
		);

		new Custom_Add_Meta_Box( 'zee_team_box', __('Team Social Settings', ZEETEXTDOMAIN), $fields, 'zee_team', true );
	}
}