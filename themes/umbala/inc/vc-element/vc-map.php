<?php 
add_action( 'vc_before_init', 'umbala_integrate_with_vc' );
function umbala_integrate_with_vc() {
	
	if( !function_exists('vc_map') ){
		return;
	}

	/* Content Shortcodes */

	/* Shortcode Section Title */
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Section Title', 'umbala' ),
		'base' 		=> 'alus_section_title',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		'icon'      => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'umbala' )
				,'param_name' 	=> 'style'
				,'description' 	=> ''
				,'std' 			=> 'icon'
				,'value' 		=> array(
					esc_html__( 'Default', 'umbala' ) => 'default',
					esc_html__( 'Bordered', 'umbala' ) => 'bordered',
				)
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Before Title', 'umbala' )
				,'param_name' 	=> 'before_title'
				,'value' 		=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Sub Title Description', 'umbala' )
				,'param_name' 	=> 'subtitle_des'
				,'value' 		=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title Tag', 'umbala' )
				,'param_name' 	=> 'title_tag'
				,'description' 	=> ''
				,'value' 		=> array(
					'span','div','h1','h2','h3','h4','h5','h6'
				)
			)			
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Font-Size Title', 'umbala' )
				,'param_name' 	=> 'font_size_title'
				,'value' 		=> ''
				,'description' 	=> 'Ex:30'
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Font-Weight', 'umbala' )
				,'param_name' 	=> 'font_weight_title'
				,'description' 	=> ''
				,'value' 		=> array(
					'100','200','300','400','500','600','700','800','900'
				)
				,'std'			=> '500'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class name', 'umbala' )
				,'param_name' 	=> 'extra_class'
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );

	/* Shortcode Mega Menu */
	$menu_dropdown = array();
	$menus = wp_get_nav_menus();
	foreach ( $menus as $menu ) {
		$menu_dropdown[$menu->name] = $menu->term_id;
	}
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Mega Menu Widget', 'umbala' ),
		'base' 		=> 'alus_mega_menu_wg',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'All Categories'
				,'description' 	=> ''
			)
			,array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Menu', 'umbala' ),
				'param_name' => 'nav_menu',
				'admin_label' 	=> true,
				'value' => $menu_dropdown
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class name', 'umbala' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );

	/* Shortcode Team Member */
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Team Member', 'umbala' ),
		'base' 		=> 'alus_team_member',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'User Avatar', 'umbala' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'umbala' )
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Style', 'umbala' )
				,'param_name' 	=> 'style_img'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Default', 'umbala')	=> 'default'
					,esc_html__('Circle', 'umbala')		=> 'circle'
				)
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Name', 'umbala' )
				,'param_name' 	=> 'name'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'CEO / FOUNDER'
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'umbala' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__(' Meta position', 'umbala')
				,'param_name' 	=> 'position'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('On Meta', 'umbala')	=> 'meta'
					,esc_html__('On Thumbnail', 'umbala')		=> 'thumbnail'
				)
				,'description' 	=> ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Social buttons style', 'umbala' ),
				'param_name' => 'icon_style',
				'value' => array(
					esc_html__( 'Colored', 'umbala' ) => 'colored',
					esc_html__( 'Bordered', 'umbala' ) => 'bordered',
					esc_html__( 'Small', 'umbala' ) => 'small'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Facebook link', 'umbala' ),
				'param_name' => 'facebook'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Twitter link', 'umbala' ),
				'param_name' => 'twitter'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Google+ link', 'umbala' ),
				'param_name' => 'google_plus'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Linkedin link', 'umbala' ),
				'param_name' => 'linkedin'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Dribbble link', 'umbala' ),
				'param_name' => 'dribbble'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Instagram link', 'umbala' ),
				'param_name' => 'instagram'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pinterest link', 'umbala' ),
				'param_name' => 'pinterest'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Rss link', 'umbala' ),
				'param_name' => 'rss'
			)
			,array(
				'type' 			=> 'textarea_html'
				,'heading' 		=> esc_html__( 'Text', 'umbala' )
				,'param_name' 	=> 'content'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'umbala' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('New Window Tab', 'umbala')	=>  '_blank'
					,esc_html__('Self', 'umbala')			=>  '_self'	
				)
				,'description' 	=> ''
			)
		)
	) );

	/* Shortcode Mailchimp Subscription */
	$mc_forms = umbala_get_mailchimp_forms();
	$mc_form_option = array('' => '');
	foreach( $mc_forms as $mc_form ){
		$mc_form_option[$mc_form['title']] = $mc_form['id'];
	}
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Mailchimp Subscription', 'umbala' ),
		'base' 		=> 'alus_mailchimp_subscription',
		'class' 	=> '',
		'category' 	=> esc_html__('Alura-Studio', 'umbala'),
		'icon'      => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Form', 'umbala' )
				,'param_name' 	=> 'form'
				,'admin_label' 	=> true
				,'value' 		=> $mc_form_option
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'Newsletter'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Intro Text', 'umbala' )
				,'param_name' 	=> 'intro_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'umbala' )
				,'param_name' 	=> 'bg_image'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Style', 'umbala' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Default', 'umbala')	=> 'text-default'
					,esc_html__('Light', 'umbala')		=> 'text-light'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'umbala' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Style 1', 'umbala')	=> 'style-1'
					,esc_html__('Style 2', 'umbala')	=> 'style-2'
					,esc_html__('Style 3', 'umbala')	=> 'style-3'
				)
				,'description' 	=> ''
			)
		)
	) );

	/* Shortcode Instagram Feed */
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Instagram Feed', 'umbala' ),
		'base' 		=> 'alus_instagram',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'Instagram'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'umbala' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)			
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number', 'umbala' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '9'
				,'description' 	=> ''
			)			
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Column', 'umbala' )
				,'param_name' 	=> 'column'
				,'admin_label' 	=> true
				,'value' 		=> '3'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Size', 'umbala' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Large', 'umbala')	=> 'large'
					,esc_html__('Thumbnail', 'umbala')	=> 'thumbnail'
					,esc_html__('Small', 'umbala')	=> 'small'
					,esc_html__('Original', 'umbala')	=> 'original'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'umbala' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Current window', 'umbala')	=> '_self'
					,esc_html__('New window', 'umbala')		=> '_blank'
				)
				,'description' 	=> ''
			)		
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'umbala' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> true
				,'value' 		=> '12'
				,'description' 	=> ''
			)
		)
	) );

	/* Shortcode Features Box */
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Feature Box', 'umbala' ),
		'base' 		=> 'alus_feature',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'umbala' )
				,'param_name' 	=> 'icon_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('FontAwesome', 'umbala')		=>  'icon'
					,esc_html__('Image', 'umbala')		=>  'image'	
				)
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Icon class', 'umbala' )
				,'param_name' 	=> 'class_icon'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Use FontAwesome. Ex: fa-home', 'umbala')
				,'dependency'  	=> array('element' => 'icon_style', 'value' => array('icon'))
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Icon position', 'umbala' )
				,'param_name' 	=> 'icon_position'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Top', 'umbala')		=>  'top'
					,esc_html__('Center', 'umbala')		=>  'center'
					,esc_html__('Left', 'umbala')		=>  'left'	
					,esc_html__('Right', 'umbala')		=>  'right'
				)
				,'std'			=> 'center'
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'icon_style', 'value' => array('icon'))
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Thumbnail', 'umbala' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'icon_style', 'value' => array('image'))
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Style', 'umbala' )
				,'param_name' 	=> 'image_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Default', 'umbala')		=>  'default'
					,esc_html__('Overlay', 'umbala')		=>  'overlay'
					,esc_html__('Label', 'umbala')		=>  'feature-label'	
					,esc_html__('Vertical', 'umbala')		=>  'feature-vertical'
				)
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'icon_style', 'value' => array('image'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feature title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Short description', 'umbala' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'umbala' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'umbala' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('New Window Tab', 'umbala')	=>  '_blank'
					,esc_html__('Self', 'umbala')			=>  '_self'	
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'umbala' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** Shortcode Blogs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'Alus Blogs', 'umbala' ),
		'base' 		=> 'alus_blogs',
		'class' 	=> '',
		'category' 	=> 'Alura-Studio',
		"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Blog title', 'umbala' )
				,'param_name' 	=> 'blog_title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Blog Layout', 'umbala' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Grid', 'umbala')		=> 'grid'
					,esc_html__('Slider', 'umbala')	=> 'slider'
					,esc_html__('Masonry', 'umbala')	=> 'masonry'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'umbala' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(1,2,3,4)
				,'std'			=> '3'
				,'description' 	=> esc_html__( 'Number of Columns', 'umbala' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'umbala' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Posts', 'umbala' )
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Categories', 'umbala' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> umbala_get_categories_blog_checkbox()
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'umbala' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('None', 'umbala')		=> 'none'
					,esc_html__('ID', 'umbala')			=> 'ID'
					,esc_html__('Date', 'umbala')		=> 'date'
					,esc_html__('Name', 'umbala')		=> 'name'
					,esc_html__('Title', 'umbala')		=> 'title'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'umbala' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Descending', 'umbala')		=> 'DESC'
					,esc_html__('Ascending', 'umbala')		=> 'ASC'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show post title', 'umbala' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show thumbnail', 'umbala' )
				,'param_name' 	=> 'thumbnail'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'std'			=> 1
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show posted by author', 'umbala' )
				,'param_name' 	=> 'author'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show comment count', 'umbala' )
				,'param_name' 	=> 'comment'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show date', 'umbala' )
				,'param_name' 	=> 'date'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'umbala' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show count view', 'umbala' )
				,'param_name' 	=> 'view'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show continue reading button', 'umbala' )
				,'param_name' 	=> 'readmore'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'umbala' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> '16'
				,'description' 	=> ''
				,'group'		=> esc_html__('Blog Setting', 'umbala')
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show load more button', 'umbala' )
				,'param_name' 	=> 'load_more'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'layout', 'value' => array('grid','masonry'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'umbala' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'load_more', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
				,'param_name' 	=> 'nav'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'std'			=> 1
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Show dots button', 'umbala' )
				,'param_name' 	=> 'dots'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'checkbox'
				,'heading' 		=> esc_html__( 'Auto play', 'umbala' )
				,'param_name' 	=> 'autoplay'
				,'admin_label' 	=> false
				,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'umbala' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '30'
				,'description' 	=> esc_html__('Set margin between items', 'umbala')
				,'group'		=> esc_html__('Slider Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
				,'param_name' 	=> 'desksmini'
				,'admin_label' 	=> false
				,'value' 		=>  array(1,2,3,4,5)
				,'std'			=> '3'
				,'description' 	=> esc_html__('Set items on 991px', 'umbala')
				,'group'		=> esc_html__('Responsive Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
				,'param_name' 	=> 'tablet'
				,'admin_label' 	=> false
				,'value' 		=>  array(1,2,3,4)
				,'std'			=> '2'
				,'description' 	=> esc_html__('Set items on 768px', 'umbala')
				,'group'		=> esc_html__('Responsive Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
				,'param_name' 	=> 'tabletmini'
				,'admin_label' 	=> false
				,'value' 		=>  array(1,2,3,4)
				,'std'			=> '2'
				,'description' 	=> esc_html__('Set items on 640px', 'umbala')
				,'group'		=> esc_html__('Responsive Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
				,'param_name' 	=> 'mobile'
				,'admin_label' 	=> false
				,'value' 		=>  array(1,2,3)
				,'std'			=> '1'
				,'description' 	=> esc_html__('Set items on 480px', 'umbala')
				,'group'		=> esc_html__('Responsive Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
				,'param_name' 	=> 'mobilesmini'
				,'admin_label' 	=> false
				,'value' 		=>  array(1,2,3)
				,'std'			=> '1'
				,'description' 	=> esc_html__('Set items on 0px', 'umbala')
				,'group'		=> esc_html__('Responsive Options', 'umbala')
				,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
			)
		)
) );

/*** Alus Image Gallery ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Images Gallery', 'umbala' ),
	'base' 		=> 'alus_images_gallery',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'attach_images'
			,'heading' 		=> esc_html__( 'Image', 'umbala' )
			,'param_name' 	=> 'images'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Image Size', 'umbala' )
			,'param_name' 	=> 'image_size'
			,'admin_label' 	=> false
			,'value' 		=> 'thumbnail'
			,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Layout', 'umbala' )
			,'param_name' 	=> 'layout'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__( 'Grid', 'umbala' ) => 'grid',
				esc_html__( 'Masonry', 'umbala' ) => 'masonry',
				esc_html__( 'Slider', 'umbala' ) => 'slider'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Columns', 'umbala' )
			,'param_name' 	=> 'columns'
			,'value' 		=> array(1,2,3,4,5,6)
			,'std'			=> '3'
			,'dependency' => array( 'element' => 'layout', 'value' => array( 'grid','slider' ))
			,'description' 	=> ''
		)
		,array(
			'type' => 'textfield'
			,'heading' => esc_html__( 'Margin', 'umbala' )
			,'param_name' => 'margin'
			,'description' => ''
			,'value'		=> '30'
			,'dependency' => array( 'element' => 'layout', 'value' => array( 'slider' ) )
		)
		,array(
			'type' => 'checkbox'
			,'heading' => esc_html__( 'Show navigation', 'umbala' )
			,'param_name' => 'nav'
			,'description' => ''
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'dependency' => array( 'element' => 'layout', 'value' => array( 'slider' ))
		)
		,array(
			'type' => 'checkbox'
			,'heading' => esc_html__( 'Show dots', 'umbala' )
			,'param_name' => 'dots'
			,'description' => ''
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'dependency' => array( 'element' => 'layout', 'value' => array( 'slider' ))
		)
		,array(
			'type' => 'checkbox'
			,'heading' => esc_html__( 'Autoplay', 'umbala' )
			,'param_name' => 'autoplay'
			,'description' => ''
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'dependency' => array( 'element' => 'layout', 'value' => array( 'slider' ))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'std'			=> '3'
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' => 'dropdown'
			,'heading' => esc_html__( 'On click action', 'umbala' )
			,'param_name' => 'action'
			,'value' => array(
				'' => ''
				,esc_html__( 'Lightbox', 'umbala' ) => 'lightbox'
				,esc_html__( 'Custom link', 'umbala' ) => 'links'
			)
		)
		,array(
			'type' => 'vc_link'
			,'heading' => esc_html__( 'Custom links', 'umbala' )
			,'param_name' => 'custom_links'
			,'description' => ''
			,'dependency' => array( 'element' => 'action', 'value' => array( 'links' ) )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'umbala' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('New Window Tab', 'umbala')		=> '_blank'
				,esc_html__('Self', 'umbala')				=> '_self'
			)
			,'description' 	=> ''
		)
	)
) );

/*** Alus Banner ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Banner', 'umbala' ),
	'base' 		=> 'alus_banner',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Background Image', 'umbala' )
			,'param_name' 	=> 'bg_image'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Image Size', 'umbala' )
			,'param_name' 	=> 'image_size'
			,'admin_label' 	=> false
			,'value' 		=> 'full'
			,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'umbala' )
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Overlay', 'umbala' )
			,'param_name' 	=> 'overlay'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Hover Effect', 'umbala' )
			,'param_name' 	=> 'hover_effect'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'umbala') 		=> 'none',
				esc_html__('Parallax', 'umbala') 	=> 'parallax',
				esc_html__('Zoom', 'umbala') 		=> 'zoom',
				esc_html__('Zoom Long', 'umbala') 	=> 'zoom-long',
				esc_html__('Zoom Fade', 'umbala') 	=> 'zoom-fade',
				esc_html__('Blur', 'umbala') 		=>	'blur',
				esc_html__('Fade In', 'umbala') 	=> 'fade-in',
				esc_html__('Fade Out', 'umbala')  	=> 'fade-out',
				esc_html__('Color', 'umbala') 		=> 'color',
				esc_html__('Grayscale', 'umbala') 	=> 'grayscale'
			)
			,'description' 	=> esc_html__('Add Hover Effect on Image', 'umbala')
		)
		,array(
			'type' 			=> 'textarea_html'
			,'heading' 		=> esc_html__( 'Banner Content', 'umbala' )
			,'param_name' 	=> 'content'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Banner Content Position ', 'umbala' )
			,'param_name' 	=> 'position_content'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Left Top', 'umbala')			=>  'left-top'
				,esc_html__('Left Bottom', 'umbala')		=>  'left-bottom'
				,esc_html__('Left Center', 'umbala')		=>  'left-center'
				,esc_html__('Right Top', 'umbala')			=>  'right-top'
				,esc_html__('Right Bottom', 'umbala')		=>  'right-bottom'
				,esc_html__('Right Center', 'umbala')		=>  'right-center'
				,esc_html__('Center Top', 'umbala')			=>  'center-top'
				,esc_html__('Center Bottom', 'umbala')		=>  'center-bottom'
				,esc_html__('Center Center', 'umbala')		=>  'center-center'
			)
			,'std'			=> 'center-center'
			,'description' 	=> ''
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Banner content width', 'umbala' ),
			'param_name' => 'content_width',
			'value' => array(
				'100%' => '100',
				'90%' => '90',
				'80%' => '80',
				'70%' => '70',
				'60%' => '60',
				'50%' => '50',
				'40%' => '40',
				'30%' => '30',
				'20%' => '20',
				'10%' => '10'
			)
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Banner content background color', 'umbala' )
			,'param_name' 	=> 'content_bg'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'vc_link'
			,'heading' 		=> esc_html__( 'Link', 'umbala' )
			,'param_name' 	=> 'link'
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'umbala' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('New Window Tab', 'umbala')	=>  '_blank'
				,esc_html__('Self', 'umbala')			=>  '_self'	
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Extra Class', 'umbala' )
			,'param_name' 	=> 'extra_class'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
	)
) );

/* Alus Testimonial */
vc_map( array(
	'name' => esc_html__( 'Alus Testimonials', 'umbala' ),
	'base' => 'alus_testimonials',
	'as_parent' => array( 'only' => 'alus_testimonial' ),
	'content_element' => true,
	'show_settings_on_create' => false,
	'category' 	=> 'Alura-Studio',
	'js_view' => 'VcColumnView',
	'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'umbala' ),
			'param_name' => 'title',
			'value' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Layout', 'umbala' ),
			'param_name' => 'layout',
			'value' => array(
				esc_html__( 'Slider', 'umbala' ) => 'slider',
				esc_html__( 'Grid', 'umbala' ) => 'grid'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'umbala' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Default', 'umbala' ) => 'default',
				esc_html__( 'Boxed', 'umbala' ) => 'boxed'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'umbala' ),
			'param_name' => 'columns',
			'value' => array(
				1,2,3,4,5,6
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Margin', 'umbala' ),
			'param_name' => 'margin',
			'value'		=> '30',
			'description' => '',
			'group' => 'Slider Options',
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'umbala' ),
			'param_name' => 'autoplay',
			'description' => '',
			'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' ),
			'group' => 'Slider Options',
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Show Navigation', 'umbala' ),
			'param_name' => 'show_nav',
			'description' => '',
			'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' ),
			'group' => 'Slider Options',
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Show dots', 'umbala' ),
			'param_name' => 'show_dots',
			'description' => '',
			'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' ),
			'group' => 'Slider Options',
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'umbala' ),
			'param_name' => 'extra_class',
			'description' => ''
		),
		array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				1,2,3,4,5
			)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				1,2,3,4
			)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				1,2,3,4
			)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				1,2,3
			)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				1,2,3
			)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency' => array(
				'element' => 'layout',
				'value' => array( 'slider' )
			)
		)
	)
) );

