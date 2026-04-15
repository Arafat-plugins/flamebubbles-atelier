<?php
/**
 * Theme header.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_home_header = is_front_page();
$is_product_header = function_exists( 'is_product' ) && is_product();
$show_home_nav  = (bool) flamebubbles_get_theme_option( 'home_show_primary_nav', true );
$home_action_1  = array(
	'label' => flamebubbles_get_theme_option( 'home_action_one_label' ),
	'url'   => flamebubbles_get_theme_option( 'home_action_one_url', home_url( '/#collections' ) ),
);
$home_action_2  = array(
	'label' => flamebubbles_get_theme_option( 'home_action_two_label' ),
	'url'   => flamebubbles_get_theme_option( 'home_action_two_url', flamebubbles_get_cart_url() ),
);
$show_home_cart_count = untrailingslashit( $home_action_2['url'] ) === untrailingslashit( flamebubbles_get_cart_url() );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'flamebubbles-atelier' ); ?></a>

<header class="site-header <?php echo $is_home_header ? 'site-header--home' : ''; ?> <?php echo $is_product_header ? 'site-header--product' : ''; ?>">
	<div class="container site-header__inner">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<div class="site-header__logo"><?php the_custom_logo(); ?></div>
			<?php else : ?>
				<a class="site-header__brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="site-header__mark" aria-hidden="true">*</span>
					<span class="site-header__title"><?php bloginfo( 'name' ); ?></span>
				</a>
			<?php endif; ?>

			<?php if ( get_bloginfo( 'description' ) && ! $is_home_header ) : ?>
				<p class="site-header__tagline"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
		</div>

		<button class="site-header__toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-navigation">
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'flamebubbles-atelier' ); ?></span>
			<span></span>
			<span></span>
		</button>

		<div class="site-header__panel" data-menu-panel>
			<?php if ( ! $is_product_header && ( ! $is_home_header || $show_home_nav ) ) : ?>
				<nav id="site-navigation" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'flamebubbles-atelier' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-nav__menu',
								'container'      => false,
							)
						);
					} else {
						wp_page_menu(
							array(
								'menu_class' => 'primary-nav__menu',
								'show_home'  => true,
							)
						);
					}
					?>
				</nav>
			<?php endif; ?>

			<div class="header-actions">
				<a class="header-actions__link <?php echo $is_home_header ? 'header-actions__link--soft' : ''; ?>" href="<?php echo esc_url( $is_home_header ? $home_action_1['url'] : flamebubbles_get_account_url() ); ?>">
					<?php echo esc_html( $is_home_header ? $home_action_1['label'] : __( 'Account', 'flamebubbles-atelier' ) ); ?>
				</a>
				<a class="header-actions__link header-actions__link--cart <?php echo $is_home_header ? 'header-actions__link--home-cta' : ''; ?>" href="<?php echo esc_url( $is_home_header ? $home_action_2['url'] : flamebubbles_get_cart_url() ); ?>">
					<?php echo esc_html( $is_home_header ? $home_action_2['label'] : __( 'Bag', 'flamebubbles-atelier' ) ); ?>
					<?php if ( ! $is_home_header || $show_home_cart_count ) : ?>
						<span class="header-actions__count">
							<?php
							if ( flamebubbles_is_woocommerce_active() && function_exists( 'WC' ) && WC()->cart ) {
								echo esc_html( WC()->cart->get_cart_contents_count() );
							} else {
								echo '0';
							}
							?>
						</span>
					<?php endif; ?>
				</a>
			</div>
		</div>
	</div>
</header>
