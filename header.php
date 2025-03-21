<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php
  $urlparts = wp_parse_url(home_url());
  $domain = $urlparts['host'];

  if (strpos($domain, 'dev.kodeks.no') !== false) :
    add_filter('wp_robots', 'wp_robots_no_robots');
  endif;

  wp_head();
  kodeks_header_hook();
  ?>

</head>

<body <?php body_class('kodeks-load'); ?> id="top">

  <?php
  get_template_part('breakpoints');
  kodeks_body_hook();
  ?>

  <a href="#site-content" id="skip-to-content"><?= __('Hopp til innhold', 'kodeks') ?></a>

  <header class="site-header">
    <?php
    // PNG logo
    $logo = wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('alt' => get_bloginfo('name') . ' logo'));
    // SVG logo
    // $logo = kodeks_get_file(wp_get_attachment_url(get_theme_mod('custom_logo')));
    ?>
    <a href="<?php echo home_url(); ?>" class="logo"><?= $logo ?></a>
  </header>

  <?php wp_nav_menu(array('theme_location' => 'primary', '', 'container' => false)); ?>

  <main id="site-content">