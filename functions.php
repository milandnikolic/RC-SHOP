<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: rcshop.com | @rcshop
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('rcshop', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function rcshop_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function rcshop_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('rcshopscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('rcshopscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function rcshop_conditional_scripts()
{
    if ( is_front_page() ) {
        wp_register_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true); // Conditional script(s)
        wp_enqueue_script('slick'); // Enqueue it!
    }
    
    if (is_front_page() ) {
        wp_register_script('sliderinit', get_template_directory_uri() . '/js/sliderinit.js', array( 'slick' ), '1.0.0', true); // initial slider 
        wp_enqueue_script('sliderinit'); // Enqueue it!
    }

}

// Load HTML5 Blank styles
function rcshop_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('rcshop', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('rcshop'); // Enqueue it!

    wp_register_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '1.0', 'all');
    wp_enqueue_style('fontawesome'); // Enqueue it!    
}

// Load HTML5 Blank conditional styles
function rcshop_conditional_styles()
{
    if ( is_front_page() ) {
        wp_register_style('slicks', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0', 'all'); // slick styles
        wp_enqueue_style('slicks'); // Enqueue it!
    }
    
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'rcshop'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'rcshop'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'rcshop') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Blog sidebar', 'rcshop'),
        'description' => __('Blog sidebar', 'rcshop'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Shop sidebar', 'rcshop'),
        'description' => __('Shop sidebar', 'rcshop'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'rcshop') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function rcshopgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function rcshopcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php //if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'rcshop_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'rcshop_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'rcshop_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('wp_enqueue_scripts', 'rcshop_conditional_styles');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'rcshopgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
/*function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'rcshop'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'rcshop'),
            'add_new' => __('Add New', 'rcshop'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'rcshop'),
            'edit' => __('Edit', 'rcshop'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'rcshop'),
            'new_item' => __('New HTML5 Blank Custom Post', 'rcshop'),
            'view' => __('View HTML5 Blank Custom Post', 'rcshop'),
            'view_item' => __('View HTML5 Blank Custom Post', 'rcshop'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'rcshop'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'rcshop'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'rcshop')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}*/

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

//shortcode za call centar banner
function my_callcenter_shortcode( $attr ) {
    ob_start();
    get_template_part( 'templates/call-banner' );
    return ob_get_clean();
}
add_shortcode( 'call', 'my_callcenter_shortcode' );


/*------------------------------------*\
    Add acf options page
\*------------------------------------*/
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme options',
        'menu_title'    => 'Theme options',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'update_core',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'WooCommerce Settings',
        'menu_title'    => 'WooCommerce Settings',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Social networks',
        'menu_title'    => 'Social networks',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Contact data',
        'menu_title'    => 'Contact data',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Blog Settings',
        'menu_title'    => 'Blog Settings',
        'parent_slug'   => 'theme-general-settings',
    ));

}


/*------------------------------------*\
     Class ACTIVE in navigation
\*------------------------------------*/
        
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


/*------------------------------------*\
    ACF ICONS IN SIDEBAR MENU
\*------------------------------------*/
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
    
    // loop
    foreach( $items as &$item ) {
        
        // vars
        $icon = get_field('menu_icon', $item);
        
        
        // append icon
        if( $icon ) {
            
            $item->title = '<img class="menu-icon" src="'.$icon['url'].'" />'.$item->title;
            
        }
        
    }
    
    
    // return
    return $items;
    
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
    $free = array();
    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }
    return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );




/*------------------------------------*\
              Breadcrumbs
\*------------------------------------*/    
    
    function the_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home() && !in_category( 'Uncategorized' )) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Naslovna ';
        echo '</a></li><li class="separator"> > </li>';
        if (is_category() || is_single() ) {
                echo '<li>';
                the_category(' </li><li class="separator"> > </li><li> ');
                if (is_single()) {
                    echo '</li><li class="separator"> > </li><li>';
                    the_title();
                    echo '</li>';
                }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            }else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}



/*------------------------------------*\
        Limit tags on archive
\*------------------------------------*/  
add_filter('term_links-post_tag','limit_to_one_tags');
function limit_to_one_tags($terms) {
    if ( /*is_home() || is_category() || is_tag()*/ !is_single() ){
        return array_slice($terms,0,1,true);
    } else {
        return array_slice($terms,0,5,true);
    }
}


/*------------------------------------*\
    Disable website in comments
\*------------------------------------*/  
function crunchify_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');


