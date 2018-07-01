<?php
add_action('widgets_init', 'alus_brands_slider_load_widgets');

function alus_brands_slider_load_widgets()
{
	register_widget('Alus_Brands_Slider_Widget');
}

if( !class_exists('Alus_Brands_Slider_Widget') ){
	class Alus_Brands_Slider_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'alus-brands-slider', 'description' => esc_html__('Display your brands in a carousel slider', 'alura-studio'));
			parent::__construct('alus_brands_slider', esc_html__('Umbala - Brands Slider', 'alura-studio'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			
			if( ! shortcode_exists('alus_brands_slider') ){
				return;
			}
			
			$title 			   = esc_attr($instance['title']);
			if( empty($instance['active_link']) ){
				$instance['active_link'] = 0;
			}
			if( empty($instance['show_nav']) ){
				$instance['show_nav'] = 0;
			}
			
			$shortcode_content = '[alus_brands_slider ';
			$shortcode_content .= ' categories="'.$instance['categories'].'"';
			$shortcode_content .= ' per_page="'.$instance['per_page'].'"';
			$shortcode_content .= ' rows="'.$instance['rows'].'"';
			$shortcode_content .= ' active_link="'.$instance['active_link'].'"';
			$shortcode_content .= ' show_nav="'.$instance['show_nav'].'"';
			$shortcode_content .= ' margin_image="'.$instance['margin_image'].'"';
			$shortcode_content .= ' extra_class="'.$instance['extra_class'].'"';
			$shortcode_content .= ']';
			
			echo $before_widget;
			if( $title ){
				echo $before_title . $title . $after_title;
			}
			
			echo do_shortcode($shortcode_content);
			
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 			= $new_instance['title'];		
			$instance['categories'] 	= $new_instance['categories'];		
			$instance['per_page'] 		= $new_instance['per_page'];		
			$instance['rows'] 			= $new_instance['rows'];		
			$instance['active_link'] 	= $new_instance['active_link'];	
			$instance['show_nav'] 		= $new_instance['show_nav'];	
			$instance['margin_image'] 	= $new_instance['margin_image'];				
			$instance['extra_class'] 	= $new_instance['extra_class'];				
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title'						=> ''
				,'categories'				=> ''
				,'per_page'					=> 6
				,'rows'						=> 3
				,'active_link'				=> 1
				,'show_nav'					=> 1
				,'margin_image'				=> 10
				,'extra_class'				=> ''
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'alura-studio'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('categories'); ?>"><?php esc_html_e('Input brand categories', 'alura-studio'); ?> </label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" value="<?php echo esc_attr($instance['categories']); ?>" />
				<span class="description"><?php esc_html_e('A comma separated of list brand category slugs', 'alura-studio'); ?></span>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('per_page'); ?>"><?php esc_html_e('Number of posts to show', 'alura-studio'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('per_page'); ?>" name="<?php echo $this->get_field_name('per_page'); ?>" type="number" min="0" value="<?php echo esc_attr($instance['per_page']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php esc_html_e('Number of rows', 'alura-studio'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>" type="number" min="1" value="<?php echo esc_attr($instance['rows']); ?>" />
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('active_link'); ?>" name="<?php echo $this->get_field_name('active_link'); ?>" value="1" <?php echo ($instance['active_link'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('active_link'); ?>"><?php esc_html_e('Activate link', 'alura-studio'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" value="1" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php esc_html_e('Show navigation button', 'alura-studio'); ?></label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('margin_image'); ?>"><?php esc_html_e('Margin between images', 'alura-studio'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('margin_image'); ?>" name="<?php echo $this->get_field_name('margin_image'); ?>" type="number" min="0" value="<?php echo esc_attr($instance['margin_image']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('extra_class'); ?>"><?php esc_html_e('Extra class', 'alura-studio'); ?> </label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo $this->get_field_name('extra_class'); ?>" value="<?php echo esc_attr($instance['extra_class']); ?>" />
			</p>
			<?php 
		}
	}
}

