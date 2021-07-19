<form role="search" method="post" id="searchform" class="search-form" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" placeholder="Search for articles..." value="<?php echo get_search_query() ?>" name="s" id="s" />
    <input type="hidden" value="post" name="post_type" />
    <input type="submit" id="searchsubmit" value="" />
</form>