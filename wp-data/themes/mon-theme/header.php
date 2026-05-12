<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body>

<header>
    <h1><?php bloginfo('name'); ?></h1>
</header>
<nav>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => 'ul',
        'menu_class' => 'nav-menu',
    )); ?>
</nav>

