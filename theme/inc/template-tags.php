<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Five_Ten
 */

if ( ! function_exists( 'fiveten__posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function fiveten__posted_on() {
		$time_string = '<time datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time datetime="%1$s">%2$s</time><time datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'fiveten__posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function fiveten__posted_by() {
		printf(
			/* translators: 1: posted by label, only visible to screen readers. 2: author link. 3: post author. */
			'<span class="visually-hidden">%1$s</span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
			esc_html__( 'Posted by', 'fiveten' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'fiveten__entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories and tags.
	 */
	function fiveten__entry_meta() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by.
			fiveten__posted_by();

			// Posted on.
			fiveten__posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'fiveten' ) );
			if ( $categories_list ) {
				printf(
					/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
					'<span class="visually-hidden">%1$s</span>%2$s',
					esc_html__( 'Posted in', 'fiveten' ),
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'fiveten' ) );
			if ( $tags_list ) {
				printf(
					/* translators: 1: tags label, only visible to screen readers. 2: list of tags. */
					'<span class="visually-hidden">%1$s</span>%2$s',
					esc_html__( 'Tags:', 'fiveten' ),
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="visually-hidden">%s</span>', 'fiveten' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
	}
endif;

if ( ! function_exists( 'fiveten__entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories and tags.
	 */
	function fiveten__entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by.
			fiveten__posted_by();

			// Posted on.
			fiveten__posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'fiveten' ) );
			if ( $categories_list ) {
				printf(
					/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
					'<span class="visually-hidden">%1$s</span>%2$s',
					esc_html__( 'Posted in', 'fiveten' ),
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'fiveten' ) );
			if ( $tags_list ) {
				printf(
					/* translators: 1: tags label, only visible to screen readers. 2: list of tags. */
					'<span class="visually-hidden">%1$s</span>%2$s',
					esc_html__( 'Tags:', 'fiveten' ),
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="visually-hidden">%s</span>', 'fiveten' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
	}
endif;

if ( ! function_exists( 'fiveten__post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views
	 */
	function fiveten__post_thumbnail() {
		if ( ! fiveten__can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure>
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
		else :
			?>

			<figure>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
				</a>
			</figure>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'fiveten__the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function fiveten__the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( 'Newer posts', 'fiveten' ),
				'next_text' => __( 'Older posts', 'fiveten' ),
			)
		);
	}
endif;
