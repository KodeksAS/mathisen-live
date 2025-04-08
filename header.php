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

        // PNG logo
        // $logo = wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('alt' => get_bloginfo('name') . ' logo'));
        // SVG logo
        $logo = kodeks_get_file(wp_get_attachment_url(get_theme_mod('custom_logo')));
    ?>

</head>

<?php 
    $main_page_color = get_field('main_page_color', 'option');
    ?>

<body <?php body_class('kodeks-load ' . $main_page_color); ?> id="top">
    <?php
        get_template_part('breakpoints');
        kodeks_body_hook();
    ?>
    <a href="#site-content" id="skip-to-content"><?= __('Hopp til innhold', 'kodeks') ?></a>

    
    
    <header class="site-header <?= firstblockcheck(get_the_ID()); ?> <?= $main_page_color ?> ">
        <div class="wrapper grid-12 full side-padding acc">
            <div class="start-1 end-4 end-s-8 grid">
                <a href="<?php echo home_url(); ?>" class="logo"><?= $logo ?></a>
            </div>
            <div class="start-5 end-12 start-s-9 grid acc jce">
                <?php 
                    $args = array(
                        'menu_class' => 'main-menu grid col cg-30 jce',        
                        'container'     => '',
                        'theme_location'=> 'primary',
                        'depth'         => 1,
                        'fallback_cb'   => false
                    );
                    wp_nav_menu( $args ); 
                ?> 
                <a href="javascript:void(0);" id="menu-toggle" class="">
                    <span>Menu</span>
                </a>
            </div>
        </div>
    </header>
  
    <div id="dropdown-menu">
        <div class="dropdown-menu-wrapper">
            <?php 
                $args = array(
                    'menu_class' => 'main-menu-dd cg-30 jce',        
                    'container'     => '',
                    'theme_location'=> 'primary',
                    'depth'         => 1,
                    'fallback_cb'   => false
                );
                wp_nav_menu( $args ); 
            ?>
        </div>
    </div>
    
    <main id="site-content">
