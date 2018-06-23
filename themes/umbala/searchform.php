
<form role="search" method="get" class="search-form" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
    <label for="<?php echo esc_attr( uniqid( 'search-form-' ) ); ?>">
		<span class="screen-reader-text"><?php echo esc_html_e( 'Search for:', 'umbala' ); ?></span>
	</label>
    <input type="search" id="<?php echo esc_attr( uniqid( 'search-form-' ) ); ?>" class="search-field" placeholder="<?php echo esc_attr_e('Search ...', 'umbala'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo esc_html_e( 'Search', 'umbala' ); ?></button>
</form>
