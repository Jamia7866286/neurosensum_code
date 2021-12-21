<?php


/*======================================
    Setup
======================================*/
add_theme_support('menus');
add_theme_support( 'custom-logo');
add_theme_support( 'post-thumbnails' );


/*======================================
    Includes
======================================*/

include( get_template_directory() . '/inc/scripts.php' );
include( get_template_directory() . '/inc/remove.php' );
include( get_template_directory() . '/inc/svg.php' );
include( get_template_directory() . '/inc/menu.php' );
include( get_template_directory() . '/inc/widgets.php' );
include( get_template_directory() . '/inc/nav.php' );
include( get_template_directory() . '/inc/reading-time.php' );
include( get_template_directory() . '/inc/featured-post.php' );
include( get_template_directory() . '/inc/latest-post.php' );
include( get_template_directory() . '/inc/duplicate.php' );
include( get_template_directory() . '/inc/trending-articles.php' );
include( get_template_directory() . '/inc/bottom-subscribe.php' );
include( get_template_directory() . '/inc/blog-header.php' );
include( get_template_directory() . '/inc/related-content.php' );
include( get_template_directory() . '/example-functions.php' );

/*======================================
    Action and Filter Hooks
======================================*/


add_filter('upload_mimes', 'cc_mime_types');
add_filter( 'style_loader_tag',  'clean_style_tag'  );
add_filter( 'script_loader_tag', 'clean_script_tag'  );
add_action( 'admin_init', 'remove_gravity_forms_nag' );
add_action( 'init', 'register_my_menus' );
add_action( 'widgets_init', 'header_cta' );
add_action( 'widgets_init', 'footer_cta' );
add_action( 'widgets_init', 'net_promoter_score_footer_cta' );
add_action( 'widgets_init', 'footer_phone' );
add_action( 'widgets_init', 'blog_search' );
add_action( 'widgets_init', 'session_search' );
add_action( 'widgets_init', 'automate_process' );
add_action ('wp_enqueue_scripts', 'add_scripts', 99);
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );


/*======================================
    Theme option
======================================*/

 if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/includes/' );
	require_once dirname( __FILE__ ) . '/includes/options-framework.php';
}

/*====================================== 
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
======================================*/
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
 
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array(
	  	"src" => array(),
        "type" => array(),
		"async" => array(),
		
	  );
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}



/*======================================
    Reduce Excerpt words
======================================*/

function wpdocs_custom_excerpt_length( $length ) {
    return 26;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/*======================================
    Load More
======================================*/
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '10',
        'paged' => $paged,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
        <?php $k=0; while ( $my_posts->have_posts() ) : $my_posts->the_post(); $posts_id = get_the_ID(); ?>
            <?php if($k<=1){ ?>
            <div <?php post_class('col-md-6 col6') ?>>
                <div class="post-single post-small">
                    <?php 
                        if (has_post_thumbnail()):?>
                    <figure>
                        <a href="<?php the_permalink() ?>">
                        <?php  the_post_thumbnail(); ?>
                        </a>
                    </figure>
                    <?php endif; ?>
                    <div class="post-content">
                        <?php
                            $category = get_the_category($posts_id);
                            echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
                            //echo 'postid=>>'.$posts_id;
                            ?>
                        <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>  </h2>
                        <?php /*?><div class="content">
                            <?php the_excerpt(); ?>
                        </div>
                        <p class="reading-time"><?php echo reading_time(); ?></p>
                        <?php /*?><div class="social-share">
                            <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                        </div><?php */?>
                        <a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
                        </a>    
                    </div>
                </div>
            </div>
		<?php } else { ?>
         <div <?php post_class('col-md-4 col3') ?>>
			<div class="post-single post-large">
				<?php 
					if (has_post_thumbnail()):?>
				<figure>
					<a href="<?php the_permalink() ?>">
					<?php  the_post_thumbnail(); ?>
					</a>
				</figure>
				<?php endif; ?>
				<div class="post-content">
					<?php
						$category = get_the_category($posts_id);
						echo '<a href="'.get_category_link($category[0]->cat_ID).'" class="category">' . $category[0]->cat_name . '</a>';
                        //echo 'postid=>>'.$posts_id;
                        //echo 'exclude_featured=>>'.$exclude_featured;
						?>
					<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<?php /*?><div class="content">
						<?php the_excerpt(); ?>
					</div>
					<p class="reading-time mb-0"><?php echo reading_time(); ?></p>
					<?php /*?><div class="social-share">
                        <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_n5a9"]') ?>
                    </div><?php */?>
					<a href="<?php the_permalink() ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-blue-right.svg" alt="" />
					</a>    
				</div>
			</div>
		</div>
        <?php } $k++; if($k==5){ $k=0;} endwhile; ?>
        <?php
    endif;
 
    wp_die();
}

// change blog post url
function filter_post_link($permalink, $post) {
    if ($post->post_type != 'post')
        return $permalink;
    return 'blog'.$permalink;
}
add_filter('pre_post_link', 'filter_post_link', 10, 2);


