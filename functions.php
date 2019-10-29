<?php
/**
 * Plugin Name: Plugin Nmae
 * Description: Plugin Description
 * Version: 1.0
 * Author: Robert Parker
 */

/**
 * used by check-requirements to ensure dependencies are set up correctly
 */
$requirements = [
    'composer' => true,
    'acf' => true,
    'gravityforms' => true,
    'timber' => true,
    'sapling' => true,
];

require_once __DIR__.'/includes/check-requirements.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/includes/timber.php';

// post type
$postType = new \Plugin\PostType(__FILE__, 'book', [
    'label'     => __('Book'),
    'description' => __('Books'),
    'rewrite' => ['slug' => 'books'],
    'public'    => true,
    'has_archive' => true,
    'hierarchical' => false,
    'supports' => ['title', 'excerpt', 'author', 'thumbnail'],
    'menu_position' => null,
    'menu_icon' => 'dashicons-book',
]);

// taxonomies
$taxonomy = new \Plugin\Taxonomy(__FILE__, (string) $postType, 'genre', [
    'label'     => __('Genre'),
    'description' => __('Genres'),
    'rewrite' => ['slug' => 'genres'],
    'public'    => true,
    'hierarchical' => false,
    'show_admin_column' => true,
]);

// acf
$fields = new \Plugin\CustomFields('book', [], [(string) $postType]);
$fields->addText('ISBN');

$settings = new \Plugin\SettingsPage('book_settings', __('Book Settings'));
$settings->addText('Publisher');

// blocks
add_filter('sapling_acf_builder_fields', function(array $fields) :array
{
    $advancedTab = new \Sapling\Plugin\ACF\Tabs\Advanced();

    $fields['plugin_book'] = new Plugin\Blocks\Book();
    $advancedTab->addTab($fields['plugin_book']);

    ksort($fields);

    return $fields;
});

// assets
$assets = new \Plugin\Assets();
$assets->addStyle('plugin', plugins_url('/assets/css/style.css', __FILE__));
$assets->addScript('plugin', plugins_url('/assets/js/script.js', __FILE__));