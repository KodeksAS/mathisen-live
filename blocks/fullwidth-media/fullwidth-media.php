<?php
$block_name = 'fullwidth-media';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :
  $fullwidth_image = get_field('fullwidth_image');
  if ($fullwidth_image) {
    $alt = $fullwidth_image['alt'];
    $size = 'hero';
    $img = $fullwidth_image['sizes'][ $size ];
    $fullwidth_image = '<div class="image-wrapper landscape"><img src="' . $img . '" alt="' . $alt . '" /></div>';
  } else {
    $fullwidth_image = '';
  }

  $section_padding = get_field('section_padding');
  $padding_classes = implode(" ", (array) $section_padding);
?>

    <section class="<?= $block_class ?> section-padding <?= $padding_classes ?>">
      <div class="wrapper grid full">
        <?= $fullwidth_image ?>
      </div>
    </section>

<?php

    // Enqueue block specific JS
    // wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>