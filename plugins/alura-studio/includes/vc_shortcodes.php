<?php 
/************************************
*** Custom Post Type Shortcodes
*************************************/

/***  Shotcode Section Title  ***/
if( !function_exists('alus_section_title_shortcode') ){
	function alus_section_title_shortcode($atts){
		extract(shortcode_atts(array(
			'title'	 				=> '' ,
			'style'					=> 'bordered',
			'font_size_title'		=> '',
			'font_weight_title'		=> '500',
			'before_title'			=> '',
			'subtitle_des'			=> '',
			'title_tag'				=> 'span',
			'extra_class'			=> ''
		),$atts));

		$classes = array();
		$classes[] = 'alus-section-title';
		$classes[] = $style;
		$classes[] = $extra_class;
		$output = $styles = '';
		if ( $font_size_title != '' ) {
			$styles = 'style="font-size:'.$font_size_title.'px "';
		}
		$output .= '<div class="section-title-container '.esc_attr(implode(' ', $classes)) .'">';
		if( $before_title != '' ){
			$output.= '<span class="before-title">'.$before_title.'</span>';
		}
		if ($style == 'bordered'){ 
			$output.= '<b></b>';
		}
		$output .= '<div class="section-title-main"><'.$title_tag.' class="font-'.esc_attr($font_weight_title).' " ' . $styles. ' >'. esc_attr($title) .'</'.$title_tag.'></div>';
		if ($style != 'default'){ 
			$output.= '<b></b>';
		}
		if ($subtitle_des != ''){ 
			$output .= '<span class="sub-title-des"> '.$subtitle_des.' </span>';
		}

		$output .= '</div>';

		return $output;
	}
}
add_shortcode('alus_section_title', 'alus_section_title_shortcode');