vc_map( array(
	'name' => esc_html__( 'Alus Testimonial', 'umbala' ),
	'base' => 'alus_testimonial',
	'as_child' => array( 'only' => 'alus_testimonials' ),
	'category' 	=> 'Alura-Studio',
	'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'User Avatar', 'umbala' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'umbala' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image Width', 'umbala' ),
			'param_name' => 'img_width',
			'value' 		=> '80',
			'description' => esc_html__( 'Example: 80', 'umbala' )
		),
		array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Image Position', 'umbala' )
			,'param_name' 	=> 'image_position'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Top', 'umbala')		=> 'top'
				,esc_html__('Center', 'umbala')	=> 'center'
				,esc_html__('Left', 'umbala')	=> 'left'
				,esc_html__('Right', 'umbala')	=> 'right'
			)
			,'description' 	=> ''
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Name', 'umbala' ),
			'param_name' => 'name',
			'value' => '',
			'description' => esc_html__( 'User name', 'umbala' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Company', 'umbala' ),
			'param_name' => 'company',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'umbala' ),
			'param_name' => 'content'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'umbala' ),
			'param_name' => 'extra_class',
			'description' => ''
		)
	)
) );

/*** Alus Brands ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Brands Slider', 'umbala' ),
	'base' 		=> 'alus_brands_slider',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'umbala' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'umbala' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> '7'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'umbala' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Number of Rows', 'umbala' )
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Categories', 'umbala' )
			,'param_name' 	=> 'categories'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'umbala' )
			,'param_name' 	=> 'margin_image'
			,'admin_label' 	=> false
			,'value' 		=> '30'
			,'description' 	=> esc_html__('Set margin between items', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Activate link', 'umbala' )
			,'param_name' 	=> 'active_link'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
			,'param_name' 	=> 'nav'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'std'			=> 1
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Autoplay', 'umbala' )
			,'param_name' 	=> 'autoplay'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'std'			=> 1
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5,6)
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
		)
	)
) );


/*** Alus Google Map ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Google Map', 'umbala' ),
	'base' 		=> 'alus_google_map',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	'icon'      => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Address', 'umbala' )
			,'param_name' 	=> 'address'
			,'value'		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Height', 'umbala' )
			,'param_name' 	=> 'height'
			,'value' 		=> 400
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Zoom', 'umbala' )
			,'param_name' 	=> 'zoom'
			,'value' 		=> 12
			,'description' 	=> esc_html__('Input a number between 0 and 20', 'umbala')
		)
		,array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Map Icon', 'umbala' )
			,'param_name' 	=> 'icon'
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textarea_raw_html'
			,'heading' 		=> esc_html__( 'Style (Json)', 'umbala' )
			,'param_name' 	=> 'styles'
			,'value' 		=> ''
			,'description' 	=>  wp_kses( __('You can add Google Maps styles on the website: <a target="_blank" href="http://snazzymaps.com/">Snazzy Maps</a><br>Ex: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]', 'umbala'),array('a' => array( 'href' => array(), 'target' => array()), 'br'	=> array() ) )
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show Content', 'umbala' )
			,'param_name' 	=> 'show_content'
			,'value' 		=> array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'description' 	=> esc_html__('Show content information on Map', 'umbala')
		)
		,array(
			'type' 			=> 'textarea_html',
			'holder' 		=> 'div',
			'heading' 		=> esc_html__( 'Content', 'umbala' ),
			'param_name' 	=> 'content',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Color', 'umbala' ),
			'param_name' => 'content_text',
			'value' => array(
				esc_html__( 'Dark', 'umbala') => 'dark',
				esc_html__( 'Light', 'umbala') => 'light'
			),
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Content Background', 'umbala' )
			,'param_name' 	=> 'content_bg'
			,'value' 		=> '#ffffff'
			,'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
			,'description' 	=> ''
		)
		,array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Content width', 'umbala' ),
			'param_name' => 'content_width',
			'value' => '230',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
			,'description' 	=> esc_html__('Set width for content. Ex: 230', 'umbala')
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Position Content(Left)', 'umbala' ),
			'param_name' => 'content_position_x',
			'value' => array(
				'100%' => '100',
				'90%' => '90',
				'80%' => '80',
				'70%' => '70',
				'60%' => '60',
				'50%' => '50',
				'40%' => '40',
				'30%' => '30',
				'20%' => '20',
				'10%' => '10'
			)
			,'std'		=> '50',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Position Content(Top)', 'umbala' ),
			'param_name' => 'content_position_y',
			'value' => array(
				'100%' => '100',
				'90%' => '90',
				'80%' => '80',
				'70%' => '70',
				'60%' => '60',
				'50%' => '50',
				'40%' => '40',
				'30%' => '30',
				'20%' => '20',
				'10%' => '10'
			)
			,'std'		=> '20',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
	)
) );

/*** Alus Countdown ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Countdown', 'umbala' ),
	'base' 		=> 'alus_countdown',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Date', 'umbala' ),
			'param_name' => 'date',
			'description' => esc_html__( 'Final date in the format Y/m/d. For example 2018/12/12', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Text Color Style', 'umbala' )
			,'param_name' 	=> 'text_color_style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'umbala')	=> 'text-default'
				,esc_html__('Light', 'umbala')		=> 'text-light'
			)
			,'description' 	=> ''
		)
	)
) );

/** Alus Button ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Button', 'umbala' ),
	'base' 		=> 'alus_button',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	'icon'      => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Text Button', 'umbala' )
			,'param_name' 	=> 'text'
			,'value'		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Color', 'umbala' ),
			'param_name' => 'text_color',
			'value' => array(
				esc_html__('Dark', 'umbala') => 'dark',
				esc_html__('Light', 'umbala') => 'light',
			)
			,'std'		=> '20',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Tranform', 'umbala' ),
			'param_name' => 'text_tranform',
			'value' => array(
				esc_html__('Uppercase', 'umbala') => 'uppercase',
				esc_html__('Inherit', 'umbala') => 'inherit',
			)
			,'std'		=> '20',
			'dependency' 	=> array('element' => 'show_content', 'value' => array( '1' ))
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'umbala' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__('Primary', 'umbala') => 'primary',
				esc_html__('Secondary', 'umbala') => 'secondary',
				esc_html__('Alert', 'umbala') => 'alert',
				esc_html__('Success', 'umbala') => 'success',
				esc_html__('White', 'umbala') => 'white',
			)
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'umbala' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Default', 'umbala') => '',
				esc_html__('Outline', 'umbala') => 'outline',
				esc_html__('Simple', 'umbala') => 'simple',
				esc_html__('Underline', 'umbala') => 'underline',
			)
		)
		,array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'umbala' ),
			'param_name' => 'size',
			'value' => array(
				esc_html__('Normal', 'umbala') => '',
				esc_html__('XX-Small', 'umbala') => 'xxsmall',
				esc_html__('X-Small', 'umbala') => 'xsmall',
				esc_html__('Smaller', 'umbala') => 'smaller',
				esc_html__('Small', 'umbala') => 'small',
				esc_html__('Large', 'umbala') => 'large',
				esc_html__('Larger', 'umbala') => 'larger',
				esc_html__('X-Large', 'umbala') => 'xlarge',
				esc_html__('XX-Large', 'umbala') => 'xxlarge',
			)
			,'std'	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Border Radius', 'umbala' )
			,'param_name' 	=> 'radius'
			,'value'		=> ''
			,'description' 	=> esc_html__('Ex: 4', 'umbala')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Icon', 'umbala' )
			,'param_name' 	=> 'icon'
			,'value'		=> ''
			,'description' 	=> esc_html__('Ex: fa-home', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Icon Position', 'umbala' )
			,'param_name' 	=> 'icon_position'
			,'value'		=> array(
				esc_html__('Right', 'umbala') => 'right',
				esc_html__('Left', 'umbala') => 'left',
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'vc_link'
			,'heading' 		=> esc_html__( 'Link', 'umbala' )
			,'param_name' 	=> 'link'
			,'value'		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Extra class name', 'umbala' )
			,'param_name' 	=> 'extra_class'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
	)
) );

/********************** Product Shortcodes ************************/

