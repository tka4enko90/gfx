<?php get_header(); ?>

    <main class="main">
        <section class="scroll-here"></section>
        <?php
        if (have_rows('readme_modules')):
            while (have_rows('readme_modules')) : the_row();

                // Readme Hero Section
                if (get_row_layout() == 'readme_hero'):
                    get_template_part('template-parts/blocks/readme_hero/readme-hero'); ?>
                    <div class="scroll-here"></div>
                <?php // Product Information
                elseif (get_row_layout() == 'readme_product_information') :
                    get_template_part('template-parts/blocks/readme_product_information/readme-product-information');

                // Product Settings
                elseif (get_row_layout() == 'readme_product_settings') :
                    get_template_part('template-parts/blocks/readme_product_settings/readme-product-settings');

                // Setup Guides
                elseif (get_row_layout() == 'readme_setup_guides') :
                    get_template_part('template-parts/blocks/readme_setup_guides/readme-setup-guides');

                // Source Files
                elseif (get_row_layout() == 'readme_source_files') :
                    get_template_part('template-parts/blocks/readme_source_files/readme-source-files');

                endif;
            endwhile;
        endif;
        ?>
    </main>

<?php get_footer(); ?>