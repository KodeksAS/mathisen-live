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

<body <?php body_class('kodeks-load'); ?> id="top">
    <?php
        get_template_part('breakpoints');
        kodeks_body_hook();
    ?>
    <a href="#site-content" id="skip-to-content"><?= __('Hopp til innhold', 'kodeks') ?></a>
    
    <header class="site-header">
        <div class="wrapper grid full side-padding acc">
            <div class="start-1 end-6 grid">
                <a href="<?php echo home_url(); ?>" class="logo"><?= $logo ?></a>
            </div>
            <div class="start-7 end-12 grid acc jce">
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
        <!-- div class="wrapper grid-12 full acs js cg-s-0 side-padding">
            <div class="span-all">
                <h1>High quality brands for industrial flooring and coating </h1>
            </div>
            <div class="start-1 grid acc jcc col-1 odd">
                col 1
            </div>
            <div class="start-2 grid acc jcc col-2 even">
                col 2
            </div>
            <div class="start-3 grid acc jcc col-3 odd">
                col 3
            </div>
            <div class="start-4 grid acc jcc col-4 even">
                col 4
            </div>
            <div class="start-5 grid acc jcc col-5 odd">
                col 5
            </div>
            <div class="start-6 grid acc jcc col-6 even">
                col 6
            </div>
            <div class="start-7 grid acc jcc col-7 odd">
                col 7
            </div>
            <div class="start-8 grid acc jcc col-8 even">
                col 8
            </div>
            <div class="start-9 grid acc jcc col-9 odd">
                col 9
            </div>
            <div class="start-10 grid acc jcc col-10 even">
                col 10
            </div>
            <div class="start-11 grid acc jcc col-11 odd">
                col 11
            </div>
            <div class="start-12 grid acc jcc col-12 even">
                col 12
            </div>
        </div -->

