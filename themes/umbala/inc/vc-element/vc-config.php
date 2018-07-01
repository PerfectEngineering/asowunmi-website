<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Add VC Param */

$umbala_bg_parallax = array(
	'type' 			=> 'checkbox'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Parallax', 'umbala')
	,'param_name' 	=> 'umbala_bg_parallax'
	,'value' 		=> array( esc_html__( 'Yes, please', 'umbala' ) => 1 )
	,'group'		=> esc_html__('Background Options', 'umbala')
	,'description' 	=> esc_html__('Add Background Image on Design Options', 'umbala')
);
vc_add_param( 'vc_row', $umbala_bg_parallax );
vc_add_param( 'vc_section', $umbala_bg_parallax );
vc_add_param( 'vc_column', $umbala_bg_parallax );

$umbala_bg_position = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Background Position', 'umbala' ),
	'param_name' => 'umbala_bg_position',
	'group' => esc_html__( 'Background Options', 'umbala' ),
	'value' => array(
		esc_html__( 'None', 'umbala' ) => ''
		,esc_html__( 'Left top', 'umbala' ) => 'left-top'
		,esc_html__( 'Left center', 'umbala' ) => 'left-center'
		,esc_html__( 'Left bottom', 'umbala' ) => 'left-bottom'
		,esc_html__( 'Right top', 'umbala' ) => 'right-top'
		,esc_html__( 'Right center', 'umbala' ) => 'right-center'
		,esc_html__( 'Right bottom', 'umbala' ) => 'right-bottom'
		,esc_html__( 'Center top', 'umbala' ) => 'center-top'
		,esc_html__( 'Center center', 'umbala' ) => 'center-center'
		,esc_html__( 'Center bottom', 'umbala' ) => 'center-bottom'
	),
);
vc_add_param( 'vc_row', $umbala_bg_position );
vc_add_param( 'vc_section', $umbala_bg_position );
vc_add_param( 'vc_column', $umbala_bg_position );

if( ! function_exists( 'umbala_vc_classes' ) ) {

	if( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) ) {
		add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'umbala_vc_classes', 30, 3 );
	}

	function umbala_vc_classes( $class, $base, $atts ) {
		
		if( ! empty( $atts['umbala_bg_parallax'] ) ) {
			$class .= ' alus-prlx-background';
		}
		if( ! empty( $atts['umbala_bg_position'] ) ) {
			$class .= ' alus-bg-' . $atts['umbala_bg_position'];
		}
		return $class;
	}
}

/* Remove VC Param */
vc_remove_param('vc_row', 'parallax');
vc_remove_param('vc_row', 'parallax_image');
vc_remove_param('vc_row', 'parallax_speed_bg');
vc_remove_param('vc_tta_accordion', 'style');
vc_remove_param('vc_tta_accordion', 'shape');
vc_remove_param('vc_tta_accordion', 'color');
vc_remove_param('vc_tta_accordion', 'no_fill');
vc_remove_param('vc_tta_accordion', 'spacing');
vc_remove_param('vc_tta_accordion', 'gap');
vc_remove_param('vc_tta_accordion', 'c_align');
vc_remove_param('vc_tta_accordion', 'c_position');
vc_remove_param('vc_tta_tour', 'style');
vc_remove_param('vc_tta_tour', 'shape');
vc_remove_param('vc_tta_tour', 'color');
vc_remove_param('vc_tta_tour', 'spacing');
vc_remove_param('vc_tta_tour', 'gap');
vc_remove_param('vc_tta_tour', 'no_fill_content_area');
vc_remove_param('vc_tta_tour', 'controls_size');
vc_remove_param('vc_tta_tour', 'pagination_style');
vc_remove_param('vc_tta_tour', 'pagination_color');
vc_remove_param('vc_tta_tour', 'alignment');
vc_remove_param('vc_tta_tabs', 'shape');
vc_remove_param('vc_tta_tabs', 'style');
vc_remove_param('vc_tta_tabs', 'color');
vc_remove_param('vc_tta_tabs', 'alignment');
vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
vc_remove_param('vc_tta_tabs', 'spacing');
vc_remove_param('vc_tta_tabs', 'gap');
vc_remove_param('vc_tta_tabs', 'pagination_style');
vc_remove_param('vc_tta_tabs', 'pagination_color');
?>