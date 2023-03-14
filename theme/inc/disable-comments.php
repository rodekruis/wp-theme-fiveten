<?php
/**
 * Configuration to disable all use of comments
 *
 * @package Five_Ten
 */

add_action( 'admin_init', function () {
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php') {
			wp_safe_redirect(admin_url());
			exit;
	}

	// Remove comments metabox from dashboard
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

	// Disable support for comments and trackbacks in post types
	foreach ( get_post_types() as $post_type ) {
			if (post_type_supports( $post_type, 'comments' )) {
					remove_post_type_support( $post_type, 'comments' );
					remove_post_type_support( $post_type, 'trackbacks' );
			}
	}
} );

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
} );

// Remove comments links from admin bar
add_action( 'init', function () {
	if (is_admin_bar_showing()) {
			remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
} );

// Close comments on the front-end
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments
add_filter( 'comments_array', '__return_empty_array', 10, 2 );


// Disable Feeds for Comments
function fiveten__disable_comments_feed( $comments ) {
	if( $comments ) {
		wp_die( 'Feeds for comments are disabled.', 410 );
	}
}
add_action( 'do_feed', 'fiveten__disable_comments_feed', 1 );
add_action( 'do_feed_rdf', 'fiveten__disable_comments_feed', 1 );
add_action( 'do_feed_rss', 'fiveten__disable_comments_feed', 1 );
add_action( 'do_feed_rss2', 'fiveten__disable_comments_feed', 1 );
add_action( 'do_feed_atom', 'fiveten__disable_comments_feed', 1 );
