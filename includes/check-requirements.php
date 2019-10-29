<?php
add_action('plugins_loaded', function () use($requirements) {
    if($requirements['composer'] && !file_exists(__DIR__.'/..//vendor/autoload.php')) {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>Composer not loaded. Make sure you run <code>composer install</code></p></div>';
        });

        add_filter('template_include', function ($template) {
            return __DIR__ . '/../static/no-composer.html';
        });

        return;
    }

    if($requirements['timber'] && !class_exists('Timber\Timber')) {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>Timber not installed. Make sure you run <code>composer install</code></p></div>';
        });

        add_filter('template_include', function ($template) {
            return __DIR__ . '/../static/no-timber.html';
        });

        return;
    }

    if ($requirements['acf'] && !function_exists('acf_add_options_page')) {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>ACF not activated. Make sure you install and activate the plugin.</p></div>';
        });

        add_filter('template_include', function ($template) {
            return __DIR__ . '/../static/no-acf.html';
        });

        return;
    }

    if($requirements['gravityforms'] && !class_exists('GFCommon' ))
    {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>Gravity Forms not activated. Make sure you install and activate the plugin.</p></div>';
        });

        add_filter('template_include', function ($template) {
            return __DIR__ . '/../static/no-gravityforms.html';
        });

        return;
    }
});

add_action('after_setup_theme', function() use($requirements) {
    if($requirements['sapling'] && !class_exists('\Sapling\Theme' ))
    {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>Sapling theme not activated. Make sure you install and activate the theme.</p></div>';
        });

        add_filter('template_include', function ($template) {
            return __DIR__ . '/../static/no-theme.html';
        });

        return;
    }
});