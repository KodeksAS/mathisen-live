<?php

// Add image sizes
// add_image_size('hero', 1920, 0);

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