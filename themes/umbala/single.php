<?php
global $post;
get_header();
$content_class = umbala_get_content_layout(umbala_get_opt('alus_blog_details_layout'));
if (!is_active_sidebar(umbala_get_opt('alus_blog_details_left_sidebar')) || !is_active_sidebar(umbala_get_opt('alus_blog_details_right_sidebar'))) {
    $content_class['main_class'] = 'col-sm-12 col-xs-12';
}

umbala_page_heading();
?>
<div class="container">
  <div class="row">

    <?php if ($content_class['left_sidebar'] && is_active_sidebar(umbala_get_opt('alus_blog_details_left_sidebar'))): ?>
      <aside id="left-sidebar" role="complementary" class="<?php echo esc_attr($content_class['left_sidebar_class']); ?>">
        <?php dynamic_sidebar(umbala_get_opt('alus_blog_details_left_sidebar')); ?>
      </aside>
    <?php endif; ?>

    <section id="content" class="site-content <?php echo esc_attr($content_class['main_class']); ?>">

      <?php while (have_posts()): the_post(); ?>
		       <?php get_template_part('template-parts/post/content', 'single'); ?>
		     <?php endwhile;?>

   </section><!-- #content -->

   <?php if ($content_class['right_sidebar'] && is_active_sidebar(umbala_get_opt('alus_blog_details_right_sidebar'))): ?>
    <aside id="right-sidebar" role="complementary" class="<?php echo esc_attr($content_class['right_sidebar_class']); ?>">
      <?php dynamic_sidebar(umbala_get_opt('alus_blog_details_right_sidebar')); ?>
    </aside>
  <?php endif; ?>

</div><!-- .row -->
</div><!-- .container -->

<?php get_footer();