/* * Shortcode Button **/
if( !function_exists('alus_button_shortcode') ){
	function alus_button_shortcode($atts){
		extract(shortcode_atts(array(
			'text'	 				=> '' ,
			'text_color'			=> 'dark',
			'text_tranform'			=> 'uppercase',
			'color'					=> 'primary',
			'style'					=> '',
			'size'					=> '',
			'radius'				=> '',
			'icon'					=> '',
			'icon_position'			=> 'right',
			'link'					=> '',
			'extra_class'			=> ''
		),$atts));

		$classes = array();
		$classes[] = 'alus-button-shortcode';
		$classes[] = 'color-'.$color;
		$classes[] = $extra_class;
		if( $size != '' ){
			$classes[] = 'is-'.$size;
		}
		$classes[] = 'text-'.$text_color;
		if( $style != '' ){
			$classes[] = 'button-style-'.$style;
		}

		$link = ( $link =='||' ) ? '' : $link;
		$attr = vc_build_link( $link );
		$link = ($attr['url'] == '') ? '' : $attr['url'];
		$title = ($attr['title'] == '') ? '' : $attr['title'];
		$target = ($attr['target'] == '') ? '' : $attr['target'];

		$style = '';
		if( $text_tranform ){
			$style .= 'text-transform:'.$text_tranform.';';
		}
		if( $radius ){
			$style .= ' border-radius:'.$radius.'px;';
		}
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
			<a href="<?php echo esc_url($link) ?>" title="<?php echo esc_attr($title) ?>" target="<?php echo esc_attr($target); ?>" style="<?php echo esc_attr($style); ?>">
				<?php if( $icon && $icon_position == 'left' ): ?>
					<i class="fa <?php echo esc_html($icon); ?>"></i>
				<?php endif; ?>
				<?php echo esc_html( $text ); ?>
				<?php if( $icon && $icon_position == 'right' ): ?>
					<i class="fa <?php echo esc_html($icon); ?>"></i>
				<?php endif; ?>
			</a>
		</div>
		<?php

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode('alus_button', 'alus_button_shortcode');
}

/** Shortcode Mega Menu **/
function alus_mega_menu_shortcode($atts, $content) {
	
	extract(shortcode_atts( array(
		'title' => 'All Categories',
		'nav_menu' => '',
		'extra_class' => ''
	), $atts ));

	
	$instance = array(
		'title'					=> $title
		,'nav_menu'			=> $nav_menu
	);

	ob_start();
	?>

	<div class="alus-mega-menu-shortcode <?php echo esc_html($extra_class); ?>">
		<?php the_widget('Umbala_WP_Nav_Menu_Widget', $instance); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'alus_mega_menu_wg', 'alus_mega_menu_shortcode' );


/*** Shortcode Team memmber ***/
function alus_team_member_shortcode($atts, $content = null){
	extract(shortcode_atts(array(
		'image'				=> ''
		,'style_img'			=> 'default'
		,'name'			=> ''
		,'title'			=> 'CEO / FOUNDER'
		,'link'				=> ''
		,'position'			=> 'meta'
		,'icon_style'		=> 'colored'
		,'facebook'			=> ''
		,'twitter'			=> ''
		,'google_plus'		=> ''
		,'linkedin'			=> ''
		,'dribbble'			=>''
		,'instagram'		=> ''
		,'pinterest'		=> ''
		,'rss'				=> ''
		,'target'			=> '_blank'					
	), $atts ));

	if( strlen(trim($name)) == 0 ){
		return;
	}

	$classes = array();
	$classes[] = 'alus-team-member';
	$classes[] = $style_img;
	$classes[] = $icon_style;

	$social_content = '';

	if( $facebook ){
		$social_content .= '<li><a class="facebook" href="'.esc_url($facebook).'" target="'.$target.'"><i class="fa fa-facebook"></i></a></li>';
	}
	if( $twitter){
		$social_content .= '<li><a class="twitter" href="'.esc_url($twitter).'" target="'.$target.'"><i class="fa fa-twitter"></i></a></li>';
	}
	if( $google_plus){
		$social_content .= '<li><a class="google-plus" href="'.esc_url($google_plus).'" target="'.$target.'"><i class="fa fa-google-plus"></i></a></li>';
	}
	if( $linkedin){
		$social_content .= '<li><a class="linked" href="'.esc_url($linkedin).'" target="'.$target.'"><i class="fa fa-linkedin"></i></a></li>';
	}
	if( $rss){
		$social_content .= '<li><a class="rss" href="'.esc_url($rss).'" target="'.$target.'"><i class="fa fa-rss"></i></a></li>';
	}
	if( $dribbble ){
		$social_content .= '<li><a class="dribbble" href="'.esc_url($dribbble).'" target="'.$target.'"><i class="fa fa-dribbble"></i></a></li>';
	}
	if( $pinterest){
		$social_content .= '<li><a class="pinterest" href="'.esc_url($pinterest).'" target="'.$target.'"><i class="fa fa-pinterest-p"></i></a></li>';
	}
	if( $instagram ){
		$social_content .= '<li><a class="instagram" href="'.esc_url($instagram).'" target="'.$target.'"><i class="fa fa-instagram"></i></a></li>';
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="image">
			<div class="image-team">
				<?php echo wp_get_attachment_image($image, 'full', 0, array('class'=>'img')); ?>
				<?php if( $position == 'thumbnail' ) { ?>
				<div class="overlay"></div>
				<?php } ?>
			</div>
			<?php if( $position == 'thumbnail' ) { ?>
			<div class="on-thumbnail">
				<h3><a class="name" href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a></h3>
				<span class="job"><?php echo esc_html($title); ?></span>
				<div class="socials">
					<ul>
						<?php echo $social_content; ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="content-member">
			<?php if ($position == 'meta') { ?>
			<h3><a class="name" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($name); ?></a></h3>
			<span class="job"><?php echo esc_html($title); ?></span>
			<div class="socials">
				<ul>
					<?php echo $social_content; ?>
				</ul>
			</div>
			<?php } ?>
			<div class="excerpt"><?php echo do_shortcode( $content ); ?></div>
		</div>				
	</div>
	<?php

	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode('alus_team_member', 'alus_team_member_shortcode');

/*** Shortcode Mailchimp  ***/
if( !function_exists('alus_mailchimp_subscription_shortcode') ){
	function alus_mailchimp_subscription_shortcode( $atts ){
		extract(shortcode_atts(array(	
			'title'				=> 'Newsletter'
			,'intro_text'		=> ''
			,'form'				=> ''
			,'bg_image'			=> ''
			,'text_style'		=> 'text-default'
			,'style'			=> 'style-1'
		), $atts));
		$bg_img = wp_get_attachment_url( $bg_image );
		$bg_image = '';

		if( !class_exists('Umbala_Mailchimp_Subscription_Widget') ){
			return;
		}

		$instance = compact('title', 'intro_text','bg_image', 'form', 'text_style');

		ob_start();

		echo '<div class="alus-mailchimp-shortcode '.$style.' " style="background-image:url('.$bg_img.')" >';

		the_widget('Umbala_Mailchimp_Subscription_Widget', $instance);

		echo '</div>';

		return ob_get_clean();
	}
}
add_shortcode('alus_mailchimp_subscription', 'alus_mailchimp_subscription_shortcode');

/*** Shortcode Instagram ***/
function alus_instagram_shortcode( $atts ){
	extract(shortcode_atts(array(
		'title'				=> 'Instagram'
		,'username'     => ''
		,'number'         => '9'
		,'column'			=> '3'
		,'size'			=> 'large'
		,'target'			=> '_self'
		,'cache_time'			=> '12'
	), $atts ));

	$instance = array(
		'title'					=> $title
		,'username'			=> $username
		,'number'			=> $number
		,'column'					=> $column
		,'size'				=> $size
		,'target' 		=> $target
		,'cache_time' 		=> $cache_time
	);

	ob_start();
	the_widget('Umbala_Instagram_Widget', $instance);
	return ob_get_clean();
}
add_shortcode('alus_instagram', 'alus_instagram_shortcode');

/*** Shortcode Feature ***/
function alus_feature_shortcode( $atts ){
	extract(shortcode_atts(array(
		'icon_style'		=> 'icon'
		,'class_icon' 		=> ''
		,'icon_position'	=> 'center'
		,'img_id'			=> ''
		,'image_style'		=> 'default'
		,'title' 			=> ''
		,'excerpt' 			=> ''
		,'link' 			=> ''		
		,'target' 			=> '_blank'
		,'extra_class'		=> ''
	), $atts ));

	ob_start();

	$classes = array();
	$classes[] = 'alus-feature-box';
	$classes[] = $extra_class;
	$classes[] = $icon_style;
	if( $icon_style == 'icon' ){
		$classes[] = $icon_position;	
	} else {
		$classes[] = $image_style;
	}
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">

		<?php if( $icon_style == 'icon' ): ?>
			<a target="<?php echo esc_attr($target); ?>" class="feature_icon" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>">
				<i class="fa <?php echo esc_attr($class_icon); ?>"></i>
			</a>
		<?php endif; ?>

		<?php if ($icon_style == 'image'): ?>
			<a target="<?php echo esc_attr($target); ?>" class="feature_image" href="<?php echo ($link != '') ? esc_url($link):'javascript: void(0)' ?>" >
				<?php echo wp_get_attachment_image($img_id, 'full', 0); ?>
				<?php if($image_style == 'overlay') { ?>
				<div class="overlay"></div>
				<?php } ?>
			</a>
		<?php endif; ?>

		<div class="feature_content">
			<?php if( strlen($title) > 0 ): ?>
				<h3 class="feature-title entry-title">
					<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '') ? esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
				</h3>
			<?php endif; ?>

			<?php if( strlen($excerpt) > 0 ): ?>
				<p class="feature_info">
					<?php echo esc_html($excerpt); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('alus_feature', 'alus_feature_shortcode');

/***  Shortcode Testimonial  ***/
function alus_testimonials_shortcode( $atts = array(), $content = ''){
	extract(shortcode_atts(array(
		'title'					=> ''
		,'layout'				=> 'slider'
		,'style'				=> 'default'
		,'margin'				=> '30'
		,'columns'				=> '3'
		,'autoplay' 				=> 0
		,'show_nav'			=> 0
		,'show_dots' 			=> 0
		,'extra_class'			=> ''
		,'desksmini'	=> '2'
		,'tablet'     	=> '2'
		,'tabletmini'	=> '2'
		,'mobile'		=> '1'
		,'mobilesmini'	=> '1'
	), $atts ));

	$classes = array();
	$classes[] = $extra_class;
	$classes[] = 'layout-' . $layout;
	$classes[] = 'columns-' . $columns;
	$classes[] = 'style-' . $style;

	$data_attr = array();
	if ($layout == 'slider'){
		$data_attr[] = 'data-margin='.esc_attr($margin);
		$data_attr[] = 'data-nav='.esc_attr($show_nav);
		$data_attr[] = 'data-dots='.esc_attr($show_dots);
		$data_attr[] = 'data-autoplay='.esc_attr($autoplay);			
		$data_attr[] = 'data-desksmini='.esc_attr($desksmini);
		$data_attr[] = 'data-tablet='.esc_attr($tablet);
		$data_attr[] = 'data-tabletmini='.esc_attr($tabletmini);
		$data_attr[] = 'data-mobile='.esc_attr($mobile);
		$data_attr[] = 'data-mobilesmini='.esc_attr($mobilesmini);
		$data_attr[] = 'data-columns='.esc_attr($columns);
		$data_attr[] = 'data-slider=1';
	}

	ob_start(); ?>
	<div class="alus-testimonials-shortcode <?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo esc_attr(implode(' ', $data_attr)) ?>>
		<?php if ( $title != '' ): ?>
			<div class="section-title">
				<h2 class="section-title-main"><?php echo esc_html( $title ); ?></h2>
			</div>
		<?php endif ?>
		<div class="meta-slider">
			<div class="testimonial">
				<?php echo do_shortcode( $content ); ?>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode('alus_testimonials', 'alus_testimonials_shortcode');

function alus_testimonial_shortcode( $atts, $content = ''){
	extract(shortcode_atts(array(
		'image'				=> ''
		,'img_width'				=> '80'
		,'image_position'		=> 'top'
		,'name'					=> ''
		,'company'				=> ''
		,'extra_class'			=> ''
	), $atts ));

	$classes = array();
	$classes[] = $extra_class;
	$classes[] = 'testimonial-item';
	$classes[] = 'testimonial-image-'.$image_position;

	ob_start(); ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="testimonial-wrapper">
			<div class="avatar" style="width: <?php echo  $img_width.'px' ?>">
				<?php echo wp_get_attachment_image($image, 'thumbnail', 0, array('class'=>'img')); ?>
			</div>
			<div class="content">
				<span class="excerpt">
					<?php echo do_shortcode( $content ); ?>
				</span>
				<div class="name">
					<?php echo esc_html( $name ); ?>
					<?php if ( $company ): ?>
						<span class="company"><?php echo esc_html( $company ); ?></span>
					<?php endif ?>
				</div>
			</div>	
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode('alus_testimonial', 'alus_testimonial_shortcode');

/*** Shortcode Banner ***/
function alus_banner_shortcode( $atts, $content = '' ){
	extract(shortcode_atts(array(
		'bg_image'					=> ''
		,'image_size'				=> 'full'
		,'overlay'					=> ''
		,'hover_effect' 			=> 'none'		
		,'position_content'			=> 'center-center'
		,'content_width'			=> '100'
		,'content_bg'				=> ''
		,'link'						=> ''		
		,'target' 					=> '_blank'
		,'extra_class'				=> ''
	), $atts ));

	if( $image_size == '' ){
		$image_size = 'full';
	}
	$classes = array();
	$classes[] = $position_content;
	if( $hover_effect != 'none' ){
		$classes[] = 'has-hover';
		$classes[] = 'image-hover-'.$hover_effect;
	}
	$classes[] = $extra_class;

	$link = ( $link =='||' ) ? '' : $link;
	$attr = vc_build_link( $link );
	$link = ($attr['url'] == '') ? '' : $attr['url'];
	$title = ($attr['title'] == '') ? '' : $attr['title'];

	$styles = array();
	$styles[] = 'width: '.$content_width.'%';
	if( $content_bg !='' ){
		$styles[] = 'background-color: '.$content_bg;
	}

	ob_start();
	?>
	<div class="alus-banner-shortcode <?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="alus-banner-content">
			<div class="image">
				<?php if( $link != '' ): ?>
					<a title="<?php echo esc_attr($title) ?>" target="<?php echo esc_attr($target); ?>" class="banner-link" href="<?php echo esc_url($link) ?>" >
					<?php endif; ?>
					<?php echo wp_get_attachment_image($bg_image, $image_size, 0); ?>
					<?php if( $link != '' ): ?>
					</a>
				<?php endif; ?>
				<div class="overlay" style="<?php echo esc_html($overlay ? 'background-color:'.$overlay : ''); ?> "></div>
			</div>
			<div class="content" style="<?php echo esc_attr(implode(';', $styles)) ?>">
				<?php 
				$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
				echo do_shortcode( shortcode_unautop( $content ) );
				?>
			</div>
		</div>
	</div>
	<?php

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('alus_banner', 'alus_banner_shortcode');

/*** Shortcode Images Gallery ***/
if( !function_exists('alus_images_gallery_shortcode') ){
	function alus_images_gallery_shortcode( $atts ){
		extract(shortcode_atts(array(
			'images'			=> ''
			,'image_size'			=> 'thumbnail'
			,'layout'			=> 'grid'
			,'columns'			=> '3'
			,'margin'			=> '30'
			,'nav'				=> 0
			,'dots'				=> 0
			,'autoplay'			=> 0
			,'action'			=> ''
			,'custom_links'		=> ''						
			,'target' 			=> '_blank'
			,'desksmini'	=> '2'
			,'tablet'     	=> '2'
			,'tabletmini'	=> '2'
			,'mobile'		=> '1'
			,'mobilesmini'	=> '1'
		), $atts ));

		$images = str_replace(' ', '', $images);
		if( $images == '' ){
			return;
		}
		$images = explode(',', $images);

		if( $image_size == '' ){
			$image_size = 'full';
		}

		$classes = array();
		$classes[] = 'layout-'.$layout;
		if( $layout == 'grid' ) {
			$classes[] = 'columns-'.$columns;
		}
		if ($action == 'lightbox') {
			$classes[] = 'lightbox';
		}
		if ($action == 'links'){
			$custom_links = ( $custom_links =='||' ) ? '' : $custom_links;
			$custom_links = vc_build_link( $custom_links );
			$custom_links = $custom_links['url'];
		}

		$data_attr = array();
		if ($layout == 'slider'){
			$data_attr[] = 'data-margin='.esc_attr($margin);
			$data_attr[] = 'data-nav='.esc_attr($nav);
			$data_attr[] = 'data-dots='.esc_attr($dots);
			$data_attr[] = 'data-autoplay='.esc_attr($autoplay);			
			$data_attr[] = 'data-desksmini='.esc_attr($desksmini);
			$data_attr[] = 'data-tablet='.esc_attr($tablet);
			$data_attr[] = 'data-tabletmini='.esc_attr($tabletmini);
			$data_attr[] = 'data-mobile='.esc_attr($mobile);
			$data_attr[] = 'data-mobilesmini='.esc_attr($mobilesmini);
			$data_attr[] = 'data-columns='.esc_attr($columns);
		}
		ob_start();
		?>
		<div class="alus-images-shortcode <?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo esc_attr(implode(' ', $data_attr)) ?>>
			<div class="images-gallery">
				<?php 
				if (is_array($images) || is_object($images)):
					foreach( $images as $index => $img_id ):
						$attachment = get_post( $img_id );
						$title = trim( strip_tags( $attachment->post_title ) ); 

						if ($action == 'lightbox'){
							$custom_links = wp_get_attachment_image_src( $img_id, 'large' );
							$custom_links = $custom_links[0];
						}
						?>
						<div class="images-gallery-item">
							<?php if ( $action != '' ): ?>
								<a href="<?php echo esc_url( $custom_links ); ?>" target="<?php echo esc_attr($target); ?>" title="<?php echo esc_attr( $title ); ?>">
								<?php endif; ?>

								<?php echo wp_get_attachment_image($img_id, $image_size, 0); ?>

								<?php if ( $action != '' ): ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endforeach ?>
				<?php endif; ?>
			</div>
		</div>
		<?php

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode('alus_images_gallery', 'alus_images_gallery_shortcode');
}

/*** Shortcode Brand ***/
if( !function_exists('alus_brands_slider_shortcode') ){
	function alus_brands_slider_shortcode( $atts, $content = null ){
		extract(shortcode_atts(array(
			'title'				=> ''
			,'categories' 		=> ''
			,'per_page' 		=> 7
			,'rows' 			=> 1
			,'active_link'		=> 1
			,'nav' 				=> 1
			,'autoplay' 		=> 1
			,'margin_image'		=> 30
			,'desksmini'	=> '1'
			,'tablet'     	=> '1'
			,'tabletmini'	=> '1'
			,'mobile'	=> '1'
			,'mobilesmini'	=> '1'
		), $atts));
		if( !class_exists('Alus_Brands') )
			return;

		$args = array(
			'post_type'				=> 'alus_brand'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
		);

		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$categories = explode(',', $categories);
		}
		if( is_array($categories) && count($categories) > 0 ){
			$field_name = is_numeric($categories[0])?'term_id':'slug';
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'alus_brand_cat'
					,'terms' => $categories
					,'field' => $field_name
					,'include_children' => false
				)
			);
		}

		$brands = new WP_Query($args);

		global $post;
		ob_start();
		if( $brands->have_posts() ):

			$data_attr = array();
			$data_attr[] = 'data-margin='.esc_attr($margin_image);
			$data_attr[] = 'data-nav='.esc_attr($nav);
			$data_attr[] = 'data-dots= 0';
			$data_attr[] = 'data-autoplay='.esc_attr($autoplay);			
			$data_attr[] = 'data-desksmini='.esc_attr($desksmini);
			$data_attr[] = 'data-tablet='.esc_attr($tablet);
			$data_attr[] = 'data-tabletmini='.esc_attr($tabletmini);
			$data_attr[] = 'data-mobile='.esc_attr($mobile);
			$data_attr[] = 'data-mobilesmini='.esc_attr($mobilesmini);
			$data_attr[] = 'data-columns='.esc_attr($desksmini);
			$data_attr[] = 'data-slider= 1';
			?>
			<div id="brand-<?php echo rand(1, 1000); ?>" class="alus-brand-slider-shortcode" <?php echo implode(' ', $data_attr); ?>>
				<?php if( strlen($title) > 0 ): ?>
					<div class="section-title">
						<h3 class="section-title-main">
							<span><?php echo esc_html($title); ?></span>
						</h3>
					</div>
				<?php endif; ?>
				<div class="meta-slider loading">
					<div class="brands owl-carousel">
						<?php 
						$count = 0;
						while( $brands->have_posts() ): $brands->the_post(); 
							if( $rows > 1 && $count % $rows == 0 ){
								echo '<div class="brand">';
							}
							?>
							<div class="item">
								<?php if( $active_link ):
								$brand_url = get_post_meta($post->ID, 'alus_brand_url', true);
								$brand_target = get_post_meta($post->ID, 'alus_brand_target', true);
								?>
								<a href="<?php echo esc_url($brand_url); ?>" target="<?php echo esc_attr($brand_target); ?>">
								<?php endif; ?>
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('alus_brand_thumb');
								}
								?>
								<?php if( $active_link ): ?>
								</a>
							<?php endif; ?>
						</div>
						<?php 
						if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $count_posts - 1) ){
							echo '</div>';
						}
						$count++;
					endwhile; 
					?>
				</div>
			</div>
		</div>

		<?php
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}
}
add_shortcode('alus_brands_slider', 'alus_brands_slider_shortcode');

/************************************
*** Element Shortcodes
*************************************/

/*** Shortcode Blog ***/
if( !function_exists('alus_blogs_shortcode') ){
	function alus_blogs_shortcode( $atts, $content = null){
		extract(shortcode_atts(array(
			'blog_title'				=> ''
			,'columns'			=> '3'
			,'categories'		=> ''
			,'title'			=> 1
			,'limit'			=> 5
			,'orderby'			=> 'none'
			,'order'			=> 'DESC'
			,'thumbnail'	=> 1
			,'author'		=> 0
			,'date'		=> 1
			,'comment'		=> 1
			,'excerpt'		=> 1
			,'view'			=> 0
			,'readmore'		=> 1
			,'excerpt_words'	=> 20
			,'layout'			=> 'grid'
			,'nav'			=> 1
			,'dots'			=> 0
			,'autoplay'		=> 0
			,'margin'			=> 30
			,'load_more'	=> 0
			,'load_more_text'	=> 'Show more'
			,'desksmini'	=> '3'
			,'tablet'     	=> '2'
			,'tabletmini'	=> '2'
			,'mobile'		=> '1'
			,'mobilesmini'	=> '1'
		), $atts));
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 20;
		}
		
		$slider = 0;
		$masonry = 0;
		if( $layout == 'slider' ){
			$slider = 1;
		}
		if( $layout == 'masonry' ){
			$masonry = 1;
		}
		
		$columns = absint($columns);
		if( !in_array($columns, array(1, 2, 3, 4, 6)) ){
			$columns = 4;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> $limit
			,'orderby'				=> $orderby
			,'order'				=> $order
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'category'
						,'terms' => $ar_categories
						,'field' => $field_name
						,'include_children' => false
					)
				);
			}
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		ob_start();
		if( $posts->have_posts() ):
			if( $posts->post_count <= 1 ){
				$slider = 0;
			}
			if( $slider ){
				$load_more = 0;
			}

			$atts = compact('slider', 'categories', 'limit', 'orderby', 'order', 'columns', 'title', 'thumbnail', 'author' ,'date', 'comment', 'excerpt', 'readmore','view', 'excerpt_words'
				, 'load_more');
			
			$classes = array();
			$data_attr = array();
			$classes[] = 'alus-blogs-shortcode';
			if( $slider ){
				$classes[] = 'slider';
				$data_attr[] = 'data-slider='.esc_attr($slider);
				$data_attr[] = 'data-columns='.esc_attr($columns);
				$data_attr[] = 'data-nav='.esc_attr($nav);
				$data_attr[] = 'data-dots='.esc_attr($dots);
				$data_attr[] = 'data-autoplay='.esc_attr($autoplay);
				$data_attr[] = 'data-margin='.esc_attr($margin);
				$data_attr[] = 'data-desksmini='.esc_attr($desksmini);
				$data_attr[] = 'data-tablet='.esc_attr($tablet);
				$data_attr[] = 'data-tabletmini='.esc_attr($tabletmini);
				$data_attr[] = 'data-mobile='.esc_attr($mobile);
				$data_attr[] = 'data-mobilesmini='.esc_attr($mobilesmini);
			} 
			if($masonry){
				$classes[] = 'masonry';
			}
			if( !$slider && $load_more ){
				$classes[] = 'has-load-more';
				$data_attr[] = 'data-atts='.htmlentities(json_encode($atts));
			}

			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo esc_attr(implode(' ', $data_attr)); ?>>
				<?php if( strlen($blog_title) > 0 ): ?>
					<div class="section-title">
						<h3 class="section-title-main"><span><?php echo esc_html($blog_title); ?></span></h3>
					</div>
				<?php endif; ?>
				<div class="meta-slider <?php echo ($slider)?'loading':''; ?>">
					<div class="blogs <?php if ($slider){ ?> owl-carousel <?php } ?>">
						<?php alus_get_blog_items_content_shortcode($atts, $posts); ?>
					</div>
					<?php if( $load_more ): ?>
						<div class="load-more-wrapper">
							<a href="#" class="load-more button" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}	
}
add_shortcode('alus_blogs', 'alus_blogs_shortcode');