add_action( 'generate_rewrite_rules', 'add_blog_rewrites' );
function add_blog_rewrites( $wp_rewrite ) {
    $wp_rewrite->rules = array(
        'blog/([^/]+)/?$' => 'index.php?name=$matches[1]',
        'blog/[^/]+/attachment/([^/]+)/?$' => 'index.php?attachment=$matches[1]',
        'blog/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?attachment=$matches[1]&tb=1',
        'blog/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'blog/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'blog/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?attachment=$matches[1]&cpage=$matches[2]',
        'blog/([^/]+)/trackback/?$' => 'index.php?name=$matches[1]&tb=1',
        'blog/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?name=$matches[1]&feed=$matches[2]',
        'blog/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?name=$matches[1]&feed=$matches[2]',
        'blog/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?name=$matches[1]&paged=$matches[2]',
        'blog/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?name=$matches[1]&cpage=$matches[2]',
        'blog/([^/]+)(/[0-9]+)?/?$' => 'index.php?name=$matches[1]&page=$matches[2]',
        'blog/[^/]+/([^/]+)/?$' => 'index.php?attachment=$matches[1]',
        'blog/[^/]+/([^/]+)/trackback/?$' => 'index.php?attachment=$matches[1]&tb=1',
        'blog/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'blog/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'blog/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?attachment=$matches[1]&cpage=$matches[2]',
    ) + $wp_rewrite->rules;
}

/* Change Admin Logo */
function custom_loginlogo() {
echo '<style type="text/css">
body.login { background: #fff !important; }
h1 a {background-image: url('.get_bloginfo('template_directory').'/assets/img/survey-sensum-logo.svg) !important; width: 195px!important; height: 70px!important; background-size: 195px!important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');

remove_action('wp_head','rest_output_link_wp_head');

add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    $url = site_url();
    return $url;
}

/* Custom Post Types Serach */
add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function tgm_io_cpt_search( $query ) {
	
    if ( $query->is_search ) {
	$query->set( 'post_type', array( 'post') );
    }
    
    return $query;
    
}
/**
 * Restrict native search widgets to the 'post' post type
 */
add_filter( 'widget_title', function( $title, $instance, $id_base )
{
    // Target the search base
    if( 'search' === $id_base )
        add_filter( 'get_search_form', 'wpse_post_type_restriction' );
    return $title;
}, 10, 3 );

function wpse_post_type_restriction( $html )
{
    // Only run once
    remove_filter( current_filter(), __FUNCTION__ );

    // Inject hidden post_type value
    return str_replace( 
        '</form>', 
        '<input type="hidden" name="post_type" value="post" /></form>',
        $html 
    );
} 

//Search by  post title 
function heycodetech_search_by_title_only( $search, &$wp_query )
{
    global $wpdb;
    if ( empty( $search ) )
        return $search; // skip processing - no search term in query
    $q = $wp_query->query_vars;//query var
    $n = ! empty( $q['exact'] ) ? '' : '%';
    $search =
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter( 'posts_search', 'heycodetech_search_by_title_only', 500, 2 );

/*======================================
    Popup Container
======================================*/
add_filter( 'gform_confirmation_anchor', '__return_false' );
add_filter( 'gform_confirmation_9', 'custom_confirmation_message', 20, 8 );
function custom_confirmation_message( $confirmation, $form, $entry, $ajax ) {
    $confirmation = '' .
                    "<script>jQuery(document).ready(function(){
     jQuery('.popup-container').addClass('valid');
     jQuery('.popup-container').find('.title').text('Thanks for Subscribing');
     jQuery('.popup-container').find('.sub-title').text('Open your email to unlock the achievements you have received.');
});
</script>";
 
    return $confirmation;
}

function analytics_rewrite_add_var( $vars ) {
    $vars[] = 'analytic';
    return $vars;
}
add_filter( 'query_vars', 'analytics_rewrite_add_var' );
// add_filter( 'rank_math/opengraph/twitter_card', '__return_false' );

// remove_action( 'wpseo_head', array( $GLOBALS['wpseo_og'], 'opengraph' ), 30 );
// remove_action( 'wpseo_head', array( WPSEO_Twitter , 'get_instance' ) , 40 );
// add_filter( 'wpseo_locale', '__return_false' ); // for some reason does not remove, it sets to "en_US"
// add_filter( 'wpseo_opengraph_url' , '__return_false' );
// add_filter( 'wpseo_opengraph_desc', '__return_false' );
// add_filter( 'wpseo_opengraph_title', '__return_false' );
// add_filter( 'wpseo_opengraph_type', '__return_false' );
// add_filter( 'wpseo_opengraph_site_name', '__return_false' );
// add_filter( 'wpseo_opengraph_image' , '__return_false' );
// add_action( 'wpseo_add_opengraph_images', '__return_false' );

// add_filter( 'rank_math/opengraph/twitter_title', '__return_false' );
// add_filter( 'rank_math/opengraph/twitter_description', '__return_false' );
// add_filter( 'rank_math/opengraph/twitter_image', '__return_false' );
// add_filter( 'wpseo_twitter_title' , '__return_false' );
// add_filter( 'wpseo_twitter_description' , '__return_false' );
// add_filter( 'wpseo_twitter_image' , '__return_false' );



// function template_chooser($template)   
// {    
//   global $wp_query;   
//   $post_type = get_query_var('post_type');   
//   if( $wp_query->is_search && $post_type == 'ebook' )   
//   {
//     //  redirect to archive-ebook.php
//     return locate_template('archive-ebook.php');  
//   }   
//   return $template;   
// }
// add_filter('template_include', 'template_chooser'); 