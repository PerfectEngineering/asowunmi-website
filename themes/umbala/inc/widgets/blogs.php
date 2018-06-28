<?php
add_action('widgets_init', 'umbala_blogs_load_widgets');

function umbala_blogs_load_widgets()
{
	register_widget('Umbala_Blogs_Widget');
}

if( !class_exists('Umbala_Blogs_Widget') ){
	class Umbala_Blogs_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'alus-blogs-widget', 'description' => esc_html__('Display blogs on your sidebar', 'umbala'));
			parent::__construct('alus_blogs', esc_html__('Umbala - Blogs', 'umbala'), $widget_ops);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title 				= apply_filters('widget_title', $instance['title']);
			$limit 				= ($instance['limit'] != 0)?absint($instance['limit']):4;
			$order 				= $instance['order'];
			$orderby 			= $instance['orderby'];
			$categories 		= isset($instance['categories'])?(array)$instance['categories']:array();
			$show_thumbnail 	= empty($instance['show_thumbnail'])?0:$instance['show_thumbnail'];
			$show_title 		= empty($instance['show_title'])?0:$instance['show_title'];
			$show_date 			= empty($instance['show_date'])?0:$instance['show_date'];
			$show_author 		= empty($instance['show_author'])?0:$instance['show_author'];
			$show_comment 		= empty($instance['show_comment'])?0:$instance['show_comment'];
			$is_slider 			= empty($instance['is_slider'])?0:$instance['is_slider'];
			$row 				= ($instance['row'] != 0)?absint($instance['row']):2;
			$show_nav 			= empty($instance['show_nav'])?0:$instance['show_nav'];
			$auto_play 			= empty($instance['auto_play'])?0:$instance['auto_play'];
			
			echo wp_kses_post($before_widget);
			
			if( $title ){
				echo wp_kses_post($before_title . $title . $after_title);
			}
			
			$args = array(
				'post_type'				=> 'post'
				,'ignore_sticky_posts'	=> 1
				,'post_status'			=> 'publish'
				,'posts_per_page'		=> $limit
				,'order'				=> $order
				,'orderby'				=> $orderby
			);
			
			if( is_array($categories) && count($categories) > 0 ){
				$args['category__in'] = $categories;
			}
			
			global $post;
			$posts = new WP_Query($args);
			if( $posts->have_posts() ):
				$count = 0;
				$num_posts = $posts->post_count;
				if( $num_posts <= $row ){
					$is_slider = false;
				}
				if( !$is_slider ){
					$row = $num_posts;
				}
				
				$extra_class = '';
				$extra_class .= ($is_slider)?'is-slider loading':'';	
				
				?>
				<div class="alus_blog_widget <?php echo esc_attr($extra_class); ?>"  data-nav="<?php echo esc_attr($show_nav) ?>" data-autoplay="<?php echo esc_attr($auto_play) ?>">
					<?php while( $posts->have_posts() ): 
					$posts->the_post(); 
					$post_format = get_post_format(); 
					if( $is_slider && $post_format == 'gallery' ){
						$post_format = false;
					}
					?>
					<?php if( $count % $row == 0 ): ?>
						
						<ul class="post_list_widget">
						<?php endif; ?>
						<li>

							<?php if( $show_thumbnail ): ?>
								<?php umbala_post_thumb( array( 'size' => 'medium', 'class' => '' ) ); ?>
							<?php endif; ?>

							<?php if( $post_format != 'quote' ): ?>
								<div class="post-meta-widget">

									<?php if( $show_title ): ?>
										<a href="<?php the_permalink() ?>" class="post-title">
											<?php the_title(); ?>
										</a>
									<?php endif; ?>

									<?php if( $show_date ): ?>
										<div class="date-time">
											<i class="fa fa-calendar"></i>
											<?php the_time( get_option('date_format') ); ?>
										</div>
									<?php endif; ?>

									<?php if( $show_author ): ?>
										<span class="author">
											<i class="fa fa-user"></i>
											<?php the_author_posts_link(); ?>
										</span>
									<?php endif; ?>

									<?php if ( $show_comment ) {
										if ( get_comments_number() == 0 ) {
											$comments = esc_html__( 'No Comments', 'umbala' );
										} elseif ( get_comments_number() > 1 ) {
											$comments = sprintf( esc_html__( '%s Comments', 'umbala' ), get_comments_number() );
										} else {
											$comments = esc_html__( '1 Comment', 'umbala' );
										}
										echo '<a class="comment" href="' . get_comments_link() . '"><i class="fa fa-comments"></i> ' . $comments . '</a>';
									}
									?>
								</div>

							<?php else: /* Post format is quote */ ?>

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
									<?php if( $show_date && $show_thumbnail ): ?>
										<span class="date-time">
											<i class="fa fa-calendar"></i>
											<?php the_time( get_option('date_format') ); ?>
										</span>
									<?php endif; ?>

									<?php if( $show_author ): ?>
										<span class="author">
											<i class="fa fa-user"></i>
											<?php the_author_posts_link(); ?>
										</span>
									<?php endif; ?>
								</div>

							<?php endif; /* End quote */ ?>

						</li>
						<?php if( $count % $row == $row - 1 || $count == $num_posts - 1 ): ?>	
						</ul>

					<?php endif; ?>
					<?php $count++; endwhile; ?>
				</div>

				<?php
			endif;

			echo wp_kses_post($after_widget);
			wp_reset_postdata();
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 				= strip_tags($new_instance['title']);		
			$instance['limit'] 				= absint($new_instance['limit']);
			$instance['order'] 				= $new_instance['order'];
			$instance['orderby'] 			= $new_instance['orderby'];
			$instance['categories'] 		= $new_instance['categories'];
			$instance['show_thumbnail'] 	= $new_instance['show_thumbnail'];	
			$instance['show_title'] 		= $new_instance['show_title'];		
			$instance['show_date'] 			= $new_instance['show_date'];		
			$instance['show_author'] 		= $new_instance['show_author'];		
			$instance['show_comment'] 		= $new_instance['show_comment'];			
			$instance['is_slider'] 			= $new_instance['is_slider'];	
			$instance['row'] 				= absint($new_instance['row']);			
			$instance['show_nav'] 			= $new_instance['show_nav'];		
			$instance['auto_play'] 			= $new_instance['auto_play'];	

			if( $instance['row'] > $instance['limit'] ){
				$instance['row'] = $instance['limit'];
			}
			return $instance;
		}

		function form( $instance ) {

			$defaults = array(
				'title' 				=> 'Recent Posts'
				,'limit'				=> 4
				,'order'				=> 'desc'
				,'orderby'				=> 'date'
				,'categories'			=> array()
				,'show_thumbnail' 		=> 1
				,'show_title' 			=> 1
				,'show_date' 			=> 1
				,'show_author' 			=> 0
				,'show_comment'			=> 1
				,'is_slider' 			=> 1
				,'row'					=> 2
				,'show_nav' 			=> 1
				,'auto_play' 			=> 1
			);

			$instance = wp_parse_args( (array) $instance, $defaults );	

			$categories = $this->get_list_categories(0);
			if( !is_array($instance['categories']) ){
				$instance['categories'] = array();
			}

			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter your title', 'umbala'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_html_e('Number of posts to show', 'umbala'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['limit']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order by', 'umbala'); ?> </label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
					<option value="none" <?php selected('none', $instance['orderby']) ?>><?php esc_html_e('None', 'umbala') ?></option>
					<option value="ID" <?php selected('ID', $instance['orderby']) ?>><?php esc_html_e('ID', 'umbala') ?></option>
					<option value="title" <?php selected('title', $instance['orderby']) ?>><?php esc_html_e('Title', 'umbala') ?></option>
					<option value="date" <?php selected('date', $instance['orderby']) ?>><?php esc_html_e('Date', 'umbala') ?></option>
					<option value="comment_count" <?php selected('comment_count', $instance['orderby']) ?>><?php esc_html_e('Comment count', 'umbala') ?></option>
					<option value="rand" <?php selected('rand', $instance['orderby']) ?>><?php esc_html_e('Random', 'umbala') ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order', 'umbala'); ?> </label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
					<option value="asc" <?php selected('asc', $instance['order']) ?>><?php esc_html_e('Ascending', 'umbala') ?></option>
					<option value="desc" <?php selected('desc', $instance['order']) ?>><?php esc_html_e('Descending', 'umbala') ?></option>
				</select>
			</p>

			<p>
				<label><?php esc_html_e('Select categories', 'umbala'); ?></label>
				<div class="categorydiv">
					<div class="tabs-panel">
						<ul class="categorychecklist">
							<?php foreach($categories as $cat){ ?>
							<li>
								<label>
									<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[<?php esc_attr($cat->term_id); ?>]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id,$instance['categories']))?'checked':''; ?> />
									<?php echo esc_html($cat->name); ?>
								</label>
								<?php $this->get_list_sub_categories($cat->term_id, $instance); ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr($this->get_field_name('show_thumbnail')); ?>" value="1" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_blog-image')); ?>"><?php esc_html_e('Show post image', 'umbala'); ?></label>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_title')); ?>" name="<?php echo esc_attr($this->get_field_name('show_title')); ?>" value="1" <?php echo ($instance['show_title'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_title')); ?>"><?php esc_html_e('Show post title', 'umbala'); ?></label>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" value="1" <?php echo ($instance['show_date'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show post date', 'umbala'); ?></label>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" value="1" <?php echo ($instance['show_author'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e('Show post author', 'umbala'); ?></label>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_comment')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comment')); ?>" value="1" <?php echo ($instance['show_comment'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_comment')); ?>"><?php esc_html_e('Show post comment', 'umbala'); ?></label>
			</p>

			<hr/>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('is_slider')); ?>" name="<?php echo esc_attr($this->get_field_name('is_slider')); ?>" value="1" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('is_slider')); ?>"><?php esc_html_e('Show in a carousel slider', 'umbala'); ?></label>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('row')); ?>"><?php esc_html_e('Number of rows - in carousel slider', 'umbala'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('row')); ?>" name="<?php echo esc_attr($this->get_field_name('row')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['row']); ?>" />
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_nav')); ?>" name="<?php echo esc_attr($this->get_field_name('show_nav')); ?>" value="1" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_nav')); ?>"><?php esc_html_e('Show navigation button', 'umbala'); ?></label>
			</p>

			<p>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('auto_play')); ?>" name="<?php echo esc_attr($this->get_field_name('auto_play')); ?>" value="1" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo esc_attr($this->get_field_id('auto_play')); ?>"><?php esc_html_e('Auto play', 'umbala'); ?></label>
			</p>

			<?php 
		}

		function get_list_categories( $cat_parent_id ){
			$args = array(
				'hierarchical'		=> 1
				,'parent'			=> $cat_parent_id
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
			$cats = get_categories($args);
			return $cats;
		}

		function get_list_sub_categories( $cat_parent_id, $instance ){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
				?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
					<li>
						<label>
							<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[<?php esc_attr($sub_cat->term_id); ?>]" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id,$instance['categories']))?'checked':''; ?> />
							<?php echo esc_html($sub_cat->name); ?>
						</label>
						<?php $this->get_list_sub_categories($sub_cat->term_id, $instance); ?>
					</li>
					<?php } ?>
				</ul>
				<?php }
			}

		}
	}