add_action('wp_ajax_alus_blogs_load_items', 'alus_get_blog_items_content_shortcode');
add_action('wp_ajax_nopriv_alus_blogs_load_items', 'alus_get_blog_items_content_shortcode');
if( !function_exists('alus_get_blog_items_content_shortcode') ){
	function alus_get_blog_items_content_shortcode($atts, $posts = null){

		global $post;

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;

			extract($atts);

			$args = array(
				'post_type' 			=> 'post'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts' 	=> 1
				,'posts_per_page'		=> $limit
				,'orderby'				=> $orderby
				,'order'				=> $order
				,'paged'				=> $paged
			);

			$categories = str_replace(' ', '', $categories);
			if( strlen($categories) > 0 ){
				$categories = explode(',', $categories);
			}
			if( is_array($categories) && count($categories) > 0 ){
				$field_name = is_numeric($categories[0])?'term_id':'slug';
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'category'
						,'terms' => $categories
						,'field' => $field_name
						,'include_children' => false
					)
				);
			}

			$posts = new WP_Query($args);
			ob_start();
		}

		extract($atts);

		if( $posts->have_posts() ):
			$item_class = '';
			if( !$slider ){
				$item_class = 12/(int)$columns;
				$item_class = 'col-sm-'.$item_class;
			}
			$key = -1;
			while( $posts->have_posts() ): $posts->the_post();

				$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
				if( $slider && $post_format == 'gallery' ){ /* Remove Slider in Slider */
					$post_format = false;
				}

				$key++;
				$item_extra_class = ($key % $columns == 0)?'first':(($key % $columns == $columns - 1)?'last':'');
				$post_class = array();
				$post_class[] = $item_class;
				$post_class[] = 'item post-item hentry';
				$post_class[] = $item_extra_class;					
				$post_class[] = $post_format;					
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($post_class) ?>>
					<header class="entry-header">
						<?php if( $thumbnail ): ?>
							<?php umbala_post_thumb( array( 'size' => 'full', 'class' => '' ) ); ?>
						<?php endif; ?>
					</header>

					<?php if( $post_format != 'quote' ): ?>
						<div class="entry-content">

							<?php if( $title ): ?>
								<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php endif; ?>

							<?php if( $date ): ?>
								<div class="date-time">
									<i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?>
								</div>
							<?php endif;?>

							<?php if( $comment ): ?>
								<?php 
								if ( get_comments_number() == 0 ) {
									$comments = esc_html__( 'No Comments', 'umbala' );
								} elseif ( get_comments_number() > 1 ) {
									$comments = sprintf( esc_html__( '%s Comments', 'umbala' ), get_comments_number() );
								} else {
									$comments = esc_html__( '1 Comment', 'umbala' );
								}
								echo '<a class="comment" href="' . get_comments_link() . '"> <i class="fa fa-comments"></i> ' . $comments . '</a>';
								?>
							<?php endif; ?>

							<?php if( $view ): ?>
								<span class="count-view"><?php esc_html_e('View: ','alura-studio');?><?php echo umbala_get_post_views(get_the_ID()); ?></span>
							<?php endif; ?>

							<div class="clear"></div>

							<?php if( $excerpt && function_exists('umbala_the_excerpt_max_words') ): ?>
								<div class="entry-info"><p><?php umbala_the_excerpt_max_words($excerpt_words, true, '...', true); ?></p></div>
							<?php endif; ?>

							<?php if( $readmore ): ?>
								<a href="<?php the_permalink(); ?>" class="button-readmore"><?php esc_html_e('Continue Reading','alura-studio') ?></a>
							<?php endif; ?>

							<?php if( $author ): ?>
								<span class="vcard author"><?php esc_html_e('Post by: ','alura-studio') ?><?php the_author_posts_link(); ?></span>
							<?php endif; ?>
							
						</div>

					<?php else: /* Post format is quote */ ?>
						<div class="alus-blockquote">
							<blockquote class="blockquote-bg">
								<?php 
								$quote_content = get_the_excerpt();
								if( !$quote_content ){
									$quote_content = get_the_content();
								}
								echo do_shortcode($quote_content);
								?>
							</blockquote>
							<div class="blockquote-meta">
								<?php if( $date ): ?>
									<span class="date-time">
										<i class="fa fa-calendar"></i>
										<?php echo get_the_time(get_option('date_format')); ?>
									</span>
								<?php endif; ?>

								<?php if( $author ): ?>
									<span class="author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
								<?php endif; ?>
							</div>
						</div>

					<?php endif; ?>
				</article>
				<?php 
			endwhile;
		endif;

		wp_reset_postdata();

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}

	}
}

