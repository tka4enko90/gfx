<?php get_header(); ?>
<main class="main">
    <?php
        if( have_rows('modules') ):
            while ( have_rows('modules') ) : the_row();

                // Hero Section
                if( get_row_layout() == 'hero_section' ):
                    get_template_part( 'modules/hero_section/hero_section' );
                // Products grid with pop out
                elseif (get_row_layout() == 'products_grid_with_pop_out') :
                    get_template_part( 'modules/products_grid_with_pop_out/products_grid_with_pop_out' );
                // Information block
                elseif (get_row_layout() == 'information_block') :
                    get_template_part( 'modules/information_block/information_block' );
                endif;

            endwhile;
        endif;
    ?>
</main>
<?php get_footer(); ?>
