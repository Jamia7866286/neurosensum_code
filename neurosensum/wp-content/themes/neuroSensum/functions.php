<?php
/**
 * Acodez Themes functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acodez_Themes
 */


if ( ! function_exists( 'acodez_themes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function acodez_themes_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Acodez Themes, use a find and replace
	 * to change 'acodez-themes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'acodez-themes', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'acodez-themes' ),
		'footer' => esc_html__( 'Footer', 'acodez-themes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


}
endif;
add_action( 'after_setup_theme', 'acodez_themes_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acodez_themes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'acodez-themes' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'acodez-themes' ),
		'before_widget' => '<div id="%1$s" class="pagewidget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'acodez_themes_widgets_init' );
// Hide Wordpress Version Generator
add_filter('the_generator', 'version');
function version() {
	return '';
}
/* Add Next Page Button in First Row */
add_filter( 'mce_buttons', 'my_add_next_page_button', 1, 2 ); // 1st row
/**
 * Add Next Page/Page Break Button
 */
function my_add_next_page_button( $buttons, $id ){
	/* only add this for content editor */
	if ( 'content' != $id )
		return $buttons;
	/* add next page after more tag button */
	array_splice( $buttons, 13, 0, 'wp_page' );
	return $buttons;
}
// Reset Post Data On Theme Change
function my_rewrite_flush() {
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'my_rewrite_flush');
wp_reset_postdata();
/**
 * Enqueue scripts and styles.
 */
function acodez_themes_scripts() {
	wp_enqueue_style( 'acodez-themes-style', get_stylesheet_uri() );
	wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js');




	wp_register_script('vide', get_template_directory_uri() . '/js/jquery.vide.js', array('jquery'), '', true);
	wp_register_script('bpopup', get_template_directory_uri() . '/js/jquery.bpopup.min.js', array('jquery'), '', true);
	wp_register_script('cercle-canvas', get_template_directory_uri() . '/js/cercle-canvas.js', array('jquery'), '', true);
	wp_register_script('canvas', get_template_directory_uri() . '/js/canvas.js', array('jquery'), '', true);
	wp_register_script('sumoselect', get_template_directory_uri() . '/js/jquery.sumoselect.js', array('jquery'), '', true);
	wp_register_script('paroller', get_template_directory_uri() . '/js/jquery.paroller.js', array('jquery'), '', true);
	wp_register_script('aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), '', true);
	wp_register_script('wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '', true);
	// wp_register_script('skrollr', get_template_directory_uri() . '/js/skrollr.js', array('jquery'), '', true);
	wp_register_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);

	wp_register_script('validate', get_template_directory_uri() . '/js/validate.js', array('jquery'), '', true);
	wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'), '', true);
	wp_register_script('magnific', get_template_directory_uri() . '/js/magnific-popup.min.js', array('jquery'), '', true);
	wp_register_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), '', true);




	/*wp_enqueue_script( 'acodez-themes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'acodez-themes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}*/



	//wp_enqueue_script('bpopup');
	wp_enqueue_script('magnific');
	wp_enqueue_script('wow');
	// wp_enqueue_script('skrollr');
	wp_enqueue_script('aos');
	wp_enqueue_script('main');
wp_enqueue_script('vide');




}

add_action( 'wp_enqueue_scripts', 'acodez_themes_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * BFI thumb.
 */
require get_template_directory() . '/inc/BFI_Thumb.php';

global $post;
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Service', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Services', 'text_domain' ),
		'name_admin_bar'        => __( 'Services', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'service', $args );



/*Case Studies*/
	$labels1 = array(
		'name'                  => _x( 'Case Study', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Case Studies', 'text_domain' ),
		'name_admin_bar'        => __( 'Case Studies', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args1 = array(
		'label'                 => __( 'Case Study', 'text_domain' ),
		'labels'                => $labels1,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'casestudies', $args1 );


/*Career*/
	$labels2 = array(
		'name'                  => _x( 'Career', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Career', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Careers', 'text_domain' ),
		'name_admin_bar'        => __( 'Careers', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args2 = array(
		'label'                 => __( 'Career', 'text_domain' ),
		'labels'                => $labels2,
		'supports'              => array( 'title', 'editor',  'thumbnail', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'career', $args2 );

		register_taxonomy(
	   'department', 'career', array(
	   'label' => __(' Department '),
	   'rewrite' => array('slug' => 'department'),
	   'hierarchical' => true,
	   'show_admin_column' => true
	   )
	);

	register_taxonomy(
   'career-location', 'career', array(
   'label' => __('Career Location'),
   'rewrite' => array('slug' => 'career-location'),
   'hierarchical' => true,
   'show_admin_column' => true
   )
);
/* career end*/


$labels3 = array(
	'name'                  => _x( 'Press', 'Post Type General Name', 'text_domain' ),
	'singular_name'         => _x( 'Press', 'Post Type Singular Name', 'text_domain' ),
	'menu_name'             => __( 'Press', 'text_domain' ),
	'name_admin_bar'        => __( 'Press', 'text_domain' ),
	'archives'              => __( 'Item Archives', 'text_domain' ),
	'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
	'all_items'             => __( 'All Items', 'text_domain' ),
	'add_new_item'          => __( 'Add New Item', 'text_domain' ),
	'add_new'               => __( 'Add New', 'text_domain' ),
	'new_item'              => __( 'New Item', 'text_domain' ),
	'edit_item'             => __( 'Edit Item', 'text_domain' ),
	'update_item'           => __( 'Update Item', 'text_domain' ),
	'view_item'             => __( 'View Item', 'text_domain' ),
	'search_items'          => __( 'Search Item', 'text_domain' ),
	'not_found'             => __( 'Not found', 'text_domain' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
	'featured_image'        => __( 'Featured Image', 'text_domain' ),
	'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
	'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
	'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
	'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
	'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
	'items_list'            => __( 'Items list', 'text_domain' ),
	'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
	'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
);
$args3 = array(
	'label'                 => __( 'Press', 'text_domain' ),
	'labels'                => $labels3,
	'supports'              => array( 'title', 'editor',  ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 8,
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => false,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	'capability_type'       => 'page',
);
register_post_type( 'press', $args3 );

	register_taxonomy(
	 'media', 'press', array(
	 'label' => __(' Media type '),
	 'rewrite' => array('slug' => 'media'),
	 'hierarchical' => true,
	 'show_admin_column' => true
	 )
);



}
add_action( 'init', 'custom_post_type', 0 );


/* move_comment_field_to_bottom */
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
/* move_comment_field_to_bottom */

function twentytwelve_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e('Pingback:', 'twentytwelve'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <div class="aside">
                            <div class="comment-meta comment-author vcard">
                                <div class="cmt1">
                                <?php
                                    echo get_avatar($comment, 44);
                                ?>
                                </div>
                                <div class="cmt2">
                                <?php
                                printf('<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(),
                                        // If current post author is also comment author, make it known visually.
                                        ( $comment->user_id === $post->post_author ) ? '<span> ' . __('Post author', 'twentytwelve') . '</span>' : ''
                                );


                                printf('<time datetime="%2$s">%3$s</time>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                            /* translators: 1: date, 2: time */ sprintf(__('%1$s ', 'twentytwelve'), get_comment_date())
                                    );

                                ?>
                                </div>
                            </div><!-- .comment-meta -->

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'twentytwelve'); ?></p>
                            <?php endif; ?>

                            <section class="comment-content comment">
                                <?php comment_text(); ?>
                                <?php edit_comment_link(__('Edit', 'twentytwelve'), '<p class="edit-link">', '</p>'); ?>
                            </section><!-- .comment-content -->

                            <div class="rep-det">



                                <div class="reply">
                                    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'twentytwelve'), 'after' => ' ', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                </div><!-- .reply -->
                            </div>

                        </div>
                    </article><!-- #comment-## -->
                    <?php
                    break;
            endswitch; // end comment_type check
        }




    //Contact form


add_action('wp_ajax_nopriv_contactform', 'ns_contactform');
add_action('wp_ajax_contactform', 'ns_contactform');

function ns_contactform() {


	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
		        //your site secret key
		        $secret = get_field('recaptcha_secretkey','option');
		        //get verify response data
		        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		        $responseData = json_decode($verifyResponse);
		        if($responseData->success){

if (!(isset($_POST['fname']) && !empty($_POST['fname'])  && isset($_POST['subject']) && !empty($_POST['subject']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['message']) && !empty($_POST['message']))) {
         echo 'Enter all the fields';

    } else    if (!is_email($_POST['email'])) {
        echo 'Sorry, You have entered an invalid Email Address';
    } else {
        if (get_field('contact_mail','option')) {
            $to = get_field('contact_mail','option');
        } else {
            $to = get_bloginfo('admin_email');
        }

        ob_start();
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>.:  :.</title>
            </head>

            <body style="background-color:#F0EEE0; margin:0px;">
                <table width="100%" border="0" cellpadding="0">
                    <tr>
                        <td align="center" valign="top" style="background-color:#F0EEE0; margin:0px;"><table width="572" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:18px; color:#444444; ">
                                <tr>
                                    <td align="center" valign="top" style="padding-bottom:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="background-color:#FFF; padding:20px; border-right:1px solid #d6d6d6; border-bottom:2px solid #d6d6d6;">
                                        <p style="color:#504e4e; font-size:16px;"><span class="footer"><strong>Contact email</strong></span></p>
                                        <table width="100%" border="0" cellspacing="2" cellpadding="4">
                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Name</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['fname']; ?></strong></td>
                                            </tr>

                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">E-mail </td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['email'] ?></strong></td>
                                            </tr>
                                             <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Subject</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['subject']; ?></strong></td>
                                            </tr>

                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Message</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo nl2br($_POST['message']) ?></strong></td>
                                            </tr>

                                        </table>
                                        <p>Thank you<br />
                                            <a href="<?php echo home_url('/'); ?>" target="_blank" style="color:#504e4e;"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> </a><br />
                                        </p></td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style=" text-align:center; color:#4c4c4c; font-size:11px; padding:15px 0px;"><span class="footer"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>. All rights reserved</span></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
            </body>
        </html>

        <?php
        $message = ob_get_contents();
        ob_end_clean();
        $subject =  get_bloginfo( 'name', 'display' )  .'- Contact Email';
        $headers[] = 'From: ' . $_POST["fname"] . ' <' . $_POST["email"] . '>';
        add_filter('wp_mail_content_type', 'ch_html_content_type');

        function ch_html_content_type() {
            return 'text/html';
        }

        $thnq = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>.:  :.</title></head><body style="background-color:#F0EEE0; margin:0px;"><table width="100%" border="0" cellpadding="0"><tr><td align="center" valign="top" style="background-color:#F0EEE0; margin:0px;"><table width="572" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:18px; color:#444444; "><tr><td align="center" valign="top" style="padding-bottom:10px;">&nbsp;</td></tr><tr><td align="left" valign="top" style="background-color:#FFF; padding:20px; border-right:1px solid #d6d6d6; border-bottom:2px solid #d6d6d6;">';
        $thnq .= '<p style="background: #FFF;text-align: center;">
<img src='.esc_url( get_theme_mod( 'acodez-themes_logo' ) ).' alt='. esc_attr( get_bloginfo( 'name', 'display' ) ).'>
        </p>';
        $thnq .= '<p style="color:#504e4e; font-size:16px; padding-left: 2px;">';
        $thnq .= '<span class="footer"><strong>Email acknowledgement from '. esc_attr( get_bloginfo( 'name', 'display' ) ) .' website</strong></span>';
        $thnq .= '</p><table width="100%" border="0" cellspacing="2" cellpadding="4"><tr>';
        $thnq .= '<td  align="left" colspan="2" valign="middle" style="border-bottom:1px solid #e2dfd9; padding-left: 0px;">Thank You for showing your interest. We will get back to you shortly.</td>';
        $thnq .= '</tr></table><p>Thank you<br />';
        $thnq .= '<a href="'. home_url('/').'" target="_blank" style="color:#504e4e;">'. esc_attr( get_bloginfo( 'name', 'display' ) ) .'</a><br />';
        $thnq .= '</p></td></tr><tr>';
        $thnq .= '<td align="left" valign="top" style=" text-align:center; color:#4c4c4c; font-size:11px; padding:15px 0px;"><span class="footer">'.esc_attr( get_bloginfo( 'name', 'display' ) ).' All rights reserved</span></td>';
        $thnq .= '</tr></table></td></tr></table></body></html>';

        $pieces = explode(",", $to);
        $to1 =$pieces[0];

        $head[] = 'From:'.esc_attr( get_bloginfo( 'name', 'display' ) ).' <' . $to1 . '>';
        $subj = esc_attr( get_bloginfo( 'name', 'display' ) ).' Contact email acknowledgement';


        if (wp_mail($to, $subject, $message, $headers)) {
            echo 1;
            wp_mail($_POST["email"], $subj, $thnq, $head);
        } else {
            echo 0;
        }
  }
		} else {
			echo 'Robot verification failed, please try again.';
		}
	} else {
		echo 'Please click on the reCAPTCHA box.';
	}
	    die();

	}


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Header Settings',
	// 	'menu_title'	=> 'General Settings',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Footer Settings',
		'parent_slug'	=> 'theme-general-settings',
	));


}

/* * *********** contact form career page*********** */

add_action('wp_ajax_nopriv_careerform', 'careerform');
add_action('wp_ajax_careerform', 'careerform');

function careerform() {
    $siteTitle=get_bloginfo('name');


    if (!(isset($_POST['fname']) && !empty($_POST['fname']) && isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['phone'])  && !empty($_POST['phone'])  && !empty($_POST['subject'])  && !empty($_POST['subject']))) {
        echo 'Enter all the fields';

    } else if (!is_email($_POST['email'])) {
        echo 'Sorry, You have entered an invalid Email Address';
    } else {
        if (get_field('career_mail','option')) {
             $to = get_field('career_mail','option');
        } else {
            $to = get_bloginfo('admin_email');
        }



				        function ueber_upload_dir($upload) {
				            $upload['subdir'] = $upload['subdir'] . '/resume';
				            $upload['path'] = $upload['basedir'] . '/resume';
				            $upload['url'] = $upload['baseurl'] . '/resume';
				            return $upload;
				        }

				        if (!function_exists('wp_handle_upload')) {
				            require_once( ABSPATH . 'wp-admin/includes/file.php' );
				        }

				        $attachements = array();
				        $uploadedfile = $_FILES['fileupload'];

				        $upload_overrides = array('test_form' => false);
				        add_filter('upload_dir', 'ueber_upload_dir');

				        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

				        if ($movefile) {
				            $atach = $movefile['url'];
				            $attachements[] = $movefile["file"];
				        } else {
				            echo "Possible file upload attack!\n";
				        }



        ob_start();
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>.:  :.</title>
            </head>

            <body style="background-color:#F0EEE0; margin:0px;">
                <table width="100%" border="0" cellpadding="0">
                    <tr>
                        <td align="center" valign="top" style="background-color:#F0EEE0; margin:0px;"><table width="572" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:18px; color:#444444; ">
                                <tr>
                                    <td align="center" valign="top" style="padding-bottom:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="background-color:#FFF; padding:20px; border-right:1px solid #d6d6d6; border-bottom:2px solid #d6d6d6;">
                                        <p style="color:#504e4e; font-size:16px;"><span class="footer"><strong>Career Request email</strong></span></p>
                                        <table width="100%" border="0" cellspacing="2" cellpadding="4">
                                        	 <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Applied Career Title</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['job-title']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Name</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['fname']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">E-mail </td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['email'] ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Telephone </td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo $_POST['phone'] ?></strong></td>
                                            </tr>


                                            <tr>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Message</td>
                                                <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong><?php echo nl2br($_POST['subject']) ?></strong></td>
                                            </tr>

                                        </table>
                                        <p>Thank you<br />
                                            <a href="<?php echo home_url('/'); ?>" target="_blank" style="color:#504e4e;"><?php echo $siteTitle  ?> </a><br />
                                        </p></td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style=" text-align:center; color:#4c4c4c; font-size:11px; padding:15px 0px;"><span class="footer"><?php echo $siteTitle ?>. All rights reserved</span></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
            </body>
        </html>

        <?php
        $message = ob_get_contents();
        ob_end_clean();
        $subject = $siteTitle.' Career Email Request';
        $headers[] = 'From: ' . $_POST["fname"] . ' <' . $_POST["email"] . '>';
        add_filter('wp_mail_content_type', 'ch_html_content_type');

        function ch_html_content_type() {
            return 'text/html';
        }

        $thnq = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>.:  :.</title></head><body style="background-color:#F0EEE0; margin:0px;"><table width="100%" border="0" cellpadding="0"><tr><td align="center" valign="top" style="background-color:#F0EEE0; margin:0px;"><table width="572" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:18px; color:#444444; "><tr><td align="center" valign="top" style="padding-bottom:10px;">&nbsp;</td></tr><tr><td align="left" valign="top" style="background-color:#FFF; padding:20px; border-right:1px solid #d6d6d6; border-bottom:2px solid #d6d6d6;">';
        $thnq .= '<p style="background: #FFF;text-align: center;"><img src="'.  esc_url( get_theme_mod( 'acodez-themes_logo' ) ).'" alt="" /></p>';
        $thnq .= '<p style="color:#504e4e; font-size:16px; padding-left: 2px;">';
        $thnq .= '<span class="footer"><strong>Career Email acknowledgement from '.$siteTitle.' website</strong></span>';
        $thnq .= '</p><table width="100%" border="0" cellspacing="2" cellpadding="4"><tr>';
        $thnq .= '<td  align="left" colspan="2" valign="middle" style="border-bottom:1px solid #e2dfd9; padding-left: 0px;">Thank You for showing your interest. We will get back to you shortly.</td>';
        $thnq .= '</tr></table><p>Thank you<br />';
        $thnq .= '<a href="'. home_url('/').'" target="_blank" style="color:#504e4e;">'.$siteTitle.'</a><br />';
        $thnq .= '</p></td></tr><tr>';
        $thnq .= '<td align="left" valign="top" style=" text-align:center; color:#4c4c4c; font-size:11px; padding:15px 0px;"><span class="footer">'.$siteTitle.'. All rights reserved</span></td>';
        $thnq .= '</tr></table></td></tr></table></body></html>';

        $pieces = explode(",", $to);
        $to1 =$pieces[0];

        $head[] = 'From:'.$siteTitle.'<' . $to1 . '>';
        $subj = $siteTitle.'- Career email acknowledgement';


        if (wp_mail($to, $subject, $message, $headers, $attachements)) {

            wp_mail($_POST["email"], $subj, $thnq, $head);
			return 1;
        } else {
            return 0;
        }
    }
    die();

}




/* * *********** contact form career page*********** */

//Career Title Search

add_action('wp_ajax_nopriv_find_more_careers', 'find_more_careers');
add_action('wp_ajax_find_more_careers', 'find_more_careers');

function find_more_careers() {

if(($_REQUEST['keyword']!='') && ($_REQUEST['slt']!='')){
  $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
	's' =>  $_REQUEST['keyword'],
        'tax_query' => array(
		array(
			'taxonomy' => 'career-location',
			'field'    => 'slug',
			'terms'    => $_REQUEST['slt'],
		),
	),

    );

}else if($_REQUEST['keyword']!='') {

$args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
	's' =>  $_REQUEST['keyword'],


    );

}else if($_REQUEST['slt']!='') {
 $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
        'tax_query' => array(
		array(
			'taxonomy' => 'career-location',
			'field'    => 'slug',
			'terms'    => $_REQUEST['slt'],
		),
	),

    );

}else{ $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',


    );
}


  $query = new WP_Query( $args );
  $count = $query->post_count;

