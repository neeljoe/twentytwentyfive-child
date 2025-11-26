<?php

function tt5_child_enqueue_assets() {

    $manifest_path = get_stylesheet_directory() . '/build/.vite/manifest.json';

    if (!file_exists($manifest_path)) {
        error_log("Manifest not found at: $manifest_path");
        return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);

    // JS
    if (isset($manifest['src/main.js']['file'])) {
        $js_file = $manifest['src/main.js']['file'];
        wp_enqueue_script(
            'tt5-child-main-js',
            get_stylesheet_directory_uri() . '/build/' . $js_file,
            [],
            filemtime(get_stylesheet_directory() . '/build/' . $js_file),  // ⬅ Versioning
            true
        );
    }

    // CSS
    if (isset($manifest['src/main.js']['css'][0])) {
        $css_file = $manifest['src/main.js']['css'][0];
        wp_enqueue_style(
            'tt5-child-main-css',
            get_stylesheet_directory_uri() . '/build/' . $css_file,
            [],
            filemtime(get_stylesheet_directory() . '/build/' . $css_file)  // ⬅ Versioning
        );
    }
}
add_action('wp_enqueue_scripts', 'tt5_child_enqueue_assets');