<?php
// Sécurité : Empêche l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Activer la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Enregistrer un menu personnalisé
function mon_theme_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'mon-theme'),
    ));
}
add_action('after_setup_theme', 'mon_theme_register_menus');

// Ajouter un fichier CSS et JS
function mon_theme_enqueue_styles_scripts() {
    wp_enqueue_style('mon-style', get_stylesheet_uri());
    wp_enqueue_script('mon-spa', get_template_directory_uri() . '/spa.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles_scripts');

// Configurer SMTP pour MailHog
add_action('phpmailer_init', function($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'mailhog';
    $phpmailer->Port = 1025;
    $phpmailer->SMTPAuth = false;
});
?>
