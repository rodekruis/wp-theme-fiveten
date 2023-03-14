<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Five_Ten
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fiveten__pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fiveten__pingback_header' );

/**
 * Filters the default archive titles.
 */
function fiveten__get_the_archive_title() {
	if ( is_category() ) {
		$title = __( 'Category Archives: ', 'fiveten' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'fiveten' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'fiveten' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'fiveten' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'fiveten' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'fiveten' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'fiveten' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'fiveten' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'fiveten' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'fiveten' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'fiveten' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'fiveten__get_the_archive_title' );

/**
 * Determines if post thumbnail can be displayed.
 */
function fiveten__can_show_post_thumbnail() {
	return apply_filters( 'fiveten__can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns the size for avatars used in the theme.
 */
function fiveten__get_avatar_size() {
	return 60;
}

/**
 * Create the continue reading link
 */
function fiveten__continue_reading_link() {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'fiveten' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="visually-hidden">"', '"</span>', false )
		);

		return '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'fiveten__continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'fiveten__continue_reading_link' );