/*** Alus Products ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Products', 'umbala' ),
	'base' 		=> 'alus_products',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Title', 'umbala' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product Layout', 'umbala' )
			,'param_name' 	=> 'product_layout'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Grid', 'umbala')		=> 'grid'
				,esc_html__('Masonry', 'umbala')		=> 'masonry'
				,esc_html__('Slider', 'umbala')		=> 'slider'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style', 'umbala' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'umbala')		=> 'default'
				,esc_html__('Overlay', 'umbala')	=> 'overlay'
				,esc_html__('Shade', 'umbala')		=> 'shade'
				,esc_html__('Vertical', 'umbala')	=> 'vertical'
				,esc_html__('Label', 'umbala')		=> 'label'
				,esc_html__('Push', 'umbala')		=> 'push'
				,esc_html__('Badge', 'umbala')		=> 'badge'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'umbala' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'umbala')		=> 'recent'
				,esc_html__('Sale', 'umbala')		=> 'sale'
				,esc_html__('Featured', 'umbala')	=> 'featured'
				,esc_html__('Best Selling', 'umbala')	=> 'best_selling'
				,esc_html__('Top Rated', 'umbala')	=> 'top_rated'
				,esc_html__('Mixed Order', 'umbala')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'umbala' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'umbala')				=> ''
				,esc_html__('ID', 'umbala')				=> 'ID'
				,esc_html__('Date', 'umbala')				=> 'date'
				,esc_html__('Name', 'umbala')				=> 'name'
				,esc_html__('Title', 'umbala')				=> 'title'
				,esc_html__('Comment count', 'umbala')		=> 'comment_count'
				,esc_html__('Random', 'umbala')			=> 'rand'
			)
			,'description' 	=> ''
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Sorting', 'umbala' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'umbala')		=> ''
				,esc_html__('Descending', 'umbala')		=> 'DESC'
				,esc_html__('Ascending', 'umbala')		=> 'ASC'
			)
			,'description' 	=> ''
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'umbala' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> ''
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'umbala' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 4
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Per Page', 'umbala' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Products', 'umbala' )
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'umbala' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
				,'values'			=> umbala_get_categories_product_autocomplete()
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Sale Countdown', 'umbala' )
			,'param_name' 	=> 'show_countdown'
			,'admin_label' 	=> true
			,'value' 		=> array( esc_html__('Yes, please', 'umbala')	=> 1 )
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show load more button', 'umbala' )
			,'param_name' 	=> 'show_load_more'
			,'value' 		=> array( esc_html__('Yes', 'umbala')	=> 1 )
			,'description' 	=> ''
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('grid', 'masonry'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Load more text', 'umbala' )
			,'param_name' 	=> 'load_more_text'
			,'value' 		=> 'Show more'
			,'description' 	=> ''
			,'dependency'  	=> array('element' => 'show_load_more', 'value' => array('1'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
			,'param_name' 	=> 'nav'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'std'			=> 1
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show dots button', 'umbala' )
			,'param_name' 	=> 'dots'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Auto play', 'umbala' )
			,'param_name' 	=> 'autoplay'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'umbala' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> false
			,'value' 		=> '30'
			,'description' 	=> esc_html__('Set margin between items', 'umbala')
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'std'			=> '4'
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '3'
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
	)
) );

/*** Alus Products Widget ***/
vc_map( array(
	'name' 			=> esc_html__( 'Alus Products Widget', 'umbala' ),
	'base' 			=> 'alus_products_widget',
	'class' 		=> '',
	'description' 	=> '',
	'category' 		=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 		=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Title', 'umbala' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'umbala' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'umbala')		=> 'recent'
				,esc_html__('Sale', 'umbala')		=> 'sale'
				,esc_html__('Featured', 'umbala')	=> 'featured'
				,esc_html__('Best Selling', 'umbala')	=> 'best_selling'
				,esc_html__('Top Rated', 'umbala')	=> 'top_rated'
				,esc_html__('Mixed Order', 'umbala')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'umbala' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'umbala' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 6
			,'description' 	=> esc_html__( 'Number of Products', 'umbala' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'umbala' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'umbala' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Thumbnail size', 'umbala' )
			,'param_name' 	=> 'thumbnail_size'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('shop_thumbnail', 'umbala')		=> 'Product Thumbnails'
				,esc_html__('shop_catalog', 'umbala')		=> 'Catalog Images'
				,esc_html__('shop_single', 'umbala')	=> 'Single Product Image'
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'umbala' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'umbala' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'umbala' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'umbala' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'umbala')	=> 0
				,esc_html__('Yes', 'umbala')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show in a carousel slider', 'umbala' )
			,'param_name' 	=> 'is_slider'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'umbala')	=> 0
				,esc_html__('Yes', 'umbala')	=> 1
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Row', 'umbala' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> false
			,'value' 		=> 3
			,'description' 	=> esc_html__( 'Number of Rows for slider', 'umbala' )
			,'group'		=> esc_html__('Slider Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'umbala' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'umbala')	=> 1
				,esc_html__('No', 'umbala')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
		)
	)
) );


