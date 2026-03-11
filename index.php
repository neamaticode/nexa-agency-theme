<?php
/**
 * NexaAgency - Main Index Template
 *
 * @package NexaAgency
 * @version 1.0.0
 */

get_header();

if ( is_front_page() || is_home() ) {
    get_template_part( 'page-templates/page-home' );
} elseif ( is_singular() ) {
    get_template_part( 'template-parts/content', 'single' );
} elseif ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content' );
    }
} else {
    get_template_part( 'template-parts/content', 'none' );
}

get_footer();
