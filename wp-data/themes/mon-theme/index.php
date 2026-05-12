<?php get_header(); ?>
<main>
    <?php if (is_front_page()) : ?>
        <section class="hero">
            <h1>Bienvenue sur notre site</h1>
            <p>Découvrez nos services, nos actualités et bien plus encore. Nous sommes là pour répondre à vos besoins.</p>
            <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn">Nous contacter</a>
        </section>

        <section class="about">
            <h2>À propos de nous</h2>
            <p>Nous offrons des solutions innovantes pour vous accompagner dans votre projet. Notre expertise nous permet de vous proposer des services de qualité adaptés à vos besoins.</p>
        </section>

        <section class="latest-posts">
            <h2>Nos derniers articles</h2>
            <div class="cards-grid">
                <?php
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php endif; ?>
                        <div class="card-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, ' [...]'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn">Lire la suite</a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </section>
    <?php else : ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>