$html='<div class="listing_widget">';


				    if ($query->have_posts()) {
$html.='<ul>';
				      while ($query->have_posts()) { $query->the_post();
				        $fim = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				        $thumb_pr = array( 'width' => 88, 'height' => 81 );
				        $logoimg = bfi_thumb( $fim, $thumb_pr );
				        $delay = 0.8;$link=get_the_permalink();
$title=get_the_title();



			 $html.='<li data-aos="fade-right"  data-aos-offset="'. $delay.'s">
				<span class="com_logo">
					<img src="'. $logoimg.'" alt="logo">
				</span>
				<div class="content_widget">

					<h4><a href="'.$link.'"> '. $title.'</a></h4>

					<ul class="location">';

						$terms = get_the_terms( $post->ID , array( 'career-location') );
// init counter
//$i = 1;
foreach ( $terms as $term ) {

 $html.= '<li>'.$term->name.'</li>';
}
					 $html.='</ul>

					<p>';

							$content = get_the_content();
							if( strlen($content) <= 120 ){
			                    $content= $content;
			                  } else {
			                     $content=substr($content, 0,120).'...';
			                  }

				$html.=	$content.'</p>
				</div>
				<h6 class="post_date">Posted '. esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago</h6>



			</li>';



}

        $delay++;



     $html.='</ul>';
      }else{
$html.='<p class="no-result"><span>No vacancy available</span></p>';
}

			$html.='</div>';

  echo $html;
  die();

}





