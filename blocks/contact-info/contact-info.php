<?php
$block_name = 'contact-info';
$block_class = is_admin() ? $block_name . ' admin' : $block_name;
$id = isset($block['post_id']) ? $block['post_id'] : (acf_maybe_get_POST('post_id') ?: get_the_ID());

if (isset($block['data']['preview'])) :
    block_render($block, $block_name);
else :

  $section_padding = get_field('section_padding');
  $padding_classes = implode(" ", (array) $section_padding);

  $address = get_field('address', 'option');
  $phone = get_field('phone', 'option');
  $fax = get_field('fax', 'option');
  $email = get_field('email', 'option') ? '<a href="mailto:' . get_field('email', 'option') . '">' . get_field('email', 'option') . '</a>' : '';

  $warehouses_headline = get_field('warehouses_headline', 'option') ? '<p>' . get_field('warehouses_headline', 'option') . '</p>' : '';

  $anchor_id = get_field('anchor_id') ? 'id="'.get_field('anchor_id').'"' : '';

  $contact_heading = get_field('contact_heading') ? '<h2>' . get_field('contact_heading') . '</h2>' : '';
  $team_heading = get_field('team_heading') ? '<h2>' . get_field('team_heading') . '</h2>' : '';

?>

    <section class="<?= $block_class ?> section-padding <?= $padding_classes ?>" <?= $anchor_id ?>>

    <div class="contact-wrapper grid-12 side-padding">
        <div class="start-5 end-8 start-m-1 end-m-6 end-s-12 grid grid-s-2 rg-s-0 acs js fade-me">
              <?= $contact_heading ?>

              <div class="contact">
              <p>
              <span class="small-heading"><?= __('Visitor address', 'kodeks') ?></span>
              <?= $address ?>
              </p>

              <p>
              <?= __('Post address', 'kodeks') ?><br />
              <?= $address ?>
              </p>

              <p>
              <?= $phone ? 'T ' .$phone : '' ?><br />
              <?= $fax ? 'F ' .$fax : '' ?><br />
              <?= $email ? 'M ' .$email : '' ?>
              </p>
              </div>
         
            
            <?php if( have_rows('add_warehouse', 'option') ): ?>
                <div class="warehouses">
                <span class="small-heading less"><?= $warehouses_headline ?></span>
                  <?php while( have_rows('add_warehouse', 'option') ): the_row(); 
                    $warehouse_title = get_sub_field('warehouse_title');
                    $warehouse_address = get_sub_field('warehouse_address');
                    $postnumber_and_place = get_sub_field('postnumber_and_place');
                    ?>
                    
                      <p class="less">
                        <?= $warehouse_title ?><br />
                        <?= $warehouse_address ?><br />
                        <?= $postnumber_and_place ?>
                      </p>
                    
                  <?php endwhile; ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="start-9 end-11 start-m-7 end-m-12 start-s-1 grid rg-s-0 acs js fade-me">
          
          <?php if( have_rows('team') ): ?>
            <?= $team_heading ?>
              <ul class="team grid-s-2 ">
              <?php while( have_rows('team') ): the_row(); 
                  $heading = get_sub_field('heading');
                  $name = get_sub_field('name');
                  $phone = get_sub_field('phone');
                  $email = get_sub_field('email') ? '<a href="mailto:' . get_sub_field('email') . '">' . get_sub_field('email') . '</a>' : '';
                  ?>
                  <li>
                  <span class="small-heading"><?= $heading ?></span>
                  <?= $name ?><br />
                  <?= $phone ? $phone : '' ?><br />
                  <?= $email ? $email : '' ?>
                </li>
              <?php endwhile; ?>
              </ul>
          <?php endif; ?>

          </div>
        </div>

    </section>

<?php

    // Enqueue block specific JS
    // wp_enqueue_script('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.js', '', kodeks_get_theme_version_number());

    // Enqueue block CSS
    wp_enqueue_style('kodeks-' . $block_name . '-block', get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.css', '', kodeks_get_theme_version_number());

endif; ?>