/*** Alus Products Deals ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Products Deals', 'umbala' ),
	'base' 		=> 'alus_products_deals',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	'icon'          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Title', 'umbala' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product Layout', 'umbala' )
			,'param_name' 	=> 'product_layout'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Grid', 'umbala')		=> 'grid'
				,esc_html__('Masonry', 'umbala')		=> 'masonry'
				,esc_html__('Slider', 'umbala')		=> 'slider'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style', 'umbala' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'umbala')		=> 'default'
				,esc_html__('Overlay', 'umbala')	=> 'overlay'
				,esc_html__('Shade', 'umbala')		=> 'shade'
				,esc_html__('Vertical', 'umbala')	=> 'vertical'
				,esc_html__('Label', 'umbala')		=> 'label'
				,esc_html__('Push', 'umbala')		=> 'push'
				,esc_html__('Badge', 'umbala')		=> 'badge'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'umbala' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'umbala')		=> 'recent'
				,esc_html__('Sale', 'umbala')		=> 'sale'
				,esc_html__('Featured', 'umbala')	=> 'featured'
				,esc_html__('Best Selling', 'umbala')	=> 'best_selling'
				,esc_html__('Top Rated', 'umbala')	=> 'top_rated'
				,esc_html__('Mixed Order', 'umbala')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'umbala' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'umbala')				=> ''
				,esc_html__('ID', 'umbala')				=> 'ID'
				,esc_html__('Date', 'umbala')				=> 'date'
				,esc_html__('Name', 'umbala')				=> 'name'
				,esc_html__('Title', 'umbala')				=> 'title'
				,esc_html__('Comment count', 'umbala')		=> 'comment_count'
				,esc_html__('Random', 'umbala')			=> 'rand'
			)
			,'description' 	=> ''
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Sorting', 'umbala' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'umbala')		=> ''
				,esc_html__('Descending', 'umbala')		=> 'DESC'
				,esc_html__('Ascending', 'umbala')		=> 'ASC'
			)
			,'description' 	=> ''
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'umbala' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> ''
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'umbala' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 4
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Per Page', 'umbala' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Products', 'umbala' )
			,'group' 	=> esc_html__( 'Data Setting', 'umbala' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'umbala' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
				,'values'			=> umbala_get_categories_product_autocomplete()
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Sale Countdown', 'umbala' )
			,'param_name' 	=> 'show_countdown'
			,'admin_label' 	=> true
			,'value' 		=> array( esc_html__('Yes, please', 'umbala')	=> 1 )
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show Gallery', 'umbala' )
			,'param_name' 	=> 'show_gallery'
			,'admin_label' 	=> true
			,'value' 		=> array( esc_html__('Yes, please', 'umbala')	=> 1 )
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show Description', 'umbala' )
			,'param_name' 	=> 'show_description'
			,'admin_label' 	=> true
			,'value' 		=> array( esc_html__('Yes, please', 'umbala')	=> 1 )
			,'description' 	=> ''
			,'dependency'  	=> array('element' => 'style', 'value' => array('vertical'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
			,'param_name' 	=> 'nav'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'std'			=> 1
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show dots button', 'umbala' )
			,'param_name' 	=> 'dots'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Auto play', 'umbala' )
			,'param_name' 	=> 'autoplay'
			,'admin_label' 	=> false
			,'value' => array( esc_html__( 'Yes, please', 'umbala' ) => '1' )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'umbala' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> false
			,'value' 		=> '30'
			,'description' 	=> esc_html__('Set margin between items', 'umbala')
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'std'			=> '4'
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '3'
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '2'
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> '1'
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'product_layout', 'value' => array('slider'))
		)
	)
) );

/*** Alus Product Categories ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Product Categories', 'umbala' ),
	'base' 		=> 'alus_product_categories',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Title', 'umbala' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Categories Layout', 'umbala' )
			,'param_name' 	=> 'layout'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Grid', 'umbala')		=> 'grid'
				,esc_html__('Masonry', 'umbala')		=> 'masonry'
				,esc_html__('Slider', 'umbala')		=> 'slider'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'umbala' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 4
			,'description' 	=> esc_html__( 'Number of Columns', 'umbala' )
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider', 'grid'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'umbala' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Number of Rows', 'umbala' )
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'umbala' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Product Categories', 'umbala' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'umbala' )
			,'param_name' 	=> 'ids'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
				,'values'			=> umbala_get_categories_product_autocomplete()
			)
			,'description' 	=> esc_html__('List of product categories', 'umbala')
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Hide empty product categories', 'umbala' )
			,'param_name' 	=> 'hide_empty'
			,'value' 		=> array( esc_html__('Yes', 'umbala')	=> 1 )
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show product category title', 'umbala' )
			,'param_name' 	=> 'show_title'
			,'value' 		=> array(esc_html__('Yes', 'umbala')	=> 1)
			,'std'			=> 1
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show product category description', 'umbala' )
			,'param_name' 	=> 'show_description'
			,'value' 		=> array( esc_html__('Yes', 'umbala')	=> 1 )
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show navigation button', 'umbala' )
			,'param_name' 	=> 'show_nav'
			,'value' 		=> array( esc_html__('Yes', 'umbala')	=> 1 )
			,'std'			=> 1
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Show dots button', 'umbala' )
			,'param_name' 	=> 'dots'
			,'value' 		=> array(esc_html__('Yes', 'umbala')	=> 1 )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'checkbox'
			,'heading' 		=> esc_html__( 'Auto play', 'umbala' )
			,'param_name' 	=> 'auto_play'
			,'value' 		=> array( esc_html__('Yes', 'umbala')	=> 1 )
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'umbala' )
			,'param_name' 	=> 'margin'
			,'value' 		=> '30'
			,'description' 	=> esc_html__('Set margin between items', 'umbala')
			,'group'		=> esc_html__('Slider Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'umbala' )
			,'param_name' 	=> 'desksmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'std'			=> 4
			,'description' 	=> esc_html__('Set items on 991px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'umbala' )
			,'param_name' 	=> 'tablet'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4,5)
			,'std'			=> 3
			,'description' 	=> esc_html__('Set items on 768px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'umbala' )
			,'param_name' 	=> 'tabletmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> 3
			,'description' 	=> esc_html__('Set items on 640px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'umbala' )
			,'param_name' 	=> 'mobile'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3,4)
			,'std'			=> 2
			,'description' 	=> esc_html__('Set items on 480px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'umbala' )
			,'param_name' 	=> 'mobilesmini'
			,'admin_label' 	=> false
			,'value' 		=>  array(1,2,3)
			,'std'			=> 1
			,'description' 	=> esc_html__('Set items on 0px', 'umbala')
			,'group'		=> esc_html__('Responsive Options', 'umbala')
			,'dependency'  	=> array('element' => 'layout', 'value' => array('slider'))
		)
	)
) );

/*** Alus Video ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Video', 'umbala' ),
	'base' 		=> 'alus_video',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	"icon"          => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Video Url', 'umbala' )
			,'param_name' 	=> 'src'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> 'Add link Vimeo or Youtube Video'
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Width', 'umbala' )
			,'param_name' 	=> 'width'
			,'admin_label' 	=> true
			,'value' 		=> '800'
			,'description' 	=> esc_html__( 'Ex: 800', 'umbala' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Height', 'umbala' )
			,'param_name' 	=> 'height'
			,'admin_label' 	=> true
			,'value' 		=> '450'
			,'description' 	=> esc_html__('Ex: 450', 'umbala')
		)
	)
) );


/*** Alus Milestone ***/
vc_map( array(
	'name' 		=> esc_html__( 'Alus Counter Up', 'umbala' ),
	'base' 		=> 'alus_counter',
	'class' 	=> '',
	'category' 	=> 'Alura-Studio',
	'icon'      => get_template_directory_uri() . '/assets/images/icon-large.png',
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Number', 'umbala' )
			,'param_name' 	=> 'number'
			,'admin_label' 	=> true
			,'value' 		=> '0'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Subject', 'umbala' )
			,'param_name' 	=> 'meta'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Text Color Style', 'umbala' )
			,'param_name' 	=> 'text_color_style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'umbala')	=> 'text-default'
				,esc_html__('Light', 'umbala')		=> 'text-light'
			)
			,'description' 	=> ''
		)
	)
) );

}

