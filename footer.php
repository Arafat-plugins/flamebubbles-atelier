<?php
/**
 * Theme footer.
 *
 * @package FlamebubblesAtelier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$collection_configs = flamebubbles_get_collection_configs();
?>

<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__brand">
			<p class="site-footer__eyebrow"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_eyebrow' ) ); ?></p>
			<h2 class="site-footer__title"><?php bloginfo( 'name' ); ?></h2>
			<p class="site-footer__text">
				<?php echo esc_html( flamebubbles_get_theme_option( 'footer_text' ) ); ?>
			</p>
			<div class="site-footer__actions">
				<a class="button button--primary" href="<?php echo esc_url( flamebubbles_get_theme_option( 'footer_primary_url', flamebubbles_get_shop_url() ) ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_primary_label' ) ); ?></a>
				<a class="button button--ghost" href="<?php echo esc_url( flamebubbles_get_theme_option( 'footer_secondary_url', flamebubbles_get_account_url() ) ); ?>"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_secondary_label' ) ); ?></a>
			</div>
		</div>

		<div class="site-footer__menu">
			<h3 class="site-footer__heading"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_nav_heading' ) ); ?></h3>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'site-footer__list',
						'container'      => false,
					)
				);
			} else {
				echo '<ul class="site-footer__list">';
				wp_list_pages(
					array(
						'title_li' => '',
					)
				);
				echo '</ul>';
			}
			?>
		</div>

		<div class="site-footer__collections">
			<h3 class="site-footer__heading"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_collections_heading' ) ); ?></h3>
			<ul class="site-footer__list">
				<?php foreach ( $collection_configs as $config ) : ?>
					<?php $term = flamebubbles_get_product_category_by_candidates( array( $config['primary_slug'] ) ); ?>
					<li>
						<a href="<?php echo esc_url( flamebubbles_get_safe_term_link( $term ) ); ?>">
							<?php echo esc_html( $config['title'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="site-footer__widgets">
			<h3 class="site-footer__heading"><?php echo esc_html( flamebubbles_get_theme_option( 'footer_notes_heading' ) ); ?></h3>
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php else : ?>
				<div class="site-footer__widget-text">
					<p><?php echo esc_html( flamebubbles_get_theme_option( 'footer_widget_fallback' ) ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<?php dynamic_sidebar( 'footer-2' ); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="container site-footer__bottom">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php echo esc_html( flamebubbles_get_theme_option( 'footer_bottom_text' ) ); ?></p>
		<p><a href="<?php echo esc_url( flamebubbles_get_cart_url() ); ?>"><?php esc_html_e( 'Cart', 'flamebubbles-atelier' ); ?></a> / <a href="<?php echo esc_url( flamebubbles_get_shop_url() ); ?>"><?php esc_html_e( 'Shop', 'flamebubbles-atelier' ); ?></a></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
