<?php  

/* Filter Product */
function alus_filter_product_by_product_type( &$args = array(), $product_type = 'recent' ){
	switch( $product_type ){
		case 'sale':
		$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
		case 'featured':
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		);
		break;
		case 'best_selling':
		$args['meta_key'] 	= 'total_sales';
		$args['orderby'] 	= 'meta_value_num';
		$args['order'] 		= 'desc';
		break;
		case 'top_rated':
		$args['meta_key'] = '_wc_average_rating';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';			
		break;
		case 'mixed_order':
		$args['orderby'] 	= 'rand';
		break;
		default: /* Recent */
		$args['orderby'] 	= 'date';
		$args['order'] 		= 'desc';
		break;
	}
}


/*** Social Sharing ***/
if( !function_exists('alus_template_social_sharing') ){
	function alus_template_social_sharing(){
		?>
		<ul class="social-sharing">

			<li class="facebook">
				<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i><?php esc_html_e('Facebook', 'alura-studio'); ?></a>
			</li>

			<li class="twitter">
				<a href="https://twitter.com/home?status=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i><?php esc_html_e('Twitter', 'alura-studio'); ?></a>
			</li>

			<li class="pinterest">
				<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
				<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link); ?>" target="_blank"><i class="fa fa-pinterest"></i><?php esc_html_e('Pinterest', 'alura-studio'); ?></a>
			</li>

			<li class="google-plus">
				<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i><?php esc_html_e('Google Plus', 'alura-studio'); ?></a>
			</li>

			<li class="linkedin">
				<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-linkedin"></i><?php esc_html_e('Linkedin', 'alura-studio'); ?></a>
			</li>

			<li class="reddit">
				<a href="http://www.reddit.com/submit?url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-reddit"></i><?php esc_html_e('Reddit', 'alura-studio'); ?></a>
			</li>

		</ul>
		<?php
	}
}

add_action('wp', 'alus_template_controls');
function alus_template_controls(){
if( is_singular('product') ){
		add_filter('wp_calculate_image_sizes', '__return_false', 9999);
		add_filter('wp_calculate_image_srcset', '__return_false', 9999);
		remove_filter('the_content', 'wp_make_content_images_responsive');
	}
}
?>