if( class_exists( 'WPBakeryShortCodesContainer' ) ){
	class WPBakeryShortCode_alus_testimonials extends WPBakeryShortCodesContainer {

	}
}

if( class_exists( 'WPBakeryShortCode' ) ){
	class WPBakeryShortCode_alus_testimonial extends WPBakeryShortCode {

	}
}

function umbala_get_categories_blog_checkbox(){
	$args = array(
		'taxonomy' 			=> 'category'
		,'hierarchical'		=> 1
		,'hide_empty'		=> 0
		,'parent'			=> ''
		,'title_li'			=> ''
		,'child_of'			=> 0
	);
	$categories = get_categories($args);

	$output_categories = array();

	foreach($categories as $key => $category) { 
		$output_categories[$category->name] = $category->term_id;
	}
	return $output_categories;
}

function umbala_get_categories_product_autocomplete(){
	$taxonomy     = 'product_cat';
	$orderby      = 'name';  
	$show_count   = 0;
	$pad_counts   = 0;
	$hierarchical = 1;
	$title        = '';  
	$empty        = 0;

	$args = array(
		'taxonomy'     => $taxonomy,
		'orderby'      => $orderby,
		'show_count'   => $show_count,
		'pad_counts'   => $pad_counts,
		'hierarchical' => $hierarchical,
		'title_li'     => $title,
		'hide_empty'   => $empty
	);

	$all_categories = get_categories( $args );
	$cat_list = array();

	foreach ($all_categories as $cat) {
		$cat_list[] = array('label' => $cat->name, 'value' => $cat->term_id);
	}
	return $cat_list;
}


?>