/* Alus Google Map shortcode */
if( !function_exists('alus_google_map_shortcode') ){
	function alus_google_map_shortcode($atts, $content = ''){
		extract(shortcode_atts(array(
			'address'				=> ''
			,'height'			=> 400
			,'zoom'				=> 12
			,'icon'				=> ''
			,'styles'			=> ''
			,'show_content'		=> 0
			,'content_text'		=> 'dark'
			,'content_bg'		=> '#ffffff'
			,'content_width'	=> '230'
			,'content_position_x'	=> '50'
			,'content_position_y'	=>	'20'
		), $atts));

		wp_enqueue_script('gmap-api');
		$id = rand();
		if ($icon){
			$url = wp_get_attachment_image_src( $icon );
			$icon = $url[0];
		}
		
		$style ='';
		if ($content_width != ''){
			$style .= 'width:'.$content_width.'px;';
		}
		else{
			$style .= 'width: auto;';
		}

		if ($content_position_x != ''){
			$style .= ' left:'.$content_position_x.'%;';
		}

		if ($content_position_y != ''){
			$style .= ' top:'.$content_position_y.'%;';
		}
		if ($content_bg != ''){
			$style .= ' background-color:'.$content_bg.';';
		}

		ob_start();	
		?>
		<div class="google-map-container" style="height:<?php echo esc_attr($height); ?>px">
			<div id ="google-map-<?php echo esc_attr( $id ); ?>" class="google-map-<?php echo esc_attr( $id ); ?> google-map-wrapper"></div>
			<?php if( $show_content && $content != '' ): ?>
				<div class="google-map-content <?php echo esc_html($content_text); ?>" style="<?php echo esc_attr($style); ?>">
					<?php echo do_shortcode( $content ); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
		wp_add_inline_script( 'umbala-global','jQuery(document).ready(function(){
			google.maps.event.addDomListener(window, "load", init);
			google.maps.event.addDomListener(window, "resize", init);

			function init() {

				var mapOptions = {
					zoom: '.$zoom.',
					center: new google.maps.LatLng(44.5403, -78.5463),
				};
				var mapElement = document.getElementById("google-map-'.esc_js( $id ).'");
				var map = new google.maps.Map(mapElement, mapOptions);

				var styledMapType = new google.maps.StyledMapType('.rawurldecode( base64_decode($styles, true) ).');
				map.mapTypes.set("styled_map", styledMapType);
				map.setMapTypeId("styled_map");

				var geocoder = new google.maps.Geocoder();
				geocoder.geocode( {address: "'.$address.'"}, function(results, status) {
					if( status == google.maps.GeocoderStatus.OK ){
						var _ret_array =  new Array(results[0].geometry.location.lat(),results[0].geometry.location.lng());
						map.setCenter(results[0].geometry.location);
						var marker = new google.maps.Marker({
							position: results[0].geometry.location,
							animation: google.maps.Animation.DROP,
							map: map,
							title: "",
							icon:"'.$icon.'"
						});
					}
				});
			}
		});', 'after');

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
add_shortcode('alus_google_map', 'alus_google_map_shortcode');

/* Alus Countdown shortcode */
if( !function_exists('alus_countdown_shortcode') ){
	function alus_countdown_shortcode( $atts ){
		extract( shortcode_atts(array(
			'date'				=> '2018/12/12'
			,'text_color_style'	=> 'text-default'
		), $atts)
	);
		$date = str_replace( '/', '-', $date );

		ob_start();
		?>

		<div class="alus-countdown <?php echo esc_attr($text_color_style) ?>">
			<div class="countdown-timer" data-countdown="<?php echo esc_attr( $date ) ?>"></div>
		</div>

		<?php
		return ob_get_clean();
	}
}
add_shortcode('alus_countdown', 'alus_countdown_shortcode');

/* Counter Up shortcode */
if( !function_exists('alus_counter_shortcode') ){
	function alus_counter_shortcode( $atts ){
		extract( shortcode_atts(array(
			'number'			=> 0
			,'meta'			=> ''
			,'text_color_style'	=> 'text-default'
		), $atts)
	);

		if( !is_numeric($number) ){
			$number = 0;
		}

		ob_start();
		?>
		<div class="alus-counter <?php echo esc_attr($text_color_style) ?>">
			<span class="number">
				<?php echo esc_html($number); ?>
			</span>
			<h3 class="meta">
				<?php echo esc_html($meta); ?>
			</h3>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('alus_counter', 'alus_counter_shortcode');


/******  Woocommerce shortcodes  ******/

/*** Products Shortcode ***/
if( !function_exists('alus_products_shortcode') ){
	function alus_products_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title'					=> ''
			,'product_layout'		=> 'grid'
			,'style'				=> ''
			,'product_type'			=> 'recent'
			,'orderby'				=> ''
			,'order'				=> ''
			,'rows' 				=> 1
			,'columns' 				=> 4
			,'per_page' 			=> 5
			,'product_cats'			=> ''
			,'show_countdown'		=> 0
			,'show_load_more'		=> 0
			,'load_more_text'		=> 'Show more'
			,'nav'					=> 1
			,'dots'					=> 0
			,'autoplay'				=> 0
			,'margin'				=> 30
			,'desksmini'			=> 4
			,'tablet'				=> 3
			,'tabletmini'			=> 2
			,'mobile'				=> 2
			,'mobilesmini'			=> 1

		), $atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}

		$is_slider = $is_masonry = 0;
		if( $product_layout == 'slider' ){
			$is_slider = 1;
		}
		if( $product_layout == 'masonry' ){
			$is_masonry = 1;
		}

		if( $show_countdown ){
			add_action('alus_after_shop_loop_item', 'alus_template_loop_time_deals', 65);
		}
		if( function_exists('umbala_remove_woocommerce_hook') ){
			umbala_remove_woocommerce_hook();
		}

		$args = array(
			'post_type'				=> 'product'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'meta_query' 			=> WC()->query->get_meta_query()
			,'tax_query'           	=> WC()->query->get_tax_query()
		);			
		if( ! empty( $order) || ! empty( $orderby ) ){
			if( ! empty( $order ) ){
				$args['order'] = $order;
			}
			if( ! empty( $orderby ) ){
				$args['order'] = $orderby;
			}
		}
		else{
			alus_filter_product_by_product_type($args, $product_type);
		}

		$product_cats = str_replace(' ', '', $product_cats);
		if( strlen($product_cats) > 0 ){
			$product_cats = explode(',', $product_cats);
		}
		if( is_array($product_cats) && count($product_cats) > 0 ){
			$field_name = is_numeric($product_cats[0])?'term_id':'slug';
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat'
					,'terms' => $product_cats
					,'field' => $field_name
					,'include_children' => false
				)
			);
		}

		ob_start();
		global $woocommerce_loop;
		if( (int)$columns <= 0 ){
			$columns = 4;
		}
		$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$woocommerce_loop['columns'] = $columns;	

		$products = new WP_Query( $args );	

		$classes = array();
		$classes[] = 'alus-product-shortcode';
		$classes[] = 'is-'.$product_layout;
		$classes[] = 'product-style-shortcode';
		$classes[] = 'is-'.$style;
		if ($style == 'shade'){
			$classes[] = 'is-overlay';

		}

		$atts = compact('title', 'rows', 'columns', 'is_slider', 'is_masonry', 'product_cats', 'show_countdown', 'per_page', 'orderby', 'order', 'custom_order', 'show_load_more', 'load_more_text', 'nav', 'dots', 'autoplay', 'margin', 'desksmini', 'tablet', 'tabletmini', 'mobile', 'mobilesmini');

		if( $products->have_posts() ): ?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<div class="section-title">
				<?php if( strlen($title) > 0 ): ?>
					<h3 class="section-title-main"><span><?php echo esc_html($title); ?></span></h3>
				<?php endif; ?>
			</div>
			<div class="meta-slider <?php echo ($is_slider)?'loading':''; ?>">
				<?php woocommerce_product_loop_start(); ?>

				<?php alus_products_items_content_shortcode($atts,$products); ?>

				<?php woocommerce_product_loop_end(); ?>
				<?php if( $show_load_more && ! $is_slider ): ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
				<?php endif; ?>
			</div>

		</div>
		<?php
	endif;
	
	remove_action('alus_after_shop_loop_item', 'alus_template_loop_time_deals', 65);
	wp_reset_postdata();

	$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
	return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
}	
}
add_shortcode('alus_products', 'alus_products_shortcode');

