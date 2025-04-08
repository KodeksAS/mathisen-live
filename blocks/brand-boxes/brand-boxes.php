<?php
$block_name = 'brand-boxes';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :
    $brandboxes_headline = get_field('brandboxes_headline') ? '<div class="section-header grid acc jcc fade-me"><h2>' . get_field('brandboxes_headline') . '</h2></div>' : '';

    $section_padding = get_field('section_padding');
    $padding_classes = implode(" ", (array) $section_padding);

    $anchor_id = get_field('anchor_id') ? 'id="'.get_field('anchor_id').'"' : '';
    $background_color = get_field('background_color');
?>

    <section class="<?= $block_class ?> section-padding <?= $padding_classes ?> <?= $background_color ?>" <?= $anchor_id ?>>
        <div class="wrapper grid rg-100  swiper side-padding">
            <?= $brandboxes_headline ?>

            <?php if( have_rows('add_boxes') ): ?>
                <div class="box-container grid-3 grid-m-2 grid-s-1 rg-30 cg-30 cg-m-0 g-s-0 swiper-wrapper">
                    <?php while( have_rows('add_boxes') ): the_row(); 
                        $box_subtitle = get_sub_field('box_subtitle') ? ' <span>' . get_sub_field('box_subtitle') . '</span>' : '';
                        $box_headline = get_sub_field('box_headline') ? '<h4>' . get_sub_field('box_headline') . '' . $box_subtitle  . '</h4>' : '';
                        $box_text = get_sub_field('box_text') ?  : '';
                        $box_link = get_sub_field('box_link');
                        $box_class = 'brand-box grid acs js fade-me swiper-slide';
                        $background_image = get_sub_field('background_image');
                        if ($background_image) {
                          $size = 'thumbnail';
                          $box_class .= ' has-bg';
                          $bg_img = $background_image['sizes'][ $size ];
                          $backgrond_image = 'style="background-image: url(' . $bg_img . ');"';
                        } else {
                          $backgrond_image = '';
                        }
                        if($box_link) {
                            $link_url = $box_link['url'];
                            $link_title = $box_link['title'];
                            $link_target = $box_link['target'] ? $box_link['target'] : '_self';
                            $box_tag = '<a class="' . $box_class . '" href="' . $link_url . '" target="' . $link_target . '" ' . $backgrond_image . '><div class="box-content grid acs js">' . $box_headline . '' . $box_text . '<div class="box-footer grid acc jce"><div class="link-arrow"><span class="icon-arrow"></span></div></div></div><div class="overlay frosted-glass"></div></a>'; 
                        } else {
                            $box_tag = '<div class="' . $box_class . '" ' . $backgrond_image . '><div class="box-content grid acs js">' . $box_headline . '' . $box_text . '</div></div>';
                        }

                    ?>
                    <?= $box_tag ?>
                    <?php endwhile; ?>
                    
                </div>
            <?php endif; ?>
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    </section>

<?php

    // Enqueue block specific JS
    wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>