/*------------------------------------*\
    WOOCOMMERCE SUPPORT DECLARE
\*------------------------------------*/  
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );



/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}
/*------------------------------------*\
    SINGLE PRODUCT CUSTOM FIELDS
\*------------------------------------*/ 
add_action( 'woocommerce_single_product_summary', 'rcshop_single_product_custom_sale', 5 );
function rcshop_single_product_custom_sale() {
    global $product;
    $onsale = $product->get_sale_price();
    if($onsale){
    ?>

    <span class="onsale">
        <?php _e('Šok cena', 'rcshop'); ?>
    </span>

    <?php 
    }
}


add_action( 'woocommerce_single_product_summary', 'rcshop_single_product_custom_banca', 15 );
function rcshop_single_product_custom_banca() {
    ?>

    <div class="banca-ads text-center">
        <p><?php _e('Kupovina na rate. Do 12 mesečnih rata!', 'rcshop'); ?></p>
    </div>

    <?php 
}


add_action( 'woocommerce_single_product_summary', 'rcshop_single_product_custom_fields', 50 );
function rcshop_single_product_custom_fields() {
   $trustmark = get_field('trustmark_image', 'option');
   if( !empty($trustmark) ): ?>
    <div class="product-share-icons text-center">   
        <p><?php _e('PODELI SA PRIJATELJIMA', 'rcshop'); ?></p>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" title="Share this post on Facebook" target="_blank" class="fb"><i class="fab fa-facebook-f"></i></a>
        <a href="http://twitter.com/home?status=Reading: <?php the_permalink(); ?>" title="Share this post on Twitter!" target="_blank" class="tw"><i class="fab fa-twitter"></i></a>
        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>" title="Share this post on LinkedIn" target="_blank" class="ld"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="gp"><i class="fab fa-google-plus-g"></i></a>   
    </div>
    <div class="trustmark-wrap text-center">
        <img src="<?php echo $trustmark['url']; ?>" alt="<?php echo $trustmark['alt']; ?>" />
     </div>
    <?php endif;
}

/******  move SKU up  ******/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 11 );


/******  CUSTOM LABELS FOR STOCK MESSAGES  ******/
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Na stanju!', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Pozovite da proverite stanje!', 'woocommerce');
    }
    return $availability;
}


/******* ADDITIONAL MESSAGE TO OUT OF STOCK LABEL ********/
add_action( 'woocommerce_single_product_summary', 'rcshop_single_product_custom_outofstock_label', 35 );
function rcshop_single_product_custom_outofstock_label() {
	global $product;
	if( $product->get_stock_quantity() == 0 ){
    ?>

    <div class="text-center">
        <span class="no-stock"><?php _e('DOSTUPNO ZA PORUČIVANJE!', 'rcshop'); ?></span>
    </div>

    <?php 
	}
}

/******** STOCK QUANTITY ON PRODUCT PAGE *********/
add_action('woocommerce_single_product_summary','rcshop_show_stock_shop', 10);
 
function rcshop_show_stock_shop() {
	global $product;
	if ( $product->get_stock_quantity() ) { // if manage stock is enabled 
		if (  number_format( $product->get_stock_quantity(),0,'','' ) < 3 && number_format( $product->get_stock_quantity(),0,'','' ) > 0 ) { // if stock is low
			echo '<div class="remaining">Još samo: ' . number_format($product->get_stock_quantity(),0,'','') . ' kom </div>';
		} elseif ( number_format( $product->get_stock_quantity(),0,'','' ) >= 3 ) {
			echo '<div class="remaining"> Zaliha: ' . number_format($product->get_stock_quantity(),0,'','') . ' kom </div>'; 
		}
	}
}

/******** ADD CUSTOM TAB WITH STOCKS FOR ADMINS *********/
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	
	// Adds the new tab
	if (is_user_logged_in() && current_user_can('administrator') ) {
		$tabs['test_tab'] = array(
			'title' 	=> __( 'Magacini i zalihe', 'woocommerce' ),
			'priority' 	=> 50,
			'callback' 	=> 'woo_new_product_tab_content'
		);

		
	}
	return $tabs;
}
function woo_new_product_tab_content() {
	echo '<h2>ZALIHE PO MAGACINIMA</h2>';
	// The new tab content
	$magacin = get_field('_stock1');
	$magacin2 = get_field('_stock2');
	$magacin3 = get_field('_stock3');
	$magacin4 = get_field('_stock4');
	echo '<h3>Lokalni magacin: ' . $magacin . '</h3>';
	echo '<h3>Computerland: ' . $magacin2 . '</h3>';
	echo '<h3>Josipovic: ' . $magacin3 . '</h3>';
	echo '<h3>Kimtec: ' . $magacin4 . '</h3>';
}