add_action('wp_ajax_alus_products_load_items', 'alus_products_items_content_shortcode');
add_action('wp_ajax_nopriv_alus_products_load_items', 'alus_products_items_content_shortcode');
if( !function_exists('alus_products_items_content_shortcode') ){
	function alus_products_items_content_shortcode($atts, $products = null){

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;

			extract($atts);

			if( $show_countdown ){
				add_action('alus_after_shop_loop_item', 'alus_template_loop_time_deals', 65);
			}
			if( function_exists('umbala_remove_woocommerce_hook') ){
				umbala_remove_woocommerce_hook();
			}

			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
				,'paged'				=> $paged
			);			
			if( ! empty( $order) || ! empty( $orderby ) ){
				if( ! empty( $order ) ){
					$args['order'] = $order;
				}
				if( ! empty( $orderby ) ){
					$args['order'] = $orderby;
				}
			}
			else{
				alus_filter_product_by_product_type($args, $product_type);
			}

			$product_cats = str_replace(' ', '', $product_cats);
			if( strlen($product_cats) > 0 ){
				$product_cats = explode(',', $product_cats);
			}
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$field_name = is_numeric($product_cats[0])?'term_id':'slug';
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat'
						,'terms' => $product_cats
						,'field' => $field_name
						,'include_children' => false
					)
				);
			}

			ob_start();
			global $woocommerce_loop;
			if( (int)$columns <= 0 ){
				$columns = 4;
			}
			$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;	

			$products = new WP_Query( $args );

		}
		extract($atts);
		
		$count = 0;
		while( $products->have_posts() ): $products->the_post();
			
			if( $rows > 1 && $count % $rows == 0 ){
				echo '<div class="product-group">';
			}
			
			wc_get_template_part( 'content', 'product' );
			
			if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
				echo '</div>';
			}
			$count++;
			
		endwhile; 

		remove_action('alus_after_shop_loop_item', 'alus_template_loop_time_deals', 65);
		wp_reset_postdata();

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}

	}
}

