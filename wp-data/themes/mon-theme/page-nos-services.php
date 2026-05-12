<?php get_header(); ?>
<main>
    <div class="services-section">
        <h1>Nos services</h1>
        <h2>Nos Services de Développement Web</h2>

        <div class="cards-grid">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=400" alt="Développement Web">
                <div class="card-content">
                    <h3>Développement de Sites Web</h3>
                    <p>Nous créons des sites web modernes et réactifs, adaptés à vos besoins. Que ce soit un site vitrine ou un e-commerce, nous avons la solution.</p>
                    <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn">Nous contacter</a>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400" alt="Applications Web">
                <div class="card-content">
                    <h3>Applications Web sur Mesure</h3>
                    <p>Nous développons des applications web personnalisées pour optimiser vos processus métiers et améliorer votre productivité.</p>
                    <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn">Nous contacter</a>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1562577309-4932fdd64cd1?w=400" alt="SEO">
                <div class="card-content">
                    <h3>Optimisation SEO</h3>
                    <p>Nous optimisons votre site web pour améliorer son classement dans les moteurs de recherche et augmenter votre visibilité en ligne.</p>
                    <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn">Nous contacter</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>