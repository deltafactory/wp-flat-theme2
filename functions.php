<?php

//Defined Textdomain
define('ZEETEXTDOMAIN', wp_get_theme()->get( 'TextDomain' ));
define('ZEETHEMENAME', wp_get_theme()->get( 'Name' ));
define('TEMPLATE_DIR', get_template_directory() );

// metaboxes directory constant
define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/admin/metaboxes' );

// Content width 

if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

FlatTheme::setup();

class FlatTheme {
	static function setup() {
		self::includes();

		self::register_sidebars();
		self::register_nav_menus();
		self::register_post_types();

		add_action( 'after_setup_theme',            array( __CLASS__, 'after_setup_theme' )               );

		// decativate default gallery css
		// @todo: Turn into optional feature.
		add_filter( 'use_default_gallery_style',    '__return_false' );

		add_filter( 'wp_get_attachment_link',       array( __CLASS__, 'wp_get_attachment_link' )  , 10, 5 );
		add_filter( 'wp_title',                     array( __CLASS__, 'wp_title' )                , 10, 2 );

		/* This probably never really loads...
		if ( is_singular() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
		}
		*/

		if ( is_admin() ) :

		// adding scripts at admin panel
		add_action( 'admin_enqueue_scripts',        array( __CLASS__, 'admin_enqueue_scripts' )           );
		add_filter( 'mce_buttons',                  array( __CLASS__, 'mce_buttons' ) );

		endif;
	}

	static function includes() {
		require( TEMPLATE_DIR . '/admin/fontawesome-icons.php');
		require( TEMPLATE_DIR . '/admin/css-color-classes.php');
		require( TEMPLATE_DIR . '/admin/themeoptions/functions/googlefonts.php');
		require( TEMPLATE_DIR . '/admin/shortcodes/tinymce.button.php');
		require( TEMPLATE_DIR . '/admin/metaboxes/meta_box.php');
		require( TEMPLATE_DIR . '/admin/themeoptions/index.php');
		require( TEMPLATE_DIR . '/lib/shortcodes.php');
		require( TEMPLATE_DIR . '/lib/theme-functions.php');
		require( TEMPLATE_DIR . '/lib/navwalker.php');
		require( TEMPLATE_DIR . '/lib/mobile-navwalker.php');
		require( TEMPLATE_DIR . '/lib/widgets.php');

		require( TEMPLATE_DIR . '/lib/pluggable.php' );

		require( TEMPLATE_DIR . '/admin/plugin-setup.php');
	}

	static function register_nav_menus() {

		// Register menu areas
		register_nav_menus( array(
			'primary'   => __('Primary', ZEETEXTDOMAIN),
			'footer'    => __('Footer', ZEETEXTDOMAIN)
		) );

	}

	static function register_sidebars() {

		register_sidebar(array(
			'name' => __( 'Sidebar', ZEETEXTDOMAIN ),
			'id' => 'sidebar',
			'description' => __( 'Widgets in this area will be shown on right side.', ZEETEXTDOMAIN ),
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'before_widget' => '<div>',
			'after_widget' => '</div>'
		) );

		register_sidebar(array(
			'name' => __( 'Bottom', ZEETEXTDOMAIN ),
			'id' => 'bottom',
			'description' => __( 'Widgets in this area will be shown before Footer.' , ZEETEXTDOMAIN),
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'before_widget' => '<div class="col-sm-3 col-xs-6">',
			'after_widget' => '</div>'
		) );
	}

	static function register_post_types() {
		require( TEMPLATE_DIR . '/lib/cpt-zee_slider.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_team.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_portfolio.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_pricingtables.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_faq.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_service.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_tab.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_accordion.php' );
		require( TEMPLATE_DIR . '/lib/cpt-zee_testimonial.php' );
	}

	static function after_setup_theme() {
		// load textdomain
		load_theme_textdomain(ZEETEXTDOMAIN, get_template_directory() . '/languages');

		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'video' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );

	}

	static function admin_enqueue_scripts() {
		wp_enqueue_script( 'zee_admin_js', get_template_directory_uri() . '/admin/js/admin.js', false, '1.0.0' );
	}

	static function wp_get_attachment_link( $content, $id, $size, $permalink ) {

		// adding prettyPhoto each gallery item
		if( !$permalink ){
			$content = preg_replace("/<a/","<a rel=\"prettyPhoto[gallery]\"",$content,1); // >
			return $content;
		}
	}

	//  Set title
	static function wp_title( $title, $sep ) {

		global $paged, $page;

		if ( is_feed() ){
			return $title;
		}

		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description and ( is_home() or is_front_page() ) ){
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', ZEETEXTDOMAIN ), max( $paged, $page ) );
		}

		return $title;
	}

	// add shortcode tinymce button
	static function mce_buttons( $mce_buttons ) {
		$pos = array_search('wp_more', $mce_buttons, true);

		if ($pos !== false) {
			$buttons = array_slice($mce_buttons, 0, $pos + 1);
			$buttons[] = 'wp_page';    
			$mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
		}

		return $mce_buttons;
	}

} // class FlatTheme


/**
 * Getting post thumbnail url
 * @param  [int]                $pots_ID [Post ID]
 * @return [string]             [Return thumbail source url]
 */
function zee_get_thumb_url($pots_ID){
    return wp_get_attachment_url( get_post_thumbnail_id( $pots_ID ) );
}
