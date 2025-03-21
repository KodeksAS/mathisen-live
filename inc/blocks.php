<?php

function kodeks_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'kodeks-blocks',
                'title' => __('Misc Blocks', 'kodeks-blocks'),
            ), array(
                'slug' => 'kodeks-content-blocks',
                'title' => __('Content blocks', 'kodeks-content-blocks'),
            ), array(
                'slug' => 'kodeks-listing-blocks',
                'title' => __('Listing blocks', 'kodeks-listing-blocks'),
            ), array(
                'slug' => 'kodeks-link-blocks',
                'title' => __('Link blocks', 'kodeks-link-blocks'),
            ),
        )
    );
}
add_filter('block_categories_all', 'kodeks_block_category', 10, 2);


// Set path to blocks folder
function kodeks_get_directory()
{

    $path = get_template_directory() . '/blocks/';
    $start_dir = realpath($path);
    $directory_arr = [];
    $directories = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($start_dir), RecursiveIteratorIterator::SELF_FIRST);
    $directories->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);

    foreach ($directories as $directory => $directory) {
        if (is_dir($directory)) {
            $directory_arr[] = $directory;
        }
    }

    return $directory_arr;
}

// Custom block registration
function kodeks_custom_blocks()
{
    if (function_exists('register_block_type')) {
        $directory_arr = kodeks_get_directory();

        foreach ($directory_arr as $directory) {
            register_block_type($directory . '/block.json');
        }
    }
}
add_action('init', 'kodeks_custom_blocks');

// Allow blocks
function kodeks_allowed_block_types($allowed_block_types, $post)
{
    $directory_arr = kodeks_get_directory();
    $block_arr = [];
    $exclude = []; // Add disallowed blocks here

    foreach ($directory_arr as $directory) {
        $block_name = explode('/blocks/', $directory);
        if (!in_array($block_name[1], $exclude)) {
            $block_arr[] = 'kodeks/' . $block_name[1];
        }
    }

    return $block_arr;
}
add_filter('allowed_block_types_all', 'kodeks_allowed_block_types', 10, 2);
