<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DFU_Business_Accelerator
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	wp_head();
	?>
</head>

<?php
if ( is_search() ) {
	$schematype = 'SearchResultsPage';
} elseif ( is_page() ) {
	if ( function_exists( 'get_field' ) ) {
		$schematype = get_field( 'dbacf_schema_type' );
	} else {
		$schematype = get_post_meta( get_the_ID(), 'dbacf_schema_type', true );
	}
}
if ( empty( $schematype ) ) {
	$schematype = 'WebPage';
}
$attr1 = array( 'type' => 1, 'itemscope' => 'itemscope', 'itemtype' => 'http://schema.org/' . $schematype );
$attr2 = array( 'type' => 1, 'itemscope' => 'itemscope', 'itemtype' => 'http://schema.org/WPHeader' );
?>
<body <?php body_class(); ?> <?php echo apply_filters( 'dfu_busacc_f_body_microdata', 'itemscope="' . esc_attr( $attr1['itemscope'] ) . '" itemtype="' . esc_url( $attr1['itemtype'] ) . '"' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
<?php do_action( 'wp_body_open' ); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dfu-busacc' ); ?></a>

	<header id="masthead" class="site-header" <?php echo apply_filters( 'dfu_busacc_f_header_masthead_microdata', 'itemscope="' . esc_attr( $attr2['itemscope'] ) . '" itemtype="' . esc_url( $attr2['itemtype'] ) . '"' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		$topbar = get_theme_mod( 'dba_topbar', false );
		if ( $topbar ) {
			get_template_part( 'template-parts/header/header', 'top' );
		}
		$headertype = get_theme_mod( 'dba_header_layout', 1 );
		get_template_part( 'template-parts/header/header', 'type' . $headertype );

		do_action( 'dfu_busacc_a_before_custom_header' );
		if ( is_post_type_archive() || ( is_home() && ! is_front_page() ) ) {
			$achiveposttype = get_post_type();
			if ( class_exists( 'woocommerce' ) ) {
				if ( is_archive() && ( is_product_category() || is_product_tag() || is_shop() ) ) {
					$achiveposttype = '';
				}
			}
			if ( '' != $achiveposttype && class_exists( 'DFU_Busacc_Addon' ) ) {
				if ( post_type_exists( 'post_types_info' ) ) {
					$ptiargs = array(
						'post_type'        => 'post_types_info',
						'posts_per_page'   => 1,
						'post_status'      => 'publish',
						'meta_key'         => 'dbacf_ptype',
						'meta_value'       => $achiveposttype,
						'order'            => 'DESC',
						'orderby'          => 'date',
					);
					$ptiquery = new WP_Query( $ptiargs );
					if ( $ptiquery->have_posts() ) {
						while ( $ptiquery->have_posts() ) {
							$ptiquery->the_post();
							dfu_busacc_fn_display_btm_header();
						}
						wp_reset_postdata();
					}
				}
			}
		} elseif ( is_category() || is_tag() || is_tax() ) {
			$queried_object = get_queried_object();
			dfu_busacc_fn_display_btm_header( $queried_object );
		} elseif ( ! is_search() && ! is_404() && ! is_author() ) {
			dfu_busacc_fn_display_btm_header();
		}
		do_action( 'dfu_busacc_a_after_custom_header' );
		?>

	</header><!-- #masthead -->

	<?php do_action( 'dfu_busacc_a_after_header' ); ?>
	
	<div id="content" class="site-content">
					