/* дин to din*/
 add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {
$currencies['ABC'] = __( 'Srpski dinar', 'RSD' );
return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'ABC': $currency_symbol = 'din.'; break;
}
return $currency_symbol;
}



// Increment input fields for quantity
function kia_add_script_to_footer(){
    if( ! is_admin() && is_product() || ! is_admin() && is_cart() ) { ?>
    <script>
    jQuery(document).ready(function($){
    $(".quantity .far").on("click", function() {

          var $button = $(this);
          var oldValue = $button.parent().find("input").val();

          if ($button.hasClass('fa-plus-square') ) {
              var newVal = parseFloat(oldValue) + 1;
            } else {
           // Don't allow decrementing below zero
            if (oldValue > 1) {
              var newVal = parseFloat(oldValue) - 1;
            } else {
              newVal = 1;
            }
          }

          $button.parent().find("input").val(newVal);

        });
});
</script>
<?php }
}
add_action( 'wp_footer', 'kia_add_script_to_footer' );


add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
    return '';
}

add_filter('woocommerce_product_additional_information_heading', 'isa_product_additional_information_heading');
function isa_product_additional_information_heading() {
    return '';
}


add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
/*------------------------------------*\
   REORDER FIELDS ON CHECKOUT
\*------------------------------------*/ 
 
add_filter( 'woocommerce_checkout_fields', 'runners_move_checkout_fields' );
  
