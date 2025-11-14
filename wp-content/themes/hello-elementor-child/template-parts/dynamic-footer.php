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


<!-- 💬 Modale Partecipo-->
<div class="modal fade" id="PartecipoModal" tabindex="-1" aria-labelledby="PartecipoLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">

			<div class="modal-header close" data-bs-dismiss="modal" aria-label="Chiudi">
				<i class="fa fas fa-close"> </i>
			</div>

			<div class="modal-body body-partecipa">

				<div class="rsvp-header">
					<h2>R.S.V.P.</h2>
					<h3>Compili il modulo per confermare la sua presenza.</h3>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/separe.svg" alt="Logo"
						class="mb-5 mt-4" style="max-width: 220px;">
				</div>

				<?php echo do_shortcode('[iscrizione_evento]'); ?>

			</div>

			<!-- 
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-danger">Conferma</button>
			</div> 
			-->

		</div>
	</div>
</div>


<!-- 💬 Modale  NON PARTECIPO-->
<div class="modal fade" id="nonPartecipoModal" tabindex="-1" aria-labelledby="nonPartecipoLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">

			<div class="modal-header close" data-bs-dismiss="modal" aria-label="Chiudi">
				<i class="fa fas fa-close"> </i>
			</div>

			<div class="modal-body body-partecipa modal-body-close">

				<div class="hide-after">
					<h2>R.S.V.P.</h2>
					<h3>Compili il modulo per confermare la sua assenza.</h3>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/separe.svg" alt="Logo"
						class="mb-5 mt-4" style="max-width: 220px;">
				</div>

				<?php echo do_shortcode('[iscrizione_evento_non_partecipa]'); ?>

			</div>

		</div>
	</div>
</div>



<footer id="site-footer" class="site-footer dynamic-footer <?php echo esc_attr($footer_class); ?>">
	<div class="footer-inner gap-4 gap-md-0">

		<div class="w-100">

			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-white.svg" alt="Logo"
				class="logo-footer mb-4">

			<div class="d-flex flex-wrap">

				<div class="col-12 col-md-7">
					<p class="small mb-2">Info</p>
					<p class="small mb-0">
						<a class="salve" href="mailto:ardianchristmascocktail@nextgroup.eu" style="text-decoration: underline;"
							target="_blank">ardianchristmascocktail@nextgroup.eu</a>
					</p>
				</div>

				<!-- <div class="col-12 col-md-5 mt-2 mt-md-0 text-left text-md-end">
					<p class="small mb-2">
						<a href="#" style="text-decoration: underline;" target="_blank">Privacy Policy</a>
					</p>
					<p class="small mb-0">
						<a href="#" style="text-decoration: underline;" target="_blank">Cookie Policy</a>
					</p>
				</div> -->


			</div>
		</div>

	</div>
</footer>