/*** Products Widget ***/
if( !function_exists('alus_products_widget_shortcode') ){
	function alus_products_widget_shortcode($atts, $content){

		if( !class_exists('Umbala_Products_Widget') ){
			return;
		}

		extract(shortcode_atts(array(
			'product_type'			=> 'recent'
			,'rows' 				=> 3
			,'per_page' 			=> 6
			,'product_cats'			=> ''
			,'title' 				=> ''
			,'show_image' 			=> 1
			,'thumbnail_size'               => 'shop_thumbnail'
			,'show_title' 			=> 1
			,'show_price' 			=> 1
			,'show_rating' 			=> 1	
			,'show_categories'		=> 0	
			,'is_slider'			=> 0
			,'show_nav'				=> 1
			,'auto_play'			=> 1
		), $atts));	
		if( trim($product_cats) != '' ){
			$product_cats = array_map('trim', explode(',', $product_cats));
		}

		$instance = array(
			'title'					=> $title
			,'product_type'			=> $product_type
			,'product_cats'			=> $product_cats
			,'row'					=> $rows
			,'limit'				=> $per_page
			,'show_thumbnail' 		=> $show_image
			,'thumbnail_size' 		=> $thumbnail_size
			,'show_categories' 		=> $show_categories
			,'show_product_title' 	=> $show_title
			,'show_price' 			=> $show_price
			,'show_rating' 			=> $show_rating
			,'is_slider'			=> $is_slider
			,'show_nav' 			=> $show_nav
			,'auto_play' 			=> $auto_play
		);

		ob_start();
		the_widget('Umbala_Products_Widget', $instance);
		return ob_get_clean();
	}
}
add_shortcode('alus_products_widget', 'alus_products_widget_shortcode');

