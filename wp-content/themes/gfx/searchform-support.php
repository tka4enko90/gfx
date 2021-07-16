<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" placeholder="Search for support..." value="<?php echo get_search_query() ?>" name="s" id="s" />
    <input type="hidden" value="support" name="post_type" />
    <input type="submit" id="searchsubmit" value="" />
</form>