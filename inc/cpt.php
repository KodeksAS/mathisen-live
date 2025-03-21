<?php 

// Post types
// function kodeks_post_types()
// {
// register_taxonomy(
//         'taxonomy',
//         array('post_type'),
//         array(
//             'label' => __('Taxonomy'),
//             'rewrite' => array('slug' => 'taxonomy', 'with_front' => true),
//             'hierarchical' => true,
//             'show_admin_column' => true,
//             'show_in_rest' => true,
//         )
//     );

//     // post_type
//     register_post_type(
//         'post_type',

//         array(
//             'labels' => array(
//                 'name' => __('post_type'),
//                 'singular_name' => __('Post type'),
//                 'menu_name' => __('Post type'),
//             ),
//             'public' => true,
//             'has_archive' => false,
//             'rewrite' => array('slug' => 'post_type', 'with_front' => false),
//             'supports' => array('title', 'editor'),
//             'exclude_from_search' => false,
//             'show_in_rest' => true
//         )
//     );
// }
// add_action('init', 'kodeks_post_types');