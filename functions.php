<?php

/*
 * Kodeks functions and definitions.
 */

include_once(get_template_directory() . '/inc/blocks.php');
include_once(get_template_directory() . '/inc/hooks.php');
include_once(get_template_directory() . '/inc/cpt.php');
include_once(get_template_directory() . '/inc/project.php');

require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

function kodeks_get_file($path)
{
  $wp_filesystem = new WP_Filesystem_Direct(true);
  $path = ABSPATH . str_replace(get_site_url(), '', $path);
  return $wp_filesystem->get_contents($path);
}

// Remove WP JQuery
function kodeks_remove_jquery()
{
  if ((!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', false);
  }
}
add_action('init', 'kodeks_remove_jquery');

// Add app scripts and styles
function kodeks_load_app_scripts_styles()
{
  wp_enqueue_style('kodeks-app-css', get_template_directory_uri() . '/css/app.min.css', false, kodeks_get_theme_version_number());
  wp_enqueue_script('kodeks-app-js', get_template_directory_uri() . '/js/app.js', false, kodeks_get_theme_version_number(), true);
}
add_action('wp_enqueue_scripts', 'kodeks_load_app_scripts_styles');

function kodeks_add_type_attribute($tag, $handle, $src)
{
  if (str_contains($handle, 'kodeks')) $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
  return $tag;
}
add_filter('script_loader_tag', 'kodeks_add_type_attribute', 10, 3);

// function theme_scripts()
// {
//     wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.6.0.min.js');
// }
// add_action('wp_enqueue_scripts', 'theme_scripts');

// Remove JQuery migrate
function kodeks_remove_jquery_migrate($scripts)
{
  if ((!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') && isset($scripts->registered['jquery'])) {
    $script = $scripts->registered['jquery'];

    if ($script->deps) { // Check whether the script has any dependencies
      $script->deps = array_diff($script->deps, array(
        'jquery-migrate'
      ));
    }
  }
}
add_action('wp_default_scripts', 'kodeks_remove_jquery_migrate');

// Remove wp-embed
function my_deregister_scripts()
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');

// Remove script and style tags
add_action('after_setup_theme', function () {

  add_theme_support('html5', ['script', 'style']);
});

// Remove default image sizes 
add_filter('intermediate_image_sizes', function ($sizes) {
  return array_diff($sizes, ['1536x1536', '2048x2048', 'medium', 'medium_large', 'large']);
});

function kodeks_get_theme_version_number()
{
  $theme = wp_get_theme();
  return $theme->get('Version');
}

// Add admin.css
function load_admin_style()
{
  wp_enqueue_style('admin_css', get_template_directory_uri() . '/css/admin.css', false, kodeks_get_theme_version_number());
}
add_action('admin_enqueue_scripts', 'load_admin_style');

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
  wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);


// Register nav menus
function kodeks_register_menus()
{
  register_nav_menus(array(
    'primary' => esc_html__('Primary', 'kodeks'),
    'secondary' => esc_html__('Secondary', 'kodeks'),
  ));
}
add_action('after_setup_theme', 'kodeks_register_menus');

// Add GTM
function kodeks_add_GTM()
{
  $gtm = '';
  if (function_exists('get_field')) {
    if (get_field('gtm', 'options')) :
      echo '<script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: "gtm.js"
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "' . get_field('gtm', 'options') . '");
        </script>';
    endif;
  }
}
add_action('kodeks_header_hook', 'kodeks_add_GTM');

function kodeks_add_GTM_body()
{
  if (function_exists('get_field')) {
    if (get_field('gtm', 'options')) {
      echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . get_field("gtm", "options") . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
    }
  }
}
add_action('kodeks_body_hook', 'kodeks_add_GTM_body');

function kodeks_add_breakpoints()
{
  include_once(get_template_directory() . '/inc/breakpoints.php');
}
add_action('kodeks_header_hook', 'kodeks_add_breakpoints');

// Add image to block preview
function block_render($block, $block_name, $content = '', $is_preview = false)
{
  echo '<img width="100%" height="auto" src="' . get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block_name . '.jpg" />';
}
// Global columns
function global_columns()
{
  $global_columns = 'grid-12 grid-m-8 grid-s-4';
  return $global_columns;
}

// Slugify
function slugify($word)
{
  return mb_strtolower(trim(preg_replace('/[^A-Za-z0-9-ÆØÅæøåAöÖäÄ]+/', '-', $word)), 'UTF-8');
}

// ACF theme folder

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf-json';
  return $path;
}

add_filter('acf/settings/load_json', function ($paths) {
  $paths = array();

  if (is_child_theme()) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
  }

  $paths[] = get_template_directory() . '/acf-json';

  return $paths;
});


// Refresh theme page for theme updates (GitHub Updater)
function kodeks_refresh_cache_theme_page()
{
  global $wpdb;
  global $pagenow;
  if ($pagenow == 'themes.php') {
    if (!isset($_GET['kodeks_reload'])) {

      $table         = is_multisite() ? $wpdb->base_prefix . 'sitemeta' : $wpdb->base_prefix . 'options';
      $column        = is_multisite() ? 'meta_key' : 'option_name';
      $delete_string = 'DELETE FROM ' . $table . ' WHERE ' . $column . ' LIKE %s LIMIT 1000';

      $wpdb->query($wpdb->prepare($delete_string, ['%ghu-%']));

      wp_cron();
      wp_cache_flush();

      header('Location: ' . $_SERVER['REQUEST_URI'] . '?kodeks_reload');
    }
  }
}
add_action('admin_init', 'kodeks_refresh_cache_theme_page');


// Add post id to block attributes
add_filter(
  'acf/pre_save_block',
  function ($attributes) {

    $attributes['post_id'] = acf_maybe_get_POST('post_id') ?: (isset($_POST['post_ID']) ? $_POST['post_ID'] : null);

    return $attributes;
  }
);


// Hide WP Rocket meta box on all post types
function kodeks_hide_rocket_meta_box()
{

  // Get all registered post types
  $post_types = get_post_types();

  foreach ($post_types as $post_type) {
    remove_meta_box('rocket_post_exclude', $post_type, 'normal');
  }
}
add_action('admin_menu', 'kodeks_hide_rocket_meta_box', 99);

// Add custom CSS classes to WP Rocket LazyRender exclusion
add_filter('rocket_lrc_exclusions', function ($exclusions) {
  $exclusions[] = 'site-footer';
  return $exclusions;
});
