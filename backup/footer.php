<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DFU_Business_Accelerator
 */

?>

	</div><!-- #content -->

	<?php
	do_action( 'dfu_busacc_a_before_footer' ); 
	$attr = array( 'type' => 1, 'itemscope' => 'itemscope', 'itemtype' => 'http://schema.org/WPFooter' );
	?>

	<footer id="footer" class="site-footer" <?php echo apply_filters( 'dfu_busacc_f_footer_microdata', 'itemscope="' . esc_attr( $attr['itemscope'] ) . '" itemtype="' . esc_url( $attr['itemtype'] ) . '"' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		get_template_part( 'template-parts/footer/footer', 'top' );
		do_action( 'dfu_busacc_a_between_footers' );
		get_template_part( 'template-parts/footer/footer', 'bottom' );
		?>
	</footer><!-- #footer -->

	<div id="sticky-footer">
	<?php
	$btngrad = get_theme_mod( 'dba_btn_grad', false );
	if ( $btngrad ) {
		$btnbgcolor = get_theme_mod( 'dba_btn_first' );
	} else {
		$btndefault = array(
			'text'  => '#f0f1f2',
			'htext' => '#fcfcfc',
			'bg'    => '#0088cc',
			'hbg'   => '#006191',
		);
		$btncol = get_theme_mod( 'dba_button', $btndefault );
		$btnbgcolor = $btncol['bg'];
	}
	$ctype = dfu_busacc_fn_colourcheck( $btnbgcolor );
	$showbacktotop = get_theme_mod( 'dba_show_backtotop', false );
	$iconbgcolor = ( 'lt' == $ctype ? 'dk' : 'lt' );
	if ( true === $showbacktotop ) {
		?>
		<!-- Search button -->
		<div id="dba-sticky-backtotop" class="pt-1">
			<a class="btn rounded-circle dba-icon" href="#" data-toggle="modal" title="<?php esc_attr_e( 'Back to top', 'dfu-busacc' ); ?>">
				<?php
				if ( true == get_theme_mod( 'dba_load_fa', true ) ) {
				?>
					<?php echo wp_kses_post( apply_filters( 'dfu_busacc_f_backtotop_faicon', '<i class="fas fa-angle-double-up fa-fw"></i>' ) ); ?>
				<?php
				} else {
				?>
					<?php echo wp_kses_post( apply_filters( 'dfu_busacc_f_backtotop_icon', '<span class="iconmoon-' . $iconbgcolor .' ico-arrow-up"></span>' ) ); ?>
				<?php
				}
				?>
				<span class="sr-only">Back to top</span>
			</a>
		</div>
	<?php
	}
	$showsearch = get_theme_mod( 'dba_show_search', false );
	if ( true === $showsearch ) {
	?>
		<!-- Search button -->
		<div id="dba-sticky-search" class="pt-1">
			<a class="btn rounded-circle dba-icon" href="#searchModal" data-toggle="modal" title="<?php esc_attr_e( 'Search on site', 'dfu-busacc' ); ?>">
				<?php
				if ( true == get_theme_mod( 'dba_load_fa', true ) ) {
				?>
					<?php echo wp_kses_post( apply_filters( 'dfu_busacc_f_search_faicon', '<i class="fas fa-search fa-fw"></i>' ) ); ?>
				<?php
				} else {
				?>
					<?php echo wp_kses_post( apply_filters( 'dfu_busacc_f_search_icon', '<span class="iconmoon-' . $iconbgcolor . ' ico-search"></span>' ) ); ?>
				<?php
				}
				?>
				<span class="sr-only">Search</span>
			</a>
		</div>
	<?php
	}
	if ( class_exists( 'woocommerce' ) ) {
		dfu_busacc_fn_wc_bottomcart( $iconbgcolor );
	}
	?>
	</div><!-- sticky-footer -->

	<!-- Search modal -->
	<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModelTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="searchModelTitle">Search</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="py-3">
						<?php
						$searchtxt = '<p>' . esc_html__( 'Enter text below for search', 'dfu-busacc' ) . '</p>';
						echo apply_filters( 'dfu_busacc_f_modal_search_text', $searchtxt ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo get_search_form( false );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div><!-- #page -->

<?php
wp_footer();
?>

</body>
</html>
