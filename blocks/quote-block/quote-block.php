<?php
$block_name = 'quote-block';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :
  $quote_title = get_field('quote_title') ? '<h4 class="quote-title">' . get_field('quote_title') . '</h4>' : '';
  $quote = get_field('quote') ? '<p class="quote">' . get_field('quote') . '</p>' : '';

  $section_padding = get_field('section_padding');
  $padding_classes = implode(" ", (array) $section_padding);

  $anchor_id = get_field('anchor_id') ? 'id="'.get_field('anchor_id').'"' : '';
  $background_color = get_field('background_color');
?>

    <section class="<?= $block_class ?> section-padding <?= $padding_classes ?> <?= $background_color ?>" <?= $anchor_id ?>>
      <div class="wrapper grid rg-20 side-padding  fade-me">
        <?= $quote_title ?>
        <?= $quote ?>
      </div>
    </section>

<?php

    // Enqueue block specific JS
    // wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>