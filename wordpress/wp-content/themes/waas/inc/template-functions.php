<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function waas_theme_body_classes( $classes ) {

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	// Adds a class if image filters are enabled.
	if ( waas_theme_image_filters_enabled() ) {
		$classes[] = 'image-filters-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'waas_theme_body_classes' );

/**
 * Adds custom class to the array of posts classes.
 */
function waas_theme_post_classes( $classes, $class, $post_id ) {
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'waas_theme_post_classes', 10, 3 );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function waas_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'waas_theme_pingback_header' );


/**
 * Determines if post thumbnail can be displayed.
 */
function waas_theme_can_show_post_thumbnail() {
	return apply_filters( 'waas_theme_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns true if image filters are enabled on the theme options.
 */
function waas_theme_image_filters_enabled() {
	return 0 !== get_theme_mod( 'image_filter', 1 );
}