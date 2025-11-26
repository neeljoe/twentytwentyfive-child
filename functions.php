<?php

function tt5_child_enqueue_assets() {

    // Correct path for Vite 5
    $manifest_path = get_stylesheet_directory() . '/build/.vite/manifest.json';

    if (!file_exists($manifest_path)) {
        error_log('Manifest not found: ' . $manifest_path);
        return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);

    // Get JS file
    $js_file = $manifest['src/main.js']['file'];

    wp_enqueue_script(
        'tt5-child-main-js',
        get_stylesheet_directory_uri() . '/build/' . $js_file,
        array(),
        null,
        true
    );

    // Get CSS file (if exists)
    if (isset($manifest['src/main.js']['css'][0])) {
        $css_file = $manifest['src/main.js']['css'][0];

        wp_enqueue_style(
            'tt5-child-main-css',
            get_stylesheet_directory_uri() . '/build/' . $css_file,
            array(),
            null
        );
    }
}
add_action('wp_enqueue_scripts', 'tt5_child_enqueue_assets');
