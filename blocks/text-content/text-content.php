<?php
$block_name = 'text-content';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :

  $section_padding = get_field('section_padding');
  $padding_classes = implode(" ", (array) $section_padding);

  $anchor_id = get_field('anchor_id') ? 'id="'.get_field('anchor_id').'"' : '';
?>

    <section class="<?= $block_class ?> section-padding <?= $padding_classes ?>" <?= $anchor_id ?>>

    <?php if( have_rows('add_text_block') ): ?>
      <div class="text-content-row grid side-padding rg-0">
      <?php while( have_rows('add_text_block') ): the_row(); 
          $headline = get_sub_field('headline');
          $text_editor = get_sub_field('text_editor');
          ?>
          <div class="text grid-12  fade-me">
              <?php if($headline): ?>
              <h2 class="headline span-3"><?= $headline ?></h2>
              <?php endif; ?>
              <?php if($text_editor): ?>
                <div class="text-editor span-9">
                  <?= $text_editor ?>
                </div>
              <?php endif; ?>
              </div>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>

    </section>

<?php

    // Enqueue block specific JS
    //wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>