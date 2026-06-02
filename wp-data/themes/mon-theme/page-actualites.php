<?php get_header(); ?>
<main>
    <div class="news-section">
        <h1>Actualités</h1>

        <!-- Filtre par catégorie -->
        <div class="news-filters">

            <a href="?category=business" class="btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'business') ? 'btn-active' : ''; ?>">Business</a>
            <a href="?category=technology" class="btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'technology') ? 'btn-active' : ''; ?>">Technology</a>
            <a href="?category=sports" class="btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'sports') ? 'btn-active' : ''; ?>">Sports</a>
            <a href="?category=health" class="btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'health') ? 'btn-active' : ''; ?>">Health</a>
            <a href="?category=entertainment" class="btn <?php echo (isset($_GET['category']) && $_GET['category'] == 'entertainment') ? 'btn-active' : ''; ?>">Entertainment</a>
        </div>

        <?php
        // Clé API protégée dans le thème
        $api_key = defined('NEWSAPI_KEY') ? NEWSAPI_KEY : '';
        $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'general';

        // Appel à l'API NewsAPI
        $search = ($category === 'general') ? 'Belgium' : "Belgium AND {$category}";
        $url = "https://newsapi.org/v2/everything?q={$search}&pageSize=6&sortBy=relevancy&apiKey={$api_key}";
        $response = wp_remote_get($url, array(
          'headers' => array(
            'User-Agent' => 'WordPress/MonTheme'
          )
        ));


        // Gestion d'erreur si l'API ne répond pas
        if (is_wp_error($response)) : ?>
            <p class="news-error">Impossible de charger les actualités. Veuillez réessayer plus tard.</p>
        <?php else :
            $body = json_decode(wp_remote_retrieve_body($response), true);

            // Supprimer les doublons par titre
            $seen = array();
            $unique_articles = array();
            foreach ($body['articles'] as $article) {
                if (!in_array($article['title'], $seen)) {
                    $seen[] = $article['title'];
                    $unique_articles[] = $article;
                }
            }
            $body['articles'] = $unique_articles;

            if ($body['status'] === 'ok' && count($body['articles']) > 0) : ?>
                <div class="cards-grid">
                    <?php foreach ($body['articles'] as $article) : ?>
                        <div class="card">
                            <?php if (!empty($article['urlToImage'])) : ?>
                                <img src="<?php echo esc_url($article['urlToImage']); ?>" alt="<?php echo esc_attr($article['title']); ?>">
                            <?php else : ?>
                                <img src="https://via.placeholder.com/400x200?text=Pas+d'image" alt="Pas d'image">
                            <?php endif; ?>
                            <div class="card-content">
                                <h3><?php echo esc_html($article['title']); ?></h3>
                                <p class="news-meta"><?php echo esc_html($article['source']['name']); ?> — <?php echo date('d/m/Y', strtotime($article['publishedAt'])); ?></p>
                                <p><?php echo esc_html($article['description'] ?? 'Pas de description disponible.'); ?></p>
                                <a href="<?php echo esc_url($article['url']); ?>" target="_blank" class="btn">Lire l'article</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="news-error">Aucun article disponible pour cette catégorie.</p>
            <?php endif;
        endif; ?>
    </div>
</main>
<?php get_footer(); ?>