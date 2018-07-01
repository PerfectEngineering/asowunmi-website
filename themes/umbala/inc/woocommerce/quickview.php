<?php 

if( umbala_get_opt('alus_enable_quickshop') && umbala_is_woocommerce_activated() && !class_exists('Umbala_Quickview') ){
	
	class Umbala_Quickview{
		
		public $id;
		
		function __construct(){
			$this->add_hook();
		}
		
		function add_hook(){
			
			add_action('woocommerce_after_shop_loop_item_title', array($this, 'quickview_button'), 10004 );
			add_action('woocommerce_after_shop_loop_item', array($this, 'quickview_button'), 100);
			
			add_action('umbala_quickshop_single_product_summary', 'woocommerce_template_single_rating', 10);
			add_action('umbala_quickshop_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			add_action('umbala_quickshop_single_product_summary', 'woocommerce_template_single_price', 30);
			if( !umbala_get_opt('alus_enable_catalog_mode') ){
				add_action('umbala_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 40); 
			}
			add_action('umbala_quickshop_single_product_summary', 'umbala_template_single_meta', 50);
			
			/* Register ajax */
			add_action('wp_ajax_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );
			add_action('wp_ajax_nopriv_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );		
		}
		
		function quickview_button(){
			global $product;
			echo '<div class="alus-quickview"> <a class="quickview" href="#quickview" data-id='.$product->get_id().'><i class="icon-magnifier"></i>'. esc_html__('Quick View', 'umbala') .'</a></div>';
		}
		
		function filter_add_to_cart_url(){
			$ref_url = wp_get_referer();
			$ref_url = remove_query_arg( array('added-to-cart','add-to-cart'), $ref_url );
			$ref_url = add_query_arg( array( 'add-to-cart' => $this->id ), $ref_url );
			return esc_url( $ref_url );
		}
		
		function filter_review_link( $review_link = '#reviews' ){
			global $product;
			$link = esc_url( get_permalink( $product->get_id() ) );
			if( $link ){
				return trailingslashit($link) . $review_link;
			}
			else{
				return $review_link;
			}
		}

		
		function load_quickshop_content_callback(){
			if( !isset($_POST['id']) ){
				die('0');
			}
			$prod_id = (int)($_POST['id']);

			global $post, $product;
			$post = get_post( $prod_id );
			$product = wc_get_product( $prod_id );

			if ( ! $product || ! $product->is_visible() )
				return;
			
			add_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			add_filter( 'umbala_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );
			
			$classes = "alus-quickshop-wrapper product type-{$product->get_type()}";
			ob_start();	
			?>		
			<div id="product-<?php echo get_the_ID();?>" <?php post_class( apply_filters('single_product_wrapper_class',$classes  ) ); ?>>
				<div class="row">
					<div class="col-md-6 col-xs-12 product-image">
						<div class="images-slider-wrapper">
							<?php	
							$attachment_ids = $product->get_gallery_image_ids();
							$attachment_count = count( $attachment_ids );
							
							?>
							<div class="image-items">
								<?php
								$attributes = array(
									'title' => esc_attr( get_the_title( get_post_thumbnail_id() ) )
								);

								if ( has_post_thumbnail() ) {

									echo '<figure class="woocommerce-product-gallery__image">' . get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), $attributes ) . '</figure>';


									if ( $attachment_count > 0 ) {
										foreach ( $attachment_ids as $attachment_id ) {
											echo '<figure class="woocommerce-product-gallery__image">' . wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) . '</figure>';
										}
									}

								} else {

									echo '<figure class="woocommerce-product-gallery__image--placeholder">' . apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'umbala' ) ), $post->ID ) . '</figure>';

								}

								?>
							</div>
							
						</div>
					</div>
					<!-- Product summary -->
					<div class="col-md-6 col-xs-12 product-summary">
						<div class="summary entry-summary">
							<h1 class="product-title product-name">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h1>
							<?php do_action('umbala_quickshop_single_product_summary'); ?>
						</div>
					</div>
				</div>
				
			</div>
			
			<?php
			remove_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			remove_filter( 'umbala_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );

			$return = ob_get_clean();
			wp_reset_postdata();
			die($return);
		}
		
	}
	new Umbala_Quickview();
}
?>