/* Product Category Shortcode */
if( !function_exists('alus_product_categories_shortcode') ){
	function alus_product_categories_shortcode($atts, $content){
		extract(shortcode_atts(array(
			'title'				=> ''
			,'layout'			=> 'grid'
			,'per_page' 		=> 5
			,'columns' 			=> 4
			,'rows' 			=> 1
			,'ids'	 			=> ''
			,'hide_empty'		=> 0
			,'show_title'		=> 1
			,'show_description' => 0
			,'show_nav' 		=> 1
			,'dots' 			=> 0
			,'auto_play' 		=> 0
			,'margin'			=> 30
			,'desksmini'		=> 4
			,'tablet'     		=> 3
			,'tabletmini'		=> 3
			,'mobile'			=> 2
			,'mobilesmini'		=> 1
		),$atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}	

		add_filter('subcategory_archive_thumbnail_size', 'alus_product_cat_thumbnail_size_filter', 10);

		$args = array(
			'orderby'     => 'name'
			,'order'      => 'ASC'
			,'hide_empty' => $hide_empty
			,'include'    => array_map('trim', explode(',', $ids))
			,'pad_counts' => true
			,'parent'     => ''
			,'number'     => $per_page
		);
		$product_categories = get_terms('product_cat', $args);	
		global $woocommerce_loop;
		$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$woocommerce_loop['columns'] = $columns;	

		ob_start();

		$classes = array();
		$classes[] = 'woocommerce';
		$classes[] = 'alus-product-categories-shortcode';
		$classes[] = 'layout-'.$layout;
		if ($layout == 'grid' )
		$classes[] = 'columns-'.$columns;

		if( count($product_categories) > 0 ):
			$data_attr = array();
			$data_attr[] = 'data-nav='.$show_nav;
			$data_attr[] = 'data-dots='.$dots;
			$data_attr[] = 'data-autoplay='.$auto_play;
			$data_attr[] = 'data-margin='.$margin;
			$data_attr[] = 'data-columns='.$columns;
			$data_attr[] = 'data-desksmini='.$desksmini;
			$data_attr[] = 'data-tablet='.$tablet;
			$data_attr[] = 'data-tabletmini='.$tabletmini;
			$data_attr[] = 'data-mobile='.$mobile;
			$data_attr[] = 'data-mobilesmini='.$mobilesmini;
			$data_attr[] = 'data-slider= 1';
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
				<div class="section-title">
					<?php if( strlen($title) > 0 ): ?>
						<h3 class="section-title-main-title"><span><?php echo esc_html($title); ?></span></h3>
					<?php endif; ?>
				</div>
				<div class="meta-slider <?php echo ($layout == 'slider') ? 'loading' : '' ?>">
					<?php 
					woocommerce_product_loop_start();
					$count_all = count($product_categories);
					$count = 0;
					foreach ( $product_categories as $category ) {
						if( $rows > 1 && $count % $rows == 0 ){
							echo '<div class="product-cat-group">';
						}
						wc_get_template( 'content-product_cat.php', array(
							'category' 		=> $category
							,'show_title' 	=> $show_title
							,'show_description' 	=> $show_description
						) );
						if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $count_all - 1) ){
							echo '</div>';
						}
						$count++;
					}
					woocommerce_product_loop_end();
					woocommerce_reset_loop();
					?>
				</div>
			</div>
			<?php
		endif;

		remove_filter('subcategory_archive_thumbnail_size', 'alus_product_cat_thumbnail_size_filter', 10);
		$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;

		$output = ob_get_clean();
		return $output;			
	}
}
add_shortcode('alus_product_categories', 'alus_product_categories_shortcode');

if( !function_exists('alus_product_cat_thumbnail_size_filter') ){
	function alus_product_cat_thumbnail_size_filter( $size ){
		return 'alus_product_cat_thumb';
	}
}

/* Product Deals */
if( !function_exists('alus_products_deals_shortcode') ){
	function alus_products_deals_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title'					=> ''
			,'product_layout'		=> 'grid'
			,'style'				=> ''
			,'product_type'			=> 'recent'
			,'orderby'				=> ''
			,'order'				=> ''
			,'rows' 				=> 1
			,'columns' 				=> 4
			,'per_page' 			=> 5
			,'product_cats'			=> ''
			,'show_countdown'		=> 0
			,'show_gallery'			=> 0
			,'show_description'		=> 0
			,'show_load_more'		=> 0
			,'load_more_text'		=> 'Show more'
			,'nav'					=> 1
			,'dots'					=> 0
			,'autoplay'				=> 0
			,'margin'				=> 30
			,'desksmini'			=> 4
			,'tablet'				=> 3
			,'tabletmini'			=> 2
			,'mobile'				=> 2
			,'mobilesmini'			=> 1

		), $atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}

		$is_slider = $is_masonry = 0;
		if( $product_layout == 'slider' ){
			$is_slider = 1;
		}
		if( $product_layout == 'masonry' ){
			$is_masonry = 1;
		}

		if( $show_countdown ){
			add_action('woocommerce_after_shop_loop_item', 'alus_template_loop_time_deals', 110);
		}

		if( $show_gallery ){
			add_action('woocommerce_after_shop_loop_item', 'alus_template_loop_thumb_list', 1000);			
		} 
		if( $show_description ){
			add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description', 65);
		}

		$args = array(
			'post_type'				=> array('product', 'product_variation')
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> -1
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'meta_query' => array(
				array(
					'key'		=> '_sale_price_dates_to'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '>'
					,'type'		=> 'numeric'
				)
				,array(
					'key'		=> '_sale_price_dates_from'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '<'
					,'type'		=> 'numeric'
				)
			)
			,'tax_query'		=> array()
		);

		alus_filter_product_by_product_type($args, $product_type);

		$array_product_cats = array();

		$product_cats = str_replace(' ', '', $product_cats);
		if( strlen($product_cats) > 0 ){
			$array_product_cats = explode(',', $product_cats);
		}			

		ob_start();
		global $woocommerce_loop, $post, $product;
		if( (int)$columns <= 0 ){
			$columns = 5;
		}
		$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$woocommerce_loop['columns'] = $columns;

		$product_ids_on_sale = array();

		$products = new WP_Query( $args );	

		if( $products->have_posts() ){
			while( $products->have_posts() ){
				$products->the_post();
				if( $post->post_type == 'product' ){
					$_product = wc_get_product( $post->ID );
					if( is_object( $_product ) && $_product->is_visible() ){
						if( !empty($array_product_cats) ){
							$field_name = is_numeric($array_product_cats[0])?'ids':'slug';
							$post_terms = wp_get_post_terms($post->ID, 'product_cat', array('fields' => $field_name));
							if( is_array($post_terms) ){
								$array_intersect = array_intersect($post_terms, $array_product_cats);
								if( !empty($array_intersect) ){
									$product_ids_on_sale[] = $post->ID;
								}
							}
						}
						else{
							$product_ids_on_sale[] = $post->ID;
						}
					}
				} else {
					$post_parent_id = $post->post_parent;
					$parent_product = wc_get_product( $post_parent_id );
					if( is_object( $parent_product ) && $parent_product->is_visible() ){
						if( !empty($array_product_cats) ){
							$field_name = is_numeric($array_product_cats[0])?'ids':'slug';
							$post_terms = wp_get_post_terms($post_parent_id, 'product_cat', array('fields' => $field_name));
							if( is_array($post_terms) ){
								$array_intersect = array_intersect($post_terms, $array_product_cats);
								if( !empty($array_intersect) ){
									$product_ids_on_sale[] = $post_parent_id;
								}
							}
						}
						else{
							$product_ids_on_sale[] = $post_parent_id;
						}
					}
				}
				$product_ids_on_sale = array_unique($product_ids_on_sale);
				if( count($product_ids_on_sale) == $per_page ){
					break;
				}
			}
		}

		if( count($product_ids_on_sale) == 0 ){
			$product_ids_on_sale = array(0);
		}

		$args = array(
			'post_type'				=> 'product'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'post__in'				=> $product_ids_on_sale
			,'meta_query' 			=> WC()->query->get_meta_query()
			,'tax_query'           	=> WC()->query->get_tax_query()
		);

		alus_filter_product_by_product_type($args, $product_type);

		$products = new WP_Query($args);

		$classes = array();
		$classes[] = 'alus-products-deals-shortcode alus-product-shortcode';
		$classes[] = 'is-'.$product_layout;
		$classes[] = 'product-style-shortcode';
		$classes[] = 'is-'.$style;
		if ($style == 'shade'){
			$classes[] = 'is-overlay';

		}

		$atts = compact('title', 'rows', 'columns', 'is_slider', 'is_masonry', 'product_cats', 'show_countdown', 'per_page', 'orderby', 'order', 'custom_order', 'show_load_more', 'load_more_text', 'nav', 'dots', 'autoplay', 'margin', 'desksmini', 'tablet', 'tabletmini', 'mobile', 'mobilemini');

		if( $products->have_posts() ): ?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<div class="section-title">
				<?php if( strlen($title) > 0 ): ?>
					<h3 class="section-title-main"><span><?php echo esc_html($title); ?></span></h3>
				<?php endif; ?>
			</div>
			<div class="meta-slider">
				<?php woocommerce_product_loop_start(); ?>

				<?php while( $products->have_posts() ): $products->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>							
				<?php endwhile; ?>		

				<?php woocommerce_product_loop_end(); ?>
			</div>

		</div>
		<?php
	endif;

		//Remove Product Deal action
	remove_action('woocommerce_after_shop_loop_item', 'alus_template_loop_thumb_list', 1000);
	remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description', 65);
	remove_action('woocommerce_after_shop_loop_item', 'alus_template_loop_time_deals', 110);
	remove_action('woocommerce_after_shop_loop_item', 'alus_template_loop_thumb_list', 1000);
	wp_reset_postdata();

	$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
	return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
}	
}
add_shortcode('alus_products_deals', 'alus_products_deals_shortcode');

