<?php 

/*** Alus Brands ***/
if( !class_exists('Alus_Brands') ){
	class Alus_Brands{
		public $post_type;
		
		function __construct(){
			$this->post_type = 'alus_brand';
			
			add_action('init', array($this, 'register_post_type'));
			add_action('init', array($this, 'register_taxonomy'));
			
		}
		
		function register_post_type(){
			$labels = array(
				'name' 			=> esc_html_x( 'Brands', 'post type general name', 'alura-studio' ),
				'singular_name' 	=> esc_html_x( 'Brand', 'post type singular name', 'alura-studio' ),
				'add_new' 		=> esc_html_x( 'Add New', 'logo', 'alura-studio' ),
				'add_new_item' 		=> esc_html__( 'Add New Brand', 'alura-studio' ),
				'edit_item' 		=> esc_html__( 'Edit Brand', 'alura-studio' ),
				'new_item' 		=> esc_html__( 'New Brand', 'alura-studio' ),
				'all_items' 		=> esc_html__( 'All Brands', 'alura-studio' ),
				'view_item' 		=> esc_html__( 'View Brand', 'alura-studio' ),
				'search_items' 		=> esc_html__( 'Search Brands', 'alura-studio' ),
				'not_found' 		=>  esc_html__( 'No Brands Found', 'alura-studio' ),
				'not_found_in_trash'=> esc_html__( 'No Brands Found In Trash', 'alura-studio' ),
				'parent_item_colon' => '',
				'menu_name' 		=> esc_html__( 'Brands', 'alura-studio' )
			);
			$args = array(
				'labels' 		=> $labels,
				'public' 		=> true,
				'publicly_queryable'=> true,
				'show_ui' 		=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 		=> array( 'slug' => str_replace('alus_', '', $this->post_type) ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 		=> array( 'title', 'thumbnail' ),
				'menu_position' 	=> 5,
				'menu_icon' 		=> '',
				'menu_icon'             => 'dashicons-images-alt',
			);
			register_post_type( $this->post_type, $args );
		}
		
		function register_taxonomy(){
			$args = array(
				'labels' => array(
					'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'alura-studio' ),
					'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'alura-studio' ),
					'search_items'        => esc_html__( 'Search Categories', 'alura-studio' ),
					'all_items'           => esc_html__( 'All Categories', 'alura-studio' ),
					'parent_item'         => esc_html__( 'Parent Category', 'alura-studio' ),
					'parent_item_colon'   => esc_html__( 'Parent Category:', 'alura-studio' ),
					'edit_item'           => esc_html__( 'Edit Category', 'alura-studio' ),
					'update_item'         => esc_html__( 'Update Category', 'alura-studio' ),
					'add_new_item'        => esc_html__( 'Add New Category', 'alura-studio' ),
					'new_item_name'       => esc_html__( 'New Category Name', 'alura-studio' ),
					'menu_name'           => esc_html__( 'Categories', 'alura-studio' )
				)
				,'hierarchical' 		=> true
				,'show_ui' 				=> true
				,'show_admin_column' 	=> true
				,'query_var' 			=> true
			);
			register_taxonomy('alus_brand_cat', $this->post_type, $args);
		}
	}
}
new Alus_Brands();

/*** Alus Footer ***/
if( !class_exists('Alus_Footer') ){
	class Alus_Footer{
		public $post_type;
		
		function __construct(){
			$this->post_type = 'alus_footer';
			add_action('init', array($this, 'register_post_type'));
			add_action('wp_head', array($this, 'add_custom_css'));
		}
		
		function register_post_type(){
			$labels = array(
				'name' 				=> esc_html_x( 'Footer Block', 'post type general name', 'alura-studio' ),
				'singular_name' 	=> esc_html_x( 'Footer Block', 'post type singular name', 'alura-studio' ),
				'add_new' 			=> esc_html_x( 'Add New', 'logo', 'alura-studio' ),
				'add_new_item' 		=> esc_html__( 'Add New', 'alura-studio' ),
				'edit_item' 		=> esc_html__( 'Edit Footer Block', 'alura-studio' ),
				'new_item' 			=> esc_html__( 'New Footer', 'alura-studio' ),
				'all_items' 		=> esc_html__( 'All Footer Block', 'alura-studio' ),
				'view_item' 		=> esc_html__( 'View Footer Block', 'alura-studio' ),
				'search_items' 		=> esc_html__( 'Search Footer Block', 'alura-studio' ),
				'not_found' 		=> esc_html__( 'No Footer Found', 'alura-studio' ),
				'not_found_in_trash'=> esc_html__( 'No Footer Found In Trash', 'alura-studio' ),
				'parent_item_colon' => '',
				'menu_name' 		=> esc_html__( 'Footer Block', 'alura-studio' )
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> false,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor' ),
				'menu_position' 	=> 5,
				'menu_icon'             => 'dashicons-admin-customizer',
			);
			register_post_type( $this->post_type, $args );
		}
		
		function add_custom_css(){
			global $post;
			$args = array(
				'post_type' 		=> $this->post_type
				,'posts_per_page' 	=> -1
				,'post_status'		=> 'publish'
			);
			$posts = new WP_Query($args);
			if( $posts->have_posts() ){
				$custom_css = '';
				while( $posts->have_posts() ){
					$posts->the_post();
					$custom_css .= get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
				}
				if( !empty($custom_css) ){
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
					echo $custom_css;
					echo '</style>';
				}
			}
			wp_reset_postdata();
		}
	}
}
new Alus_Footer();


?>