<form role="search" method="post" id="searchform" class="search-form" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" placeholder="Search for videos..." value="<?php echo get_search_query() ?>" name="s" id="s" />
    <input type="hidden" value="tutorial" name="post_type" />
    <input type="submit" id="searchsubmit" value="" />
</form>