function runners_move_checkout_fields( $fields ) {
 
  // Billing: move these around in the order you'd like
   
  $fields2['billing']['billing_first_name'] = $fields['billing']['billing_first_name'];
  $fields2['billing']['billing_last_name']  = $fields['billing']['billing_last_name'];
    
  $fields2['billing']['billing_phone']      = $fields['billing']['billing_phone'];  
  $fields2['billing']['billing_email']      = $fields['billing']['billing_email']; 
    
  $fields2['billing']['billing_address_1']  = $fields['billing']['billing_address_1']; 
  $fields2['billing']['billing_city']       = $fields['billing']['billing_city'];
        
  $fields2['billing']['billing_postcode']   = $fields['billing']['billing_postcode'];
  $fields2['billing']['billing_country']    = $fields['billing']['billing_country'];
  
  $fields2['billing']['billing_company']    = $fields['billing']['billing_company'];
 
    $fields2['billing']['billing_first_name'] = array(
        'required'  => true,
        'class'     => array('form-row-first'),
        'clear'     => false,
        'placeholder' => __('Vaše Ime', 'woocommerce') 
    );  

    $fields2['billing']['billing_last_name'] = array(
        'required'  => true,
        'class'     => array('form-row-last'),
        'clear'     => true,
        'placeholder' => __('Vaše Prezime', 'woocommerce') 
    );  
    
    $fields2['billing']['billing_address_1'] = array(
        'required'  => true,
        'class'     => array('form-row-first','update_totals_on_change' ),
        'clear'     => true,
        'placeholder' => __('Adresa (Ulica i broj)', 'woocommerce') 
    );  
    
    $fields2['billing']['billing_phone'] = array(
        'placeholder' => __('Broj telefona', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-first'),
        'clear'     => false
    );  
    
     $fields2['billing']['billing_email'] = array(
        'placeholder' => __('Email', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-last'),
        'clear'     => true
    ); 

    $fields2['billing']['billing_postcode'] = array(
        'placeholder' => __('Poštanski broj', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-first'),
        'clear'     => true
    ); 
    $fields2['billing']['billing_city'] = array(
        'placeholder' => __('Grad', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-last'),
        'clear'     => true,

    ); 
    $fields2['billing']['billing_company'] = array(
        'placeholder' => __('Ime firme (Opcionalno)', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-first'),
        'clear'     => true
    );

    $fields2['billing']['billing_country'] = array(
        'placeholder' => __('Država', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-last','update_totals_on_change'),
        'clear'     => false,
        'type'      => 'select',
        'options'   => array(
        'country'   => __('Country', 'woocommerce' ),
        'RS'        => __('Srbija', 'woocommerce' ),
        'MK'        => __('Makedonija', 'woocommerce' ),
        'ME'        => __('Crna Gora', 'woocommerce' ),
        'BA'        => __('Bosna i Hercegovina', 'woocommerce' ),
        'AL'        => __('Albanija', 'woocommerce' ),
         )
    );
      
  $checkout_fields = array_merge( $fields, $fields2);
  return $checkout_fields;
}


function storefront_child_remove_unwanted_form_fields($fields) {
    unset( $fields ['state'] );
    unset( $fields ['address_2'] );
    return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'storefront_child_remove_unwanted_form_fields' );

/*------------------------------------*\
  PAYMENT METHODS REGARDING COUNTRIES
\*------------------------------------*/
function payment_gateway_disable_country( $available_gateways ) {
	global $woocommerce;
	if ( is_admin() ) return;
	if ( isset( $available_gateways['cod'] ) && $woocommerce->customer->get_billing_country() <> 'RS' ) {
		unset( $available_gateways['cod'] );
	} elseif (isset( $available_gateways['cheque'] ) && $woocommerce->customer->get_billing_country() <> 'RS'){
		unset( $available_gateways['cheque'] );
	} elseif (isset( $available_gateways['wc_payment_asseco'] ) && $woocommerce->customer->get_billing_country() <> 'RS'){
        unset( $available_gateways['wc_payment_asseco'] );
    } elseif (isset( $available_gateways['bacs'] ) && $woocommerce->customer->get_billing_country() <> 'RS'){
        unset( $available_gateways['bacs'] );
    }/* else if ( isset( $available_gateways['paypal'] ) && $woocommerce->customer->get_billing_country() == 'US' ) {
	unset( $available_gateways['paypal'] );*/
	//}
	return $available_gateways;
}
 
add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_country' );


/*------------------------------------*\
  SPECIAL MESSAGES REGARDING COUNTRIES
\*------------------------------------*/
// Add the message notification and place it over the billing section
// The "display:none" hides it by default

add_action( 'woocommerce_before_checkout_billing_form', 'rcshop_echo_notice_shipping' );
 
function rcshop_echo_notice_shipping() {
	
echo '<div class="shipping-notice woocommerce-info" style="display:none">Molimo Vas da nas kontaktirate pre poručivanja, kako bismo se dogovorili oko načina isporuke! Tel: +381 64 424 22 83  Email: office@rcshop.rs</div>';
}


add_action( 'woocommerce_before_checkout_billing_form', 'rcshop_mk_notice_shipping' );
function rcshop_mk_notice_shipping() {
	
echo '<div class="shipping-notice-mk woocommerce-info" style="display:none">Ве молиме контактирајте со нас пред да нарачате, за да можеме да се согласиме со начинот на испорака! Teл: +381 64 424 22 83  Email: office@rcshop.rs</div>';
}
 
// Part 2
// Show or hide message based on billing country
// The "display:none" hides it by default
 
add_action( 'woocommerce_after_checkout_form', 'rcshop_show_notice_shipping' );
 
function rcshop_show_notice_shipping(){
     
    ?>
 
    <script>
        jQuery(document).ready(function($){
 
            // Set the country code (That will display the message)
            var countryCode = 'ME';
			var countryCode2 = 'BA';
			var countryCode3 = 'MK';
 
            jQuery('select#billing_country').change(function(){
 
                selectedCountry = jQuery('select#billing_country').val();
                 
                if( selectedCountry == countryCode || selectedCountry == countryCode2 ){
                    jQuery('.shipping-notice').show();
					jQuery('.shipping-notice-mk').hide();
                } else if ( selectedCountry == countryCode3 ){
					jQuery('.shipping-notice-mk').show();
					jQuery('.shipping-notice').hide();
				}
                else {
                    jQuery('.shipping-notice').hide();
					jQuery('.shipping-notice-mk').hide();
                }
            });
 
        });
    </script>
 
    <?php
     
}
/*------------------------------------*\
  SINGLE PRODUCT LIGHTBOX
\*------------------------------------*/ 
add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_setup() {
//add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}


/*------------------------------------*\
 LOAD POSTS ON SCROLL
\*------------------------------------*/ 
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '7',
        'paged' => $paged,
        'orderby'        => 'date',
        'order'          =>  'DESC',
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
         <div class="row">
        <?php while ( $my_posts->have_posts() ) : $my_posts->the_post() ?>
                            <div class="col6">
                                <div class="post-item">
                                    <!-- post thumbnail -->
                                    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <div class="img-wrap">
                                                <?php the_post_thumbnail(array( 400, 400), ['class' => 'img-fit']); ?>
                                                <figcaption>
                                                    <div><i class="fas fa-link"></i></div>
                                                 </figcaption>
                                            </div>                  
                                        </a>
                                    <?php endif; ?>
                                    <!-- /post thumbnail -->

                                    <div class="post-body">
                                        <div class="flex">
                                            <span class="date"><?php the_time('F j, Y'); ?></span>
                                            <div class="tags-wrapper"><?php the_tags( __( '', 'rcshop' ), ' ');  ?></div>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <h2><?php the_title(); ?></h2>
                                        </a>

                                    </div>
                                </div><!--  /post-item -->
                            </div><!--  /col6 -->
        <?php endwhile ?>
         </div><!--  /row -->
        <?php
    endif;

    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');



/**
 * @snippet       Add Select Field to "My Account" Register Form | WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=72508
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.0.5
 */
 
// -------------------
// 1. Show field @ My Account Registration
 
add_action( 'woocommerce_register_form', 'bbloomer_extra_register_select_field' );
 
function bbloomer_extra_register_select_field() {
   
    ?>
 
<p class="form-row form-row-wide">
<label for="find_where"><?php _e( 'Prijavite se za NEWSLETTER', 'woocommerce' ); ?>  <span class="required">*</span></label>
<input type="checkbox" name="find_where" id="find_where" checked />
</p>
 
<?php
   
}
 
// -------------------
// 2. Save field on Customer Created action
 
add_action( 'woocommerce_created_customer', 'bbloomer_save_extra_register_select_field' );
  
function bbloomer_save_extra_register_select_field( $customer_id ) {
if ( isset( $_POST['find_where'] ) ) {
        update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}
 
// -------------------
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)
  
add_action( 'show_user_profile', 'bbloomer_show_extra_register_select_field', 30 );
add_action( 'edit_user_profile', 'bbloomer_show_extra_register_select_field', 30 ); 
add_action( 'woocommerce_edit_account_form', 'bbloomer_show_extra_register_select_field', 30 );
  
function bbloomer_show_extra_register_select_field($user){ 
   
  if (empty ($user) ) {
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
  }
   
?>    
       
<p class="form-row form-row-wide">
<label for=""><?php _e( 'Prijavite se za NEWSLETTER', 'woocommerce' ); ?>  <span class="required">*</span></label>
<input type="checkbox" name="find_where" id="find_where" checked />
</p>
 
<?php
 
}
 
// -------------------
// 4. Save User Field When Changed From the Admin/Front End Forms
  
add_action( 'personal_options_update', 'bbloomer_save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'bbloomer_save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'bbloomer_save_extra_register_select_field_admin' );
  
function bbloomer_save_extra_register_select_field_admin( $customer_id ){        
update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}




/*------------------------------------*\
 REMOVE DOWNLOADS
\*------------------------------------*/ 
function custom_my_account_menu_items( $items ) {
    unset($items['downloads']);
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );

/*add_action('woocommerce_cart_collaterals', 'myprefix_cart_extra_info');
function myprefix_cart_extra_info() {
    global $woocommerce;
    echo '<div class="cart-extra-info">';
    echo '<p class="total-weight">' . __('Total Weight:', 'woocommerce');
    echo ' ' . $woocommerce->cart->cart_contents_weight . ' ' . get_option('woocommerce_weight_unit');
    echo '</p>';
    echo '</div>';
}*/

/*
add_action( 'woocommerce_flat_rate_shipping_add_rate', 'add_another_custom_flat_rate', 10, 2 );

function add_another_custom_flat_rate( $method, $rate ) {
    $new_rate          = $rate;
    $new_rate['id']    .= ':' . 'over_100'; // Append a custom ID
    $new_rate['label'] = 'Porudžbine preko 100kg'; // Rename to 'Rushed Shipping'
    $new_rate['cost']  = 2; // Add $2 to the cost
    
    // Add it to WC
    $method->add_rate( $new_rate );
}*/
/*------------------------------------*\
            SHIPPING LOGIC
\*------------------------------------*/ 
/*
function wc_ninja_find_all_available_shipping_rates( $rates, $package ) {
    foreach ( $rates as $id => $rate ) {
        echo $id . ' ';
    }

    return $rates;
}
add_filter( 'woocommerce_package_rates', 'wc_ninja_find_all_available_shipping_rates', 10, 2 );

function wc_ninja_change_flat_rates_cost( $rates, $package ) {
    // Make sure flat rate is available
    if ( isset( $rates['flat_rate:12'] ) ) {
        // Set the cost to $100
       // $rates['flat_rate:12']->cost = 2506 - ($woocommerce->cart->cart_contents_weight - 100 ) * 24;
    }

    return $rates;
}

add_filter( 'woocommerce_package_rates', 'wc_ninja_change_flat_rates_cost', 10, 2 );*/



add_filter( 'woocommerce_package_rates', 'bbloomer_woocommerce_tiered_shipping', 10, 2 );
   
function bbloomer_woocommerce_tiered_shipping( $rates, $package ) {
    global $woocommerce;
    if ( $woocommerce->cart->cart_contents_weight < 0.5 ) {
      
        if ( isset( $rates['flat_rate:1'] ) ) unset( $rates['flat_rate:2'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 1 && $woocommerce->cart->cart_contents_weight >= 0.5) {
       
        if ( isset( $rates['flat_rate:2'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 2 && $woocommerce->cart->cart_contents_weight >= 1 ) {
       
        if ( isset( $rates['flat_rate:3'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:2'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ($woocommerce->cart->cart_contents_weight < 5 && $woocommerce->cart->cart_contents_weight >= 2 ) {
       
        if ( isset( $rates['flat_rate:4'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:2'], $rates['flat_rate:5'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    }  elseif ($woocommerce->cart->cart_contents_weight < 10 && $woocommerce->cart->cart_contents_weight >= 5 ) {
       
        if ( isset( $rates['flat_rate:5'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:2'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 20 && $woocommerce->cart->cart_contents_weight >= 10 ) {
       
        if ( isset( $rates['flat_rate:6'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:2'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 30 && $woocommerce->cart->cart_contents_weight >= 20 ) {
       
        if ( isset( $rates['flat_rate:7'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:2'], $rates['flat_rate:6'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 50 && $woocommerce->cart->cart_contents_weight >= 30 ) {
       
        if ( isset( $rates['flat_rate:8'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:2'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 70 && $woocommerce->cart->cart_contents_weight >= 50 ) {
       
        if ( isset( $rates['flat_rate:9'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:2'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:10'], $rates['flat_rate:12'] );
       
    } elseif ( $woocommerce->cart->cart_contents_weight < 100 && $woocommerce->cart->cart_contents_weight >= 70 ) {
       
        if ( isset( $rates['flat_rate:10'] ) ) unset(  $rates['flat_rate:1'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:2'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:12'] );
       
    } else {
           if ( isset( $rates['flat_rate:12'] ) ) unset( $rates['flat_rate:1'], $rates['flat_rate:2'], $rates['flat_rate:3'], $rates['flat_rate:4'], $rates['flat_rate:5'], $rates['flat_rate:6'], $rates['flat_rate:7'], $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'] ); 
      // $rates = ($woocommerce->cart->cart_contents_weight - 100 ) * 24 + 2506;
        //   $rates['flat_rate:12']->cost = $rates['flat_rate:12']->cost + ($woocommerce->cart->cart_contents_weight - 100 ) * 24;
    }
   
  return $rates;
   
}


/*
function wc_ninja_change_flat_rates_cost( $rates, $package ) {
    // Make sure flat rate is available
    if ( isset( $rates['flat_rate:12'] ) ) {
        // Number of products in the cart
        $cart_number = $woocommerce->cart->cart_contents_weight;
        
        // Check if there are more than 10 products in the cart
        if ( $cart_number > 100 ) {
            $rates['flat_rate:12']->cost = $rates['flat_rate:12']->cost + ($cart_number - 100 ) * 24;
        }
    }

    return $rates;
}

add_filter( 'woocommerce_package_rates', 'wc_ninja_change_flat_rates_cost', 10, 2 );*/




//add_filter( 'woocommerce_package_rates', 'wc_ninja_find_all_available_shipping_rates', 10, 2 );


// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );




//Dequeue unnecessary scripts on non-woo pages
add_action( 'wp_enqueue_scripts', 'exclude_woocommerce_styles', 99 );

function exclude_woocommerce_styles() {
//remove generator meta tag
remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

//check woo exists
if ( function_exists( 'is_woocommerce' ) ) {
//dequeue scripts and styles
  if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
    wp_dequeue_style( 'woocommerce_frontend_styles' );
    wp_dequeue_style( 'woocommerce_fancybox_styles' );
    wp_dequeue_style( 'woocommerce_chosen_styles' );
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'wc_price_slider' );
    wp_dequeue_script( 'wc-single-product' );
    wp_dequeue_script( 'wc-add-to-cart' );
    wp_dequeue_script( 'wc-cart-fragments' );
    wp_dequeue_script( 'wc-checkout' );
    wp_dequeue_script( 'wc-add-to-cart-variation' );
    wp_dequeue_script( 'wc-single-product' );
    wp_dequeue_script( 'wc-cart' );
    wp_dequeue_script( 'wc-chosen' );
    wp_dequeue_script( 'woocommerce' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
    wp_dequeue_script( 'jquery-blockui' );
    wp_dequeue_script( 'jquery-placeholder' );
    wp_dequeue_script( 'fancybox' );
    wp_dequeue_script( 'jqueryui' );
    }
  }
}


//Remove query strings from static resources
function ewp_remove_script_version( $src ){
    return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'ewp_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'ewp_remove_script_version', 15, 1 );

//Disable emoji
add_action( 'init', 'disable_emoji' );
function disable_emoji() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
   // new filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_tiny' );
   //new filter to remove dns prefetch
  add_filter( 'emoji_svg_url', '__return_false' );
}

function disable_tiny( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}



/*------------------------------------*\
  LOAD cf7 SCRIPTS ONLY IN CONTACT PAGE
\*------------------------------------*/
function rjs_lwp_contactform_css_js() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7') ) {
        wp_enqueue_script('contact-form-7');
         wp_enqueue_style('contact-form-7');

    }else{
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_style( 'contact-form-7' );
    }
}
add_action( 'wp_enqueue_scripts', 'rjs_lwp_contactform_css_js');



/*
START: Vlada added custom inventory fields & handling 16.06.2017. (_sku4 & _stock4 - added 20.02.2018)
*/
// Display Custom Inventory Fields
add_action( 'woocommerce_product_options_inventory_product_data', 'woo_add_custom_inventory_fields' );
function woo_add_custom_inventory_fields() {

	global $woocommerce, $post;

	$thepostid = $post->ID;

	if ( wc_product_sku_enabled() ) {
		echo '
		<div class="options_group">
			<h2><strong>*** Dodatna polja za SKU ***</strong></h2>';
		// _sku2
		woocommerce_wp_text_input( array(
			'id'          => '_sku2',
			'value'       => esc_attr( get_post_meta( $thepostid, '_sku2', true ) ),
			'label'       => '<abbr title="' . __( 'Stock Keeping Unit in Storage #2', 'woocommerce' ) . '">' . __( 'SKU #2<br />[computerland.rs]', 'woocommerce' ) . '</abbr>',
			'desc_tip'    => true,
			'description' => __( 'SKU #2 [computerland.rs] refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'woocommerce' ),
		) );
		// _sku3
		woocommerce_wp_text_input( array(
			'id'          => '_sku3',
			'value'       => esc_attr( get_post_meta( $thepostid, '_sku3', true ) ),
			'label'       => '<abbr title="' . __( 'Stock Keeping Unit in Storage #3', 'woocommerce' ) . '">' . __( 'SKU #3<br />[josipovic.rs]', 'woocommerce' ) . '</abbr>',
			'desc_tip'    => true,
			'description' => __( 'SKU #3 [josipovic.rs] refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'woocommerce' ),
		) );
		// _sku4
		woocommerce_wp_text_input( array(
			'id'          => '_sku4',
			'value'       => esc_attr( get_post_meta( $thepostid, '_sku4', true ) ),
			'label'       => '<abbr title="' . __( 'Stock Keeping Unit in Storage #4', 'woocommerce' ) . '">' . __( 'SKU #4<br />[kimtec.rs]', 'woocommerce' ) . '</abbr>',
			'desc_tip'    => true,
			'description' => __( 'SKU #4 [kimtec.rs] refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'woocommerce' ),
		) );
		echo '
		</div>';
	}

	if ( 'yes' === get_option( 'woocommerce_manage_stock' ) ) {
		echo '
		<div class="options_group stock_fields show_if_simple show_if_variable">
			<h2><strong>*** Dodatna polja za STOCK ***</strong></h2>';
		// Storage #1
		woocommerce_wp_text_input( array(
			'id'                => '_stock1',
			'value'             => esc_attr( get_post_meta( $thepostid, '_stock1', true ) ),
			'label'             => __( 'Stock quantity #1<br />[lokalni magacin]', 'woocommerce' ),
			'desc_tip'          => true,
			'description'       => __( 'Stock quantity in storage #1 [lokalni magacin]. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'woocommerce' ),
			'type'              => 'number',
			'custom_attributes' => array(
		//		'readonly'	=> 'readonly',
				'step'          => 'any',
			),
			'data_type'         => 'stock',
		) );

		// Storage #2
		woocommerce_wp_text_input( array(
			'id'                => '_stock2',
			'value'             => esc_attr( get_post_meta( $thepostid, '_stock2', true ) ),
			'label'             => __( 'Stock quantity #2<br />[computerland.rs]', 'woocommerce' ),
			'desc_tip'          => true,
			'description'       => __( 'Stock quantity in storage #2 [computerland.rs]. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'woocommerce' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'readonly'	=> 'readonly',
				'step'          => 'any',
			),
			'data_type'         => 'stock',
		) );

		// Storage #3
		woocommerce_wp_text_input( array(
			'id'                => '_stock3',
			'value'             => esc_attr( get_post_meta( $thepostid, '_stock3', true ) ),
			'label'             => __( 'Stock quantity #3<br />[josipovic.rs]', 'woocommerce' ),
			'desc_tip'          => true,
			'description'       => __( 'Stock quantity in storage #3 [josipovic.rs]. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'woocommerce' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'readonly'	=> 'readonly',
				'step'          => 'any',
			),
			'data_type'         => 'stock',
		) );

		// Storage #4
		woocommerce_wp_text_input( array(
			'id'                => '_stock4',
			'value'             => esc_attr( get_post_meta( $thepostid, '_stock4', true ) ),
			'label'             => __( 'Stock quantity #4<br />[kimtec.rs]', 'woocommerce' ),
			'desc_tip'          => true,
			'description'       => __( 'Stock quantity in storage #4 [kimtec.rs]. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'woocommerce' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'readonly'	=> 'readonly',
				'step'          => 'any',
			),
			'data_type'         => 'stock',
		) );
		echo '
		</div>';
	}
}

// Save Custom Inventory Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_inventory_fields_save' );
function woo_add_custom_inventory_fields_save( $post_id ){
	
	$_sku2 = $_POST['_sku2'];
	add_post_meta($post_id, '_sku2', 0, true); // Ensure key exists
	update_post_meta($post_id, '_sku2', esc_attr( $_sku2 ) );
	
	$_sku3 = $_POST['_sku3'];
	add_post_meta($post_id, '_sku3', 0, true); // Ensure key exists
	update_post_meta($post_id, '_sku3', esc_attr( $_sku3 ) );
	
	$_sku4 = $_POST['_sku4'];
	add_post_meta($post_id, '_sku4', 0, true); // Ensure key exists
	update_post_meta($post_id, '_sku4', esc_attr( $_sku4 ) );

	// new product
	if( ! metadata_exists( 'post', $post_id, '_stock1' ) ){
		$_POST['_stock1'] = !empty($_POST['_stock1']) ? $_POST['_stock1'] : $_POST['_stock'];
		$_POST['_stock2'] = 0;
		$_POST['_stock3'] = 0;
		$_POST['_stock4'] = 0;
	}
	
	$_stock1 = $_POST['_stock1'];
	add_post_meta($post_id, '_stock1', 0, true); // Ensure key exists
	update_post_meta($post_id, '_stock1', esc_attr( $_stock1 ) );
	
	$_stock2 = $_POST['_stock2'];
	add_post_meta($post_id, '_stock2', 0, true); // Ensure key exists
	update_post_meta($post_id, '_stock2', esc_attr( $_stock2 ) );
	
	$_stock3 = $_POST['_stock3'];
	add_post_meta($post_id, '_stock3', 0, true); // Ensure key exists
	update_post_meta($post_id, '_stock3', esc_attr( $_stock3 ) );
	
	$_stock4 = $_POST['_stock4'];
	add_post_meta($post_id, '_stock4', 0, true); // Ensure key exists
	update_post_meta($post_id, '_stock4', esc_attr( $_stock4 ) );

/*
	$_stock = $_stock1 + $_stock2 + $_stock3;
	update_post_meta($post_id, '_stock', $_stock );

	if($_stock>0){
		$_stock_status = "instock";
	}else{
		$_stock_status = "outofstock";
	}
	update_post_meta($post_id, '_stock_status', esc_attr( $_stock_status ) );
*/

}
/*
END: Vlada added custom inventory fields & handling 16.06.2017. (_sku4 & _stock4 - added 20.02.2018)
*/


?>
