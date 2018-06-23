</main><!-- #main -->
<?php if (!is_page_template('blank.php')): ?>
	<footer id="footer" class="site-footer">

		<?php if (is_active_sidebar('footer-top')): ?>
			<div class="widget-column footer-top">
				<div class="container">
					<?php dynamic_sidebar('footer-top'); ?>
				</div>
			</div>
		<?php endif;?>
		<?php if (is_active_sidebar('footer-middle')): ?>
			<div class="widget-column footer-middle">
				<div class="container">
					<?php dynamic_sidebar('footer-middle'); ?>
				</div>
			</div>
		<?php endif;?>
		<?php if (is_active_sidebar('footer-bottom')): ?>
			<div class="widget-column footer-bottom">
				<div class="container">
					<?php dynamic_sidebar('footer-bottom'); ?>
				</div>
			</div>
		<?php endif;?>

	</footer><!-- #footer -->
<?php endif;?>
<div class="alus-close-popup"></div>
</div><!-- #wrapper -->

<?php

if ((!wp_is_mobile() && umbala_get_opt('alus_back_to_top_button')) || (wp_is_mobile() && umbala_get_opt('alus_back_to_top_button_on_mobile'))):
?>
	<div class="back-to-top">
		<a class="scroll-button" href="javascript:void(0)" title="<?php echo esc_attr_e('Back to Top', 'umbala'); ?>"><?php echo esc_html_e('Back to Top', 'umbala'); ?></a>
	</div>
<?php endif;?>
<?php wp_footer();?>

</body>
</html>
