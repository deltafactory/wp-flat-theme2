<?php

// Add custom metabox to Page admin.

add_action( 'init', array( 'CPT_Page', 'register' ) );

class CPT_Page {
	static function register() {
		if ( is_admin() ) {
			self::metaboxes();
		}
	}

	static function metaboxes() {
		// page subtitle

		$prefix = 'page_';
		$fields = array(
			array( 
				'label' => __('Subtitle', ZEETEXTDOMAIN), 
				'id'    => $prefix.'subtitle',
				'type'  => 'text'
			) 
		);

		new Custom_Add_Meta_Box( 'zee_page_box', __('Subtitle Options', ZEETEXTDOMAIN), $fields, 'page', true );
	}
}