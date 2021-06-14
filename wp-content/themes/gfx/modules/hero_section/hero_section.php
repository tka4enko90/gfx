<?php wp_enqueue_style('hero_section_styles', get_template_directory_uri() . '/static/css/modules/hero_section/hero_section.css', '', '', 'all'); ?>

<?php $hero_section_subtitle = get_sub_field('hero_section_subtitle'); ?>
<?php $hero_section_title = get_sub_field('hero_section_title'); ?>
<?php $hero_section_button = get_sub_field('hero_section_button'); ?>
<?php $hero_section_video = get_sub_field('hero_section_video'); ?>

<div class="hero-section">
    <div class="container">
        <div class="section-holder">
            <?php if ($hero_section_subtitle || $hero_section_title) : ?>
                <div class="content-col">
                    <?php if ($hero_section_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $hero_section_subtitle; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($hero_section_title) : ?>
                        <div class="title">
                            <h1><?php echo $hero_section_title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if ($hero_section_button && $hero_section_button['url']) : ?>
                        <a href="<?php echo $hero_section_button['url']; ?>" class="primary-button "
                           target="<?php echo $hero_section_button['target']; ?>"><?php echo $hero_section_button['title']; ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($hero_section_video['url']) : ?>
                <div class="video-col">
                    <img class="element" src="<?php echo get_template_directory_uri() ?>/static/img/element-1.png" alt="decorative image">
                    <img class="element" src="<?php echo get_template_directory_uri() ?>/static/img/element-2.png" alt="decorative image">
                    <img class="element" src="<?php echo get_template_directory_uri() ?>/static/img/element-3.png" alt="decorative image">
                    <img class="element" src="<?php echo get_template_directory_uri() ?>/static/img/element-4.png" alt="decorative image">

                    <video autoplay="true" loop="true" muted="true">
                        <source src="<?php echo $hero_section_video['url'] ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>