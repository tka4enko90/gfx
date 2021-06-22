<?php get_header(); ?>
    <main class="main">
        <?php
        while (have_posts()) :
            the_post(); ?>
            <section class="register-section">
                <div class="container">
                    <div class="section-holder">
                        <div class="form-holder">
                            <?php $user_log = tml_get_form_field( 'register', 'user_email' ); ?>
                            <?php $user_log->set_label( 'Email Address' ); ?>

                            <?php the_content(); ?>
                        </div>
                        <div class="image-holder">
123
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    </main>
<?php get_footer(); ?>