if( !function_exists('alus_template_loop_thumb_list') ){
	function alus_template_loop_thumb_list(){
		global $product;
		$prod_galleries = $product->get_gallery_image_ids();

		$num_product_gallery = ((int)umbala_get_opt('alus_product_gallery_number') > 0)?(int)umbala_get_opt('alus_product_gallery_number'):3;
		if( $num_product_gallery > count($prod_galleries) ){
			$num_product_gallery = count($prod_galleries);
		}
		if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
			$has_list_image = false;
		}

		if( wp_is_mobile() ){
			$has_list_image = false;
		}

		$image_size = apply_filters('alus_loop_product_thumbnail', 'shop_catalog');

		$image_thumb_size = apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail');


		$dimensions = wc_get_image_size( $image_size );

		$dimensions_thumb = wc_get_image_size( $image_thumb_size );

		$front_img_src_thumb = '';
		if( has_post_thumbnail( $product->get_id() ) ){
			$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
			$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
			$image_obj_thumb = wp_get_attachment_image_src($post_thumbnail_id, $image_thumb_size, 0);
			if( isset($image_obj_thumb[0]) ){
				$front_img_src_thumb = $image_obj_thumb[0];
			}
			if( isset($image_obj[0]) ){
				$front_img_src = $image_obj[0];
			}
			$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
		}
		else if( wc_placeholder_img_src() ){
			$front_img_src_thumb = wc_placeholder_img_src();
		}
		echo '<div class="product-gallery-images"><ul>';
		for ((int)$i = 0; $i < $num_product_gallery; $i++) {
			$list_img_src = '';
			$alt = '';
			$image_obj = wp_get_attachment_image_src($prod_galleries[$i], $image_thumb_size, 0);
			$image_obj_hover = wp_get_attachment_image_src($prod_galleries[$i], $image_size, 0);
			if( isset($image_obj[0]) ){
				$list_img_src = $image_obj[0];
				$list_img_src_hover = $image_obj_hover[0];

				$alt = trim(strip_tags( get_post_meta($prod_galleries[$i], '_wp_attachment_image_alt', true) ));
			}
			else if( wc_placeholder_img_src() ){
				$list_img_src = wc_placeholder_img_src();
			}

			echo '<li><img src="'.esc_url($list_img_src).'" data-hover="'.esc_url($list_img_src_hover).'" class="alus_thumb_list_hover" alt="'.esc_attr($alt).'" width="'.$dimensions_thumb['width'].'" height="'.$dimensions_thumb['height'].'" /></li>';
		}
		echo '</ul></div>';
	}
}

if( !function_exists('alus_template_loop_time_deals') ){
	function alus_template_loop_time_deals(){
		global $product;
		$sale_date = '';
		$timezone = 'GMT';
		if( $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				foreach( $children as $children_id ){
					$sale_date = get_post_meta($children_id, '_sale_price_dates_to', true);
				}
			}
		} else {
			$sale_date = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
		}

		if( !$sale_date ) return;
		?>
		<div class="countdown-timer" data-countdown="<?php echo esc_attr( date( 'Y-m-d H:i:s', $sale_date ) ); ?>"></div>
		<?php
	}
}

/* Shortcode SoundCloud */
if( !function_exists('alus_soundcloud_shortocde') ){
	function alus_soundcloud_shortocde( $atts, $content ){
		extract(shortcode_atts(array(
			'params'		=> "color=ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"
			,'url'			=> ''
			,'width'		=> '100%'
			,'height'		=> '166'
			,'iframe'		=> 1
		),$atts));

		$atts = compact( 'params', 'url', 'width', 'height', 'iframe' );

		if( $iframe ){
			return alus_soundcloud_iframe_widget( $atts );
		}
		else{ 
			return alus_soundcloud_flash_widget( $atts );
		}
	}
}
add_shortcode('alus_soundcloud','alus_soundcloud_shortocde');


function alus_soundcloud_iframe_widget($options) {
	$url = 'https://w.soundcloud.com/player/?url=' . $options['url'] . '&' . $options['params'];
	$unique_class = 'alus-soundcloud-'.rand();
	$style = '.'.$unique_class.' iframe{width: '.$options['width'].'; height:'.$options['height'].'px;}';
	$style = '<style type="text/css" scoped>'.$style.'</style>';
	return '<div class="alus-soundcloud '.$unique_class.'">'.$style.'<iframe src="'.esc_url( $url ).'"></iframe></div>';
}

function alus_soundcloud_flash_widget( $options ){
	$url = 'https://player.soundcloud.com/player.swf?url=' . $options['url'] . '&' . $options['params'];

	return preg_replace('/\s\s+/', '', sprintf('<div class="alus-soundcloud"><object width="%s" height="%s">
		<param name="movie" value="%s"></param>
		<param name="allowscriptaccess" value="always"></param>
		<embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
		</object></div>', $options['width'], $options['height'], esc_url( $url ), $options['width'], $options['height'], esc_url( $url )));
}

/* Shortcode Video - Support Youtube and Vimeo video */
if( !function_exists('alus_video_shortcode') ){
	function alus_video_shortcode($atts){
		extract( shortcode_atts(array(
			'src' 		=> '',
			'height' 	=> '450',
			'width' 	=> '800'
		), $atts
	));

		if( $src == '' ){
			return;
		}

		$extra_class = '';
		if( !isset($atts['height']) || !isset($atts['width']) ){
			$extra_class = 'auto-size';
		}

		$src = alus_parse_video_link($src);
		ob_start();
		?>
		<div class="alus-video <?php echo esc_attr($extra_class); ?>" style="width:<?php echo esc_attr($width) ?>px; height:<?php echo esc_attr($height) ?>px;">
			<iframe width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($src); ?>" allowfullscreen></iframe>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('alus_video', 'alus_video_shortcode');

if( !function_exists('alus_parse_video_link') ){
	function alus_parse_video_link( $video_url ){
		if( strstr($video_url, 'youtube.com') || strstr($video_url, 'youtu.be') ){
			preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
			if( count($match) >= 2 ){
				return '//www.youtube.com/embed/' . $match[1];
			}
		}
		elseif( strstr($video_url, 'vimeo.com') ){
			preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match);
			if( count($match) >= 2 ){
				return '//player.vimeo.com/video/' . $match[1];
			}
			else{
				$video_id = explode('/', $video_url);
				if( is_array($video_id) && !empty($video_id) ){
					$video_id = $video_id[count($video_id) - 1];
					return '//player.vimeo.com/video/' . $video_id;
				}
			}
		}
		return $video_url;
	}
}
?>