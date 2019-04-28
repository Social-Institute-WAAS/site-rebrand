<?php
/**
 * WAAS THEME functions and definitions
 * 
 */


if ( ! function_exists( 'waas_theme_setup' ) ) :

    function waas_theme_setup() {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'waas_theme', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        
        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1568, 9999 );
        

        add_theme_support('menus');
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'top-menu' => __('Primary', 'waas_theme'),
                'footer-menu' => __('Footer Menu', 'waas_theme'),
                'social' => __('Social Links Menu', 'waas_theme')
            )
        );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );
        


    } // end function waas_theme_setup
endif;

add_action( 'after_setup_theme', 'waas_theme_setup' );







/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function waas_theme_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'waas_theme' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'waas_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'waas_theme_widgets_init' );



function add_google_fonts() {
    wp_enqueue_style('add_google_fonts', 'https://fonts.googleapis.com/css?family=Nunito:400,900', false);
}
add_action('wp_enqueue_scripts', 'add_google_fonts' );

function load_stylesheets() {
    // wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array() , false, 'all' );
    // wp_enqueue_style('bootstrap');
    
    // THE LAST to overwrite
    wp_register_style('style', get_template_directory_uri().'/style.77b9.css', array() , false, 'all' );
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts' , 'load_stylesheets');

function include_vendors() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery','https://code.jquery.com/jquery-3.3.1.slim.min.js', '',1, true);
    add_action('wp_enqueue_scripts' , 'jquery');

    wp_register_script('popperjs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' , '', 1, true);
    wp_enqueue_script('popperjs');

    wp_register_script('bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' , '', 1, true);
    wp_enqueue_script('bootstrapjs');

}
add_action('wp_enqueue_scripts' , 'include_vendors');


function loadjs() {
    // true in the footer
    //false not in the footer
    wp_register_script('appjs', get_template_directory_uri(). '/scripts/app.js' , '', 2 , true);
    wp_enqueue_script('appjs');

}

add_action('wp_enqueue_scripts', 'loadjs');




/**
 * Bootstrap class structure.
 */
if ( ! file_exists( get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
	require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
}

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';