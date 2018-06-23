<?php
add_action( 'cmb2_admin_init', 'umbala_base_metaboxes');

if( !function_exists('umbala_base_metaboxes') ) {
	function umbala_base_metaboxes() {
		$prefix = 'alus_';

		$umbala_default_sidebars = umbala_get_list_sidebars();
		$sidebar_options = array();
		foreach( $umbala_default_sidebars as $key => $_sidebar ){
			$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
		}

		$cmb = new_cmb2_box( array(
			'id'        		 => 'page_options',
			'title'      		=> esc_html__( 'Page options', 'umbala' ),
			'object_types'      => array( 'page'),
			'context'    		=> 'normal',
			'priority'   		=> 'high',
			'show_names' 		=> true,
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'layout'
			,'name'		=> esc_html__('Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'default'	=> 'default'
			,'options'	=> array(
				'default'  	=> esc_html__('Default', 'umbala'),
				'full-width' => esc_html__('Full width', 'umbala'), 
				'boxed' => esc_html__('Boxed', 'umbala') ,
				'wide' => esc_html__('Wide (1600 px)', 'umbala') 
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'page_layout'
			,'name'		=> esc_html__('Page Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				'full-width'  => esc_html__('Fullwidth', 'umbala')
				,'left-sidebar' => esc_html__('Left Sidebar', 'umbala')
				,'right-sidebar' => esc_html__('Right Sidebar', 'umbala')
				,'left-right-sidebar' => esc_html__('Left & Right Sidebar', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'left_sidebar'
			,'name'		=> esc_html__('Left Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'right_sidebar'
			,'name'		=> esc_html__('Right Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'header_top_bar'
			,'name'		=> esc_html__('Hide Top bar', 'umbala')
			,'desc'		=> esc_html__('Choose to hide top bar.', 'umbala')
			,'type'		=> 'checkbox'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'header_layout'
			,'name'	=> esc_html__('Header Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio'
			,'options'	=> array(
				'default'  	=> esc_html__('Default', 'umbala')
				,'layout1'  		=> esc_html__('Header Layout 1', 'umbala')
				,'layout2' 		=> esc_html__('Header Layout 2', 'umbala')
				,'layout3' 		=> esc_html__('Header Layout 3', 'umbala')
				,'layout4' 		=> esc_html__('Header Layout 4', 'umbala')
			)
		) );	

		$cmb->add_field( array(
			'id'		=> $prefix.'logo'
			,'name'	=> esc_html__('Logo', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'file'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'header_text_color'
			,'name'	=> esc_html__('Header Text Color', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				'default'	=> esc_html__('Default', 'umbala')
				,'dark'	=> esc_html__('Dark', 'umbala')
				,'light'	=> esc_html__('Light', 'umbala')
			)
		) );

		$menus = array('0' => esc_html__('Default', 'umbala'));
		$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		if( is_array($nav_terms) ){
			foreach( $nav_terms as $term ){
				$menus[$term->term_id] = $term->name;
			}
		}

		$cmb->add_field( array(
			'id'		=> $prefix.'menu_id'
			,'name'		=> esc_html__('Primary Menu', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $menus
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'page_title'
			,'name'		=> esc_html__('Hide page title', 'umbala')
			,'desc'		=> esc_html__('Yes, please', 'umbala')
			,'type'		=> 'checkbox'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'breadcrumbs'
			,'name'		=> esc_html__('Hide breadcrumb', 'umbala')
			,'desc'		=> esc_html__('Yes, please', 'umbala')
			,'type'		=> 'checkbox'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'breadcrumb_layout'
			,'name'	=> esc_html__('Breadcrumb Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> array(
				'default'  	=> esc_html__('Default', 'umbala')
				,'layout1'  		=> esc_html__('Breadcrumb Layout 1', 'umbala')
				,'layout2' 		=> esc_html__('Breadcrumb Layout 2', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'bg_breadcrumbs'
			,'name'	=> esc_html__('Breadcrumb Background Image', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'file'
		) );			

		$revolution_exists = class_exists('RevSliderSlider');

		$page_sliders = array();
		$page_sliders[0] = esc_html__('No Slider', 'umbala');
		if( $revolution_exists ){
			$page_sliders['revslider']	= esc_html__('Revolution Slider', 'umbala');
		}

		$cmb->add_field( array(
			'id'		=> $prefix.'page_slider'
			,'name'	=> esc_html__('Page Slider', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> $page_sliders
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'page_slider_position'
			,'name'	=> esc_html__('Page Slider Position', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> array(
				'before_header'			=> esc_html__('Before Header', 'umbala')
				,'before_main_content'	=> esc_html__('Before Main Content', 'umbala')
			)
			,'default'	=> 'before_main_content'
		) );

		if( $revolution_exists ){
			$revsliders = array();
			$revsliders[0] = esc_html__('Select a slider', 'umbala');
			if ( function_exists( 'rev_slider_shortcode' ) ) {
				$slider_object = new RevSliderSlider();
				$sliders_array = $slider_object->getArrSliders();
				if ( $sliders_array ) {
					foreach ( $sliders_array as $slider ) {
						$revsliders[ $slider->getAlias() ] = $slider->getTitle();
					}
				}
			}

			$cmb->add_field( array(
				'id'		=> $prefix.'rev_slider'
				,'name'	=> esc_html__('Select Revolution Slider', 'umbala')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $revsliders
			) );
		}

		if( !class_exists('AluraStudio_Demo') ){			
			$footer_blocks = array('0' => '');

			$args = array(
				'post_type'			=> 'alus_footer'
				,'post_status'	 	=> 'publish'
				,'posts_per_page' 	=> -1
			);

			$posts = new WP_Query($args);

			if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
				foreach( $posts->posts as $p ){
					$footer_blocks[$p->ID] = $p->post_title;
				}
			}

			$cmb->add_field( array(
				'id'		=> $prefix.'footer_top'
				,'name'	=> esc_html__('Footer Top', 'umbala')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $footer_blocks
			) );

			$cmb->add_field( array(
				'id'		=> $prefix.'footer_middle'
				,'name'	=> esc_html__('Footer Middle', 'umbala')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $footer_blocks
			) );

			$cmb->add_field( array(
				'id'		=> $prefix.'footer_bottom'
				,'name'	=> esc_html__('Footer Bottom', 'umbala')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $footer_blocks
			) );

		}
		$cmb = new_cmb2_box( array(
			'id'        		 => 'post_options',
			'title'      		=> esc_html__( 'Post options', 'umbala' ),
			'object_types'      => array( 'post'),
			'context'    		=> 'normal',
			'priority'   		=> 'high',
			'show_names' 		=> true,
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_layout'
			,'name'	=> esc_html__('Post Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				''			=> esc_html__('Default', 'umbala')
				,'full-width'  	=> esc_html__('Fullwidth', 'umbala')
				,'left-sidebar' 	=> esc_html__('Left Sidebar', 'umbala')
				,'right-sidebar' 	=> esc_html__('Right Sidebar', 'umbala')
				,'left-right-sidebar' 	=> esc_html__('Left & Right Sidebar', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_left_sidebar'
			,'name'	=> esc_html__('Left Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_right_sidebar'
			,'name'	=> esc_html__('Right Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'bg_breadcrumbs'
			,'name'	=> esc_html__('Breadcrumb Background Image', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'file'
			,'desc'		=> esc_html__('Enter Breadcrumb Background Image URL', 'umbala')
			,'allow' => array( 'url', 'attachment' ) 
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_sharing'
			,'name'		=> esc_html__('Hide Social Share Box', 'umbala')
			,'desc'		=> esc_html__('Choose to hide the post social share box.', 'umbala')
			,'type'		=> 'checkbox'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_related_posts'
			,'name'		=> esc_html__('Hide Related Post', 'umbala')
			,'desc'		=> esc_html__('Choose to hide related posts on this post.', 'umbala')
			,'type'		=> 'checkbox'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'blog_details_comment_form'
			,'name'		=> esc_html__('Hide Comment Form', 'umbala')
			,'desc'		=> esc_html__('Choose to hide the post comment area.', 'umbala')
			,'type'		=> 'checkbox'
		) );	

		$cmb->add_field( array(
			'id'		=> $prefix.'audio_url'
			,'name'		=> esc_html__('Audio URL:', 'umbala')
			,'desc'		=> esc_html__('Enter MP3, OGG, WAV file URL or SoundCloud URL (for audio post format).', 'umbala')
			,'type'		=> 'oembed'
		) );			

		$cmb->add_field( array(
			'id'		=> $prefix.'video_url'
			,'name'		=> esc_html__('Video URL:', 'umbala')
			,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL (for video post format).', 'umbala')
			,'type'		=> 'oembed'
		) );

		$cmb = new_cmb2_box( array(
			'id'        		 => 'post_gallery',
			'title'      		=> esc_html__( 'Post Gallery', 'umbala' ),
			'object_types'      => array( 'post'),
			'context'    		=> 'side',
			'priority'   		=> 'low',
			'show_names' 		=> true,
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'gallery'
			,'name'	=> ''
			,'desc'		=> ''
			,'type'		=> 'file_list'
		) );

		$cmb = new_cmb2_box( array(
			'id'        		 => 'brand_options',
			'title'      		=> esc_html__( 'Brand Options', 'umbala' ),
			'object_types'      => array( 'alus_brand'),
			'context'    		=> 'normal',
			'priority'   		=> 'high',
			'show_names' 		=> true,
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'brand_url'
			,'name'	=> esc_html__('Brand URL', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'text'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'brand_target'
			,'name'	=> esc_html__('Target', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> array(
				'_self'		=> esc_html__('Self', 'umbala')
				,'_blank'	=> esc_html__('New Window Tab', 'umbala')
			)
		) );	

		$cmb = new_cmb2_box( array(
			'id'        		 => 'product_options',
			'title'      		=> esc_html__( 'Product Options', 'umbala' ),
			'object_types'      => array( 'product'),
			'context'    		=> 'normal',
			'priority'   		=> 'high',
			'show_names' 		=> true,
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_layout'
			,'name'	=> esc_html__('Product Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				''			=> esc_html__('Default', 'umbala')
				,'full-width'  	=> esc_html__('Fullwidth', 'umbala')
				,'left-sidebar' 	=> esc_html__('Left Sidebar', 'umbala')
				,'right-sidebar' 	=> esc_html__('Right Sidebar', 'umbala')
				,'left-right-sidebar' 	=> esc_html__('Left & Right Sidebar', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_left_sidebar'
			,'name'	=> esc_html__('Left Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_right_sidebar'
			,'name'	=> esc_html__('Right Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'bg_breadcrumbs'
			,'name'	=> esc_html__('Breadcrumb Background Image', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'file'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_related'
			,'name'		=> esc_html__('Hide Related Product', 'umbala')
			,'desc'		=> esc_html__('Choose to hide related product on this product.', 'umbala')
			,'type'		=> 'checkbox'
			,'default'	=> 0
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_thumbnails_style'
			,'name'	=> esc_html__('Product Thumbnail Style', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				''				=> esc_html__('Default', 'umbala')
				,'vertical'      => esc_html__('Vertical', 'umbala')
				,'horizontal'   => esc_html__('Horizontal', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'show_size_chart'
			,'name'	=> esc_html__('Show Size Chart', 'umbala')
			,'desc'		=> esc_html__('Show Size Chart', 'umbala')
			,'type'		=> 'radio_inline'
			,'options'	=> array(
				'1'		=> esc_html__('Show', 'umbala')
				,'0'	=> esc_html__('Hide', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_size_chart'
			,'name'	=> esc_html__('Size Chart Image', 'umbala')
			,'desc'		=> esc_html__('You can upload size chart image for product', 'umbala')
			,'type'		=> 'file'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_custom_tab'
			,'name'	=> esc_html__('Custom Tab', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> array(
				'0'		=> esc_html__('Default', 'umbala')
				,'1'	=> esc_html__('Override', 'umbala')
			)
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_custom_tab_title'
			,'name'	=> esc_html__('Custom Tab Title', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'text'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_custom_tab_content'
			,'name'	=> esc_html__('Custom Tab Content', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'textarea'
		) );

		$cmb->add_field( array(
			'id'		=> $prefix.'prod_video_url'
			,'name'	=> esc_html__('Video URL', 'umbala')
			,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'umbala')
			,'type'		=> 'text'
		) );			
	}
}

add_filter('cmb2_admin_init', 'umbala_categories_metaboxes');

if( ! function_exists( 'umbala_categories_metaboxes' ) ) {
	function umbala_categories_metaboxes() {
		
		$umbala_default_sidebars = umbala_get_list_sidebars();
		$sidebar_options = array();
		foreach( $umbala_default_sidebars as $key => $_sidebar ){
			$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
		}

		$cmb_term = new_cmb2_box( array( 
			'id'               => 'product_cat_options', 
			'title'            => esc_html__( 'Category Metabox', 'umbala' ),
			'object_types'     => array( 'term' ),
			'taxonomies'       => array( 'product_cat' ),
		) ); 

		$cmb_term->add_field( array(
			'id'          => 'bg_breadcrumbs_id',
			'name'        => esc_html__('Breadcrumbs Background Image', 'umbala'),
			'desc' 		=> esc_html__( 'Upload an image or enter an URL.', 'umbala'),
			'type' 		=> 'file',
			'allow' 	=> array( 'url', 'attachment' )
		) );

		$cmb_term->add_field( array(
			'id'		=> 'layout'
			,'name'	=> esc_html__('Category Layout', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> array(
				''			=> esc_html__('Default', 'umbala')
				,'full-width'  	=> esc_html__('Fullwidth', 'umbala')
				,'left-sidebar' 	=> esc_html__('Left Sidebar', 'umbala')
				,'right-sidebar' 	=> esc_html__('Right Sidebar', 'umbala')
				,'left-right-sidebar' 	=> esc_html__('Left & Right Sidebar', 'umbala')
			)
		) );

		$cmb_term->add_field( array(
			'id'		=> 'left_sidebar'
			,'name'		=> esc_html__('Left Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

		$cmb_term->add_field( array(
			'id'		=> 'right_sidebar'
			,'name'		=> esc_html__('Right Sidebar', 'umbala')
			,'desc'		=> ''
			,'type'		=> 'select'
			,'options'	=> $sidebar_options
		) );

	}
}

add_filter('cmb2_admin_init', 'umbala_color_metaboxes');

if( ! function_exists( 'umbala_color_metaboxes' ) ) {
	function umbala_color_metaboxes() {

		$cmb_term = new_cmb2_box( array( 
			'id'               => 'product_color_attr', 
			'title'            => esc_html__( 'Color Metabox', 'umbala' ),
			'object_types'     => array( 'term' ),
			'taxonomies'       => array( 'pa_color'),
		) ); 

		$cmb_term->add_field( array(
			'id'          => 'color_color',
			'name'        => esc_html__('Color', 'umbala'),
			'desc' 		  => '',
			'type' 		  => 'colorpicker',
		) );

		$cmb_term->add_field( array(
			'id'		=> 'color_image',
			'name'		=> esc_html__('Thumbnail Image', 'umbala'),
			'desc'		=> '',
			'type'		=> 'file'
		) );
		
	}
}

?>