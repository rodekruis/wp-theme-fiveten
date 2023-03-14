<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Five_Ten
 */

?>

<header id="masthead" data-dev-component-name="Header">

	<div data-dev-component-name="Logo">
		<?php
		if ( is_front_page() ) :
			?>
			<h1><?php bloginfo( 'name' ); ?></h1>
			<?php
		else :
			?>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

		$fiveten__description = get_bloginfo( 'description', 'display' );
		if ( $fiveten__description || is_customize_preview() ) :
			?>
			<p><?php echo $fiveten__description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
	</div>

	<nav
		id="site-navigation"
		aria-label="<?php esc_attr_e( 'Main Navigation', 'fiveten' ); ?>"
		data-dev-component-name="Menu"
	>
		<button
			type="button"
			aria-controls="primary-menu"
			aria-expanded="false"
		><?php esc_html_e( 'Primary Menu', 'fiveten' ); ?></button>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-main',
				'menu_id'        => 'primary-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
			)
		);
		?>
	</nav><!-- #site-navigation -->

</header><!-- #masthead -->
