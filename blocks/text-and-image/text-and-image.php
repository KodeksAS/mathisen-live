<?php
$block_name = 'text-and-image';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :

  $section_padding = get_field('section_padding');
  $padding_classes = implode(" ", (array) $section_padding);

  $title = get_field('textimage_title');
  $text = get_field('text_block');
  $image = get_field('textimage_image');

  $anchor_id = get_field('anchor_id') ? 'id="'.get_field('anchor_id').'"' : '';
  $background_color = get_field('background_color');
?>

    <section class="<?= $block_class ?> <?= $background_color ?>" <?= $anchor_id ?>>

    <div class="background-wrapper">
      <div class="img-wrapper">
        <?php echo wp_get_attachment_image($image['ID'], 'half', '', ['loading' => 'lazy']); ?>
      </div>
    </div>

      <div class="wrapper grid-12 rg-20 cg-0 side-padding">
        <div class="text">
          <div class="bottom  fade-me">
            <h2><?= $title ?></h2>
            <p><?= $text ?></p>
          </div>
        </div>
      </div>

    </section>

<?php

    // Enqueue block specific JS
    // wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>