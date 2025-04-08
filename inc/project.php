<?php

// Add image sizes
add_image_size('hero', 1920, 0);
add_image_size('thumb', 550, 0);
add_image_size('half', 960, 0);


// // Add custom styles to the WordPress editor
// function kodeks_add_style_select_buttons($buttons)
// {
//     array_unshift($buttons, 'styleselect');
//     return $buttons;
// }
// add_filter('mce_buttons', 'kodeks_add_style_select_buttons');


// function kodeks_custom_styles($init_array)
// {

//     $style_formats = array(
//         // These are the custom styles
//         array(
//             'title' => 'Text big',
//             'block' => 'span',
//             'attributes' => ['class' => 'text-big'],
//             'wrapper' => true,
//         ),

//     );
//     // Insert the array, JSON ENCODED, into 'style_formats'
//     $init_array['style_formats'] = json_encode($style_formats);

//     return $init_array;
// }

// // Attach callback to 'tiny_mce_before_init' 
// add_filter('tiny_mce_before_init', 'kodeks_custom_styles');



// ------- First block check -------

// If the first block is the heading block, add black backgriound to contact button

function firstblockcheck($post_id)
{
    $content = get_post_field('post_content', $post_id);
    $blocks = parse_blocks($content);

    // Check if the first block is an ACF "kodeks/heading" block
    if (!empty($blocks) && $blocks[0]['blockName'] === 'kodeks/hero') {
        foreach ($blocks as $block) {
            if ($block['blockName'] == 'kodeks/hero') {
                return 'hero-top';
                break; // Break out of the loop, since we found the block
            }
        }
    }

}