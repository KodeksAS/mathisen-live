<?php
$block_name = 'hero';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :
    $hero_text = get_field('hero_text') ? '<h1>' . get_field('hero_text') . '</h1>' : '';
    $hero_image = get_field('hero_image');
    if($hero_image) {
        $alt = $hero_image['alt'];
        $size = 'hero';
        $img = $hero_image['sizes'][ $size ];
        $hero_image_tag = '<div class="grid full"><div class="image-wrapper panorama"><img src="' . $img . '" alt="' . $alt . '" /></div></div>';
    } else {
        $hero_image_tag = '';
    }
?>

    <section class="<?= $block_class ?>">
        <div class="grid full acs rg-0 jc">
            <div class="content-wrapper grid ace js full">
                <?= $hero_text ?>
            </div>
            <?= $hero_image_tag ?>
        </div>
    </section>

<?php

    // Enqueue block specific JS
    // wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>