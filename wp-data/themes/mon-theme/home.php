<?php get_header(); ?>
<main>
    <div class="blog-section">
        <h1>Blog</h1>

        <div class="cards-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                    <div class="card-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 25, ' [...]'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn">Lire la suite →</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'prev_text' => '← Précédent',
                'next_text' => 'Suivant »',
            ));
            ?>
        </div>

        <?php else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>