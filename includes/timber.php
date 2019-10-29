<?php
add_filter('timber/loader/paths', function($paths) {
    array_push($paths, __DIR__.'/../templates');

    return $paths;
});