//Career  Search Single

add_action('wp_ajax_nopriv_find_more_careers_single', 'more_careers_single');
add_action('wp_ajax_more_careers_single', 'more_careers_single');

function more_careers_single() {
//$keywords= explode("#", $_REQUEST['keyword']);

 // $keyword = $keywords[0];
 //if($keywords[1]=='key'){

if(($_REQUEST['keyword']!='') && ($_REQUEST['slt']!='')){
  $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
	's' =>  $_REQUEST['keyword'],
        'tax_query' => array(
		array(
			'taxonomy' => 'career-location',
			'field'    => 'slug',
			'terms'    => $_REQUEST['slt'],
		),
	),

    );

}else if($_REQUEST['keyword']!='') {

$args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
	's' =>  $_REQUEST['keyword'],


    );

}else if($_REQUEST['slt']!='') {
 $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
        'tax_query' => array(
		array(
			'taxonomy' => 'career-location',
			'field'    => 'slug',
			'terms'    => $_REQUEST['slt'],
		),
	),

    );

}else{ $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => '-1',


    );
}

  $query = new WP_Query( $args );
  $count = $query->post_count;








$html='';

   if ($query->have_posts()) {
				      while ($query->have_posts()) { $query->the_post();
$id=get_the_ID();
$title=get_the_title();
 $fim = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				        $thumb_pr = array( 'width' => 88, 'height' => 81 );
				        $logoimg = bfi_thumb( $fim, $thumb_pr );

	$content=get_the_content('<p class="serif">Read the rest of this entry &raquo;</p>');
           $html.='<div class="post clearfix wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s" id="post-'. $id.'" >';


                  if ( has_post_thumbnail() ) {
                        $html.= '<figure class="thumbnail"><img src="'. $logoimg.'" alt="logo">';

                       $html.=  '</figure>';
                    }
                $html.= '<h6 class="post_date">Posted '.esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago</h6>
                 <h4>'
                    .$title.'
                </h4>
                <ul class="location">';

						$terms = get_the_terms( $post->ID , array( 'career-location') );
// init counter
//$i = 1;
foreach ( $terms as $term ) {

 $html.= '<li>'.$term->name.'</li>';
}
					 $html.='</ul>

					<p>Job Description:</p>'.$content .' </div>' ;




            }}
 $html.='</div>';





  echo $html;
  die();

}



function my_script_hide_type($src) {
    return str_replace("type='text/javascript'", '', $src);
}
add_filter('script_loader_tag', 'my_script_hide_type');

function my_style_hide_type($src) {
    return str_replace("type='text/css'", '', $src);
}
add_filter('style_loader_tag', 'my_style_hide_type');


remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 12);
/* shortcode */

function row_box($atts, $content = "") {
		$content = trim($content);
   return '<div class="application">'.do_shortcode($content).'</div>';

}

add_shortcode("box", "row_box");

/* shortcode */



add_action('wp_ajax_nopriv_list_career_cat', 'ns_list_career_cat');
add_action('wp_ajax_list_career_cat', 'ns_list_career_cat');

function ns_list_career_cat() {

$dep = $_REQUEST['dep'];
$loc = $_REQUEST['loc'];

$str ='';
$tax_query ='';
$tax_query = array('relation' => 'AND');

$wargs = array(
	'post_type' => 'career',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'orderby' => 'menu_order',
	'order' => 'ASC'
);

if (isset($dep) && $dep !=''){
	$wargs['tax_query'][0]['taxonomy'] = 'department';
	$wargs['tax_query'][0]['field'] = 'slug';
	$wargs['tax_query'][0]['terms'] = $dep;
}

if (isset($loc) && $loc !=''){
	$wargs['tax_query'][1]['taxonomy'] = 'career-location';
	$wargs['tax_query'][1]['field'] = 'slug';
	$wargs['tax_query'][1]['terms'] = $loc;
}

$w_items = new WP_Query($wargs);
if ($w_items->have_posts()) {
//$str .='<ul>';
	while ($w_items->have_posts()):$w_items->the_post();

	$fim = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$thumb_pr = array( 'width' => 88, 'height' => 81 );
	$logoimg = bfi_thumb( $fim, $thumb_pr );
	$delay = 0.8;

		$str .='<li data-aos="fade-right"  data-aos-offset="<?php echo $delay; ?>s">
			<span class="com_logo">
				<img src="'. $logoimg .'" alt="logo">
			</span>
			<div class="content_widget">
				<h4><a href="'. get_the_permalink() .'"> '. get_the_title() .'</a></h4>
				<ul class="location">';
			 $terms1 = get_the_terms( $post->ID , array( 'career-location') );
				if($terms1 ){
					foreach ( $terms1 as $term1 ) {
						$str .='<li>'. $term1->name .'</li>';
					}
				}
				$str .='</ul>';
				$str .='<p>';

						$content = get_the_content();
						if( strlen($content) <= 120 ){
							$str .= $content;
						} else {
							$str .= substr($content, 0,120).'...';
						}
				$str .='</p>';
				$str .='</div>
			<h6 class="post_date">Posted '. esc_html( human_time_diff( get_the_time("U"), current_time("timestamp") ) ) . ' ago </h6>';

		$str .='</li>';
	endwhile;
} else {

	$str .='<li data-aos="fade-right" data-aos-offset="0.8s" class="aos-init aos-animate">
			<div class="content_widget"><h4> No vacancy available </h4></div>
			</li>';

}
$delay++;
echo $str;

	die();
}
