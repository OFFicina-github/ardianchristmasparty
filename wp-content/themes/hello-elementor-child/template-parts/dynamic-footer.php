<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$is_editor = isset($_GET['elementor-preview']);
$site_name = get_bloginfo('name');
$tagline = get_bloginfo('description', 'display');
$footer_class = did_action('elementor/loaded') ? hello_get_footer_layout_class() : '';
$footer_nav_menu = wp_nav_menu([
	'theme_location' => 'menu-2',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
]);

$menu_args = [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
];
$footer_nav_menu = wp_nav_menu($menu_args);
?>



<footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr($footer_class); ?>">
	<div class="footer-inner">

		<!-- Colonna 1: Logo + testi -->
		<div class="col-12 col-md-4">

		</div>

		<!-- Colonna 2: Menu WordPress -->
		<div class="col-12 col-md-4 my-5 my-md-0">
			<!-- <?php if ($footer_nav_menu): ?>
				<?php
				echo $footer_nav_menu;
				?>
			<?php endif; ?> -->
		</div>

		<!-- Colonna 3: Lorem ipsum -->
		<div class="col-12 col-md-4">


			<div class="social-footer">

			</div>
		</div>

	</div>
</footer>