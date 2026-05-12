<?php get_header(); ?>
<main>
    <div class="contact-section">
        <h1>Contact</h1>
        <div class="contact-form-wrapper">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>