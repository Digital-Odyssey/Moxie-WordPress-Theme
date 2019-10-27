<div class="pm-sidebar-search-container">
    <i class="fa fa-search pm-sidebar-search-icon-btn"></i>
    <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    	<input type="text" class="pm-sidebar-search-field" name="s" id="s" placeholder="<?php esc_html_e('Type keywords...', 'moxietheme') ?>" />
        <input type="hidden" value="product" name="post_type" id="post_type" />
    </form>
</div>