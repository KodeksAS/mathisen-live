<?php get_header(); ?>

<section class="resultpage grid padding">

    <h1><?php printf( esc_html__( 'Søkeresultater for %s', 'kodeks' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

    <?php
    if ( have_posts() ) :
    
    while ( have_posts() ) : the_post();

    the_title();

    endwhile;
    else :
    ?>
    <h1><?php printf( esc_html__( 'Ingen treff på ditt søk: %s', 'kodeks' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    <p><?php esc_html_e( 'Ingen treff. Prøv igjen.', 'kodeks' ) ?></p>
    <?php get_search_form(); ?>

</section>

<?php endif;

get_footer();