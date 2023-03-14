<?php
/**
 * Five Ten functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Five_Ten
 */

if ( ! defined( 'FIVETEN__VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'FIVETEN__VERSION', '0.1.0' );
}

if ( ! function_exists( 'fiveten__setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fiveten__setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Five Ten, use a find and replace
		 * to change 'fiveten' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fiveten', get_template_directory() . '/languages' );

		// Add default RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		// Disable/remove Comments feed(s)
		add_filter( 'feed_links_show_comments_feed', '__return_false' );
		add_filter( 'post_comments_feed_link', '__return_false' );


		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title-element in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-main' => __( 'Primary', 'fiveten' ),
				'menu-footer' => __( 'Footer Menu', 'fiveten' ),
			)
		);

		/*
		 * Switch default core markup for search form, etc
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'fiveten__setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fiveten__widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'fiveten' ),
			'id'            => 'widgets-footer',
			'description'   => __( 'Add widgets here to appear in your footer.', 'fiveten' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fiveten__widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fiveten__scripts() {
	wp_enqueue_style( 'fiveten-style', get_stylesheet_uri(), array(), FIVETEN__VERSION );
	wp_enqueue_script( 'fiveten-script', get_template_directory_uri() . '/js/script.min.js', array(), FIVETEN__VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'fiveten__scripts' );


/**
 * Add the block editor class to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function fiveten__tinymce_add_class( $settings ) {
	$settings['body_class'] = 'block-editor-block-list__layout';
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'fiveten__tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Disable comments
 */
require get_template_directory() . '/inc/disable-comments.php';

/**
 * Disable WP-Emoji
 */
require get_template_directory() . '/inc/disable-emoji.php';

// Remove unwanted SVG filter injections
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
