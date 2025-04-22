</main>
<?php
  $footer_logo = get_field('footer_logo', 'option');
  if($footer_logo) {
    $alt = $footer_logo['alt'];
    $size = 'thumbnail';
    $thumb = $footer_logo['sizes'][ $size ];
    $footer_logo = '<img src="' . $thumb . '" alt="' . esc_attr($footer_logo['alt']) . '" />';
  } else {
    $footer_logo = '';
  }
  $address = get_field('address', 'option');
  $phone = get_field('phone', 'option');
  $fax = get_field('fax', 'option');
  $email = get_field('email', 'option') ? '<a href="mailto:' . get_field('email', 'option') . '">' . get_field('email', 'option') . '</a>' : '';

  $warehouses_headline = get_field('warehouses_headline', 'option') ? '<p>' . get_field('warehouses_headline', 'option') . '</p>' : '';

  $main_page_color = get_field('main_page_color', 'option');
  
?>
<footer class="site-footer <?= $main_page_color ?>">
    <div class="grid-12 acs js side-padding">
        <div class="span-4 span-m-12">
            <div class=" footer-logo">
                <?= $footer_logo ?>
            </div>
        </div>
        <div class="span-4 span-m-6 grid acs js">
            <p><?= __('Visitor address', 'kodeks') ?> <br /> <?= $address ?></p>
            <p>
            <?= $phone ? 'T&nbsp;&nbsp;&nbsp;' .$phone : '' ?><br />
            <?= $fax ? 'F&nbsp;&nbsp;&nbsp;' .$fax : '' ?><br />
            <?= $email ? 'M&nbsp;&nbsp;&nbsp;' . $email : '' ?>
            </p>
        </div>
        <div class="span-4 span-m-6 grid acs js rg-30">
          <?= $warehouses_headline ?>
          <?php if( have_rows('add_warehouse', 'option') ): ?>
              <div class="warehouses grid acs js rg-30">
                <?php while( have_rows('add_warehouse', 'option') ): the_row(); 
                  $warehouse_title = get_sub_field('warehouse_title');
                  $warehouse_address = get_sub_field('warehouse_address');
                  $postnumber_and_place = get_sub_field('postnumber_and_place');
                  ?>
                  
                    <p>
                      <?= $warehouse_title ?><br />
                      <?= $warehouse_address ?><br />
                      <?= $postnumber_and_place ?>
                    </p>
                  
                <?php endwhile; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="span-6 grid acs js rg-30 copy">
          &copy; <?= get_bloginfo('name') ?> <?= date('Y') ?>
        </div>

        <div class="span-6 grid ae je rg-30 top-link">
            <a href="#top">Back to top <span class="icon-up"></span></a>
        </div>

    </div>
</footer>

<?php
wp_footer();
kodeks_footer_hook();
?>

</body>

</html>