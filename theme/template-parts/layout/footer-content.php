<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Five_Ten
 */

?>

<footer id="colophon" data-dev-component-name="Footer">

	<?php if ( is_active_sidebar( 'widgets-footer' ) ) : ?>
		<aside role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'fiveten' ); ?>">
			<?php dynamic_sidebar( 'widgets-footer' ); ?>
		</aside>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'menu-footer' ) ) : ?>
		<nav aria-label="<?php esc_attr_e( 'Footer Menu', 'fiveten' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'menu_class'     => 'footer-menu',
					'depth'          => 1,
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<div>
		<?php
		$fiveten__blog_info = get_bloginfo( 'name' );
		if ( ! empty( $fiveten__blog_info ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
			<?php
		endif;

		/* translators: 1: WordPress link, 2: WordPress. */
		printf(
			'<a href="%1$s" rel="external">powered by %2$s</a>.',
			esc_url( __( 'https://wordpress.org/', 'fiveten' ) ),
			'WordPress'
		);
		?>
	</div>

</footer><!-- #colophon -->
