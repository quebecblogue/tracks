<?php

// register and enqueue all of the scripts used by Tracks
function ct_tracks_load_javascript_files() {

    wp_register_style( 'ct-tracks-google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,700');

    if(! is_admin() ) {
        wp_enqueue_script('ct-tracks-production', get_template_directory_uri() . '/js/build/production.min.js#ct_tracks_asyncload', array('jquery'),'', true);
        wp_enqueue_style('ct-tracks-google-fonts');
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
        wp_enqueue_style('style', get_template_directory_uri() . 'style.min.css');

        if(get_theme_mod('premium_layouts_setting') == 'full-width'){
            wp_enqueue_style('ct-tracks-full-width', get_template_directory_uri() . '/licenses/css/full-width.min.css');
        }
        elseif(get_theme_mod('premium_layouts_setting') == 'full-width-images'){
            wp_enqueue_style('ct-tracks-full-width-images', get_template_directory_uri() . '/licenses/css/full-width-images.min.css');
        }
        elseif(get_theme_mod('premium_layouts_setting') == 'two-column'){
            wp_enqueue_style('ct-tracks-two-column', get_template_directory_uri() . '/licenses/css/two-column.min.css');
        }
        elseif(get_theme_mod('premium_layouts_setting') == 'two-column-images'){
            wp_enqueue_style('ct-tracks-two-column-images', get_template_directory_uri() . '/licenses/css/two-column-images.min.css');
        }
    }
    // enqueues the comment-reply script on posts & pages.  This script is included in WP by default
    if( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action('wp_enqueue_scripts', 'ct_tracks_load_javascript_files' );

/* enqueue styles used on theme options page */
function ct_tracks_enqueue_admin_styles($hook){

    // enqueue dashboard page styles
    if ( 'appearance_page_tracks-options' == $hook) {
        wp_enqueue_style('style-admin', get_template_directory_uri() . '/style-admin.css');
    }
    // if is user profile page
    if('profile.php' == $hook || 'user-edit.php' == $hook){

        // Enqueues all scripts, styles, settings, and templates necessary to use media JavaScript APIs.
        wp_enqueue_media();

        // enqueue the JS needed to utilize media uploader on profile image upload
        wp_enqueue_script('ct-profile-uploader', get_template_directory_uri() . '/js/build/profile-uploader.min.js#ct_tracks_asyncload');
    }
}
add_action('admin_enqueue_scripts',	'ct_tracks_enqueue_admin_styles' );

/* enqueues scripts and styles used on customizer page */
function ct_tracks_enqueue_customizer_styles(){
    wp_enqueue_script('ct-customizer-js', get_template_directory_uri() . '/js/build/customizer.min.js#ct_tracks_asyncload');
    wp_enqueue_style('ct-customizer-css', get_template_directory_uri() . '/style-customizer.css');
}
add_action('customize_controls_enqueue_scripts','ct_tracks_enqueue_customizer_styles');

// load all scripts enqueued by theme asynchronously
function ct_tracks_add_async_script($url) {

    // if async parameter not present, do nothing
    if (strpos($url, '#ct_tracks_asyncload') === false){
        return $url;
    }
    // if async parameter present, add async attribute
    return str_replace('#ct_tracks_asyncload', '', $url)."' async='async";
}
add_filter('clean_url', 'ct_tracks_add_async_script', 11, 1);

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'ct_tracks_theme_setup', 10 );

function ct_tracks_theme_setup() {
	
    /* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
    
	/* Theme-supported features go here. */
    add_theme_support( 'hybrid-core-template-hierarchy' );
    add_theme_support( 'loop-pagination' );
    add_theme_support( 'hybrid-core-widgets' );

    // from WordPress core not theme hybrid
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );

    register_nav_menus(array(
        'primary' => __('Primary', 'tracks'),
        'secondary' => __('Secondary', 'tracks'),
        'footer' => __('Footer', 'tracks')
    ));
    
    // adds the file with the customizer functionality
    require_once( trailingslashit( get_template_directory() ) . 'functions-admin.php' );

    // adds theme options page
    require_once( trailingslashit( get_template_directory() ) . 'theme-options.php' );

    // add license folder files
    foreach (glob(trailingslashit( get_template_directory() ) . 'licenses/*.php') as $filename)
    {
        include $filename;
    }
}

function ct_tracks_register_widget_areas(){

    /* register after post content widget area */
    hybrid_register_sidebar( array(
        'name'         => __( 'After Post Content', 'tracks' ),
        'id'           => 'after-post-content',
        'description'  => __( 'Widgets in this area will be shown after post content before the prev/next post links', 'tracks' )
    ) );

    /* register after page content widget area */
    hybrid_register_sidebar( array(
        'name'         => __( 'After Page Content', 'tracks' ),
        'id'           => 'after-page-content',
        'description'  => __( 'Widgets in this area will be shown after page content', 'tracks' )
    ) );
}
add_action('widgets_init','ct_tracks_register_widget_areas');

/* added to customize the comments. Same as default except -> added use of gravatar images for comment authors */
function ct_tracks_customize_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    global $post;
 
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author">
                <?php
                // if is post author
                if( $comment->user_id === $post->post_author ) {
                    ct_tracks_profile_image_output();
                } else {
                    echo get_avatar( get_comment_author_email(), 72 );
                }
                ?>
                <div>
                    <div class="author-name"><?php comment_author_link(); ?></div>
                    <div class="comment-date"><?php comment_date('n/j/Y'); ?></div>
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'tracks' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    <?php edit_comment_link( 'edit' ); ?>
                </div>    
            </div>
            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', 'tracks') ?></em>
                    <br />
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
        </article>
    </li>
    <?php
}

/* added HTML5 placeholders for each default field and aria-required to required */
function ct_tracks_update_fields($fields) {

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="comment-form-author">
            <label class="screen-reader-text">Your Name</label>
            <input required placeholder="Your Name*" id="author" name="author" type="text" aria-required="true" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' />
    	</p>';

    $fields['email'] =
        '<p class="comment-form-email">
            <label class="screen-reader-text">Your Email</label>
            <input required placeholder="Your Email*" id="email" name="email" type="email" aria-required="true" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' />
    	</p>';

    $fields['url'] =
        '<p class="comment-form-url">
            <label class="screen-reader-text">Your Website URL</label>
            <input placeholder="Your URL" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" />
            </p>';

    return $fields;
}
add_filter('comment_form_default_fields','ct_tracks_update_fields');

function ct_tracks_update_comment_field($comment_field) {
	
	$comment_field =
        '<p class="comment-form-comment">
            <label class="screen-reader-text">Your Comment</label>
            <textarea required placeholder="Enter Your Comment&#8230;" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
	
	return $comment_field;
}
add_filter('comment_form_field_comment','ct_tracks_update_comment_field');

// remove allowed tags text after comment form
function ct_tracks_remove_comments_notes_after($defaults){

    $defaults['comment_notes_after']='';
    return $defaults;
}

add_action('comment_form_defaults', 'ct_tracks_remove_comments_notes_after');

// excerpt handling
function ct_tracks_excerpt() {

    // make post variable available
    global $post;

    // make 'read more' setting available
    global $more;

    // get the 'show full post' setting
    $setting = get_theme_mod('premium_layouts_full_width_full_post');

    // check for the more tag
    $ismore = strpos( $post->post_content, '<!--more-->');

    // if show full post is on, and full-width layout is on, show full post unless on search page
    if(($setting == 'yes') && get_theme_mod('premium_layouts_setting') == 'full-width' && !is_search()){

        // set read more value for all posts to 'off'
        $more = -1;

        // output the full content
        the_content();
    }
    // use the read more link if present
    elseif($ismore) {
        the_content("Read More <span class='screen-reader-text'>" . get_the_title() . "</span>");
    }
    // otherwise the excerpt is automatic, so output it
    else {
        the_excerpt();
    }
}

// filter the link on excerpts
function ct_tracks_excerpt_read_more_link($output) {
	global $post;
	return $output . "<p><a class='more-link' href='". get_permalink() ."'>Read the Post <span class='screen-reader-text'>" . get_the_title() . "</span></a></p>";
}

add_filter('the_excerpt', 'ct_tracks_excerpt_read_more_link');

// change the length of the excerpts
function ct_tracks_custom_excerpt_length( $length ) {

    $new_excerpt_length = get_theme_mod('additional_options_excerpt_length_settings');

    // if there is a new length set and it's not 15, change it
    if(!empty($new_excerpt_length) && $new_excerpt_length != 15){
        return $new_excerpt_length;
    } else {
        return 15;
    }
}
add_filter( 'excerpt_length', 'ct_tracks_custom_excerpt_length', 999 );

// switch [...] to ellipsis on automatic excerpt
function ct_tracks_new_excerpt_more( $more ) {
	return '&#8230;';
}
add_filter('excerpt_more', 'ct_tracks_new_excerpt_more');

// turns of the automatic scrolling to the read more link 
function ct_tracks_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}

add_filter( 'the_content_more_link', 'ct_tracks_remove_more_link_scroll' );

// Adds navigation through pages in the loop
function ct_tracks_post_navigation() {
    if ( current_theme_supports( 'loop-pagination' ) ) loop_pagination();
}

// displays the social icons in the .entry-author div
function ct_tracks_author_social_icons() {

    // array of social media site names
    $social_sites = ct_tracks_social_array();

    foreach ($social_sites as $key => $social_site) {
        if(get_the_author_meta( $social_site)) {
            if( $key ==  "flickr" || $key ==  "dribbble" || $key ==  "instagram" || $key ==  "soundcloud" || $key ==  "spotify" || $key ==  "vine" || $key ==  "yahoo" || $key ==  "codepen" || $key ==  "delicious" || $key ==  "stumbleupon" || $key ==  "deviantart" || $key ==  "digg" || $key ==  "hacker-news" || $key == 'vk') {
                echo "<a href='".esc_url(get_the_author_meta( $social_site))."'><i class=\"fa fa-$key\"></i></a>";
            }
            elseif($key == 'googleplus'){
                echo "<a href='".esc_url(get_the_author_meta( $social_site))."'><i class=\"fa fa-google-plus-square\"></i></a>";
            }
            else {
                echo "<a href='".esc_url(get_the_author_meta( $social_site))."'><i class=\"fa fa-$key-square\"></i></a>";
            }
        }
    }
}

// for displaying featured images including mobile versions and default versions
function ct_tracks_featured_image() {

    global $post;
    $has_image = false;

    $premium_layout = get_theme_mod('premium_layouts_setting');

    if (has_post_thumbnail( $post->ID ) ) {

        if( is_archive() || is_home() && $premium_layout != 'full-width' ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        } else {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        }
        $image = $image[0];
        $has_image = true;
    }
    if ($has_image == true) {

        // for layouts using img
        if($premium_layout == 'two-column-images' || ($premium_layout == 'full-width-images' && get_theme_mod('premium_layouts_full_width_image_height') == 'image')){

            // if it's an archive page and the two-column-images layout, switch to a potentially smaller version
            if(is_archive() || is_home() && $premium_layout == 'two-column-images'){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $image[0];
            }
            ?>
             <img class="featured-image" src='<?php echo $image; ?>' />
            <?php
        }
        // otherwise, output the src as a bg image
        else {
            // if lazy loading is enabled
            if(get_theme_mod('additional_options_lazy_load_settings') == 'yes'){
                echo "<div class='featured-image lazy lazy-bg-image' data-background='$image')\"></div>";
            }
            // if lazy loading is NOT enabled
            else {
                echo "<div class='featured-image' style=\"background-image: url('" . $image . "')\")></div>";
            }
        }
    }
}

// puts site title & description in the title tag on front page
add_filter( 'wp_title', 'ct_tracks_add_homepage_title' );
function ct_tracks_add_homepage_title( $title )
{
    if( empty( $title ) && ( is_home() || is_front_page() ) ) {
        return __( get_bloginfo( 'title' ), 'theme_domain' ) . ' | ' . get_bloginfo( 'description' );
    }
    return $title;
}

/* add conditional classes for premium layouts */
function ct_tracks_body_class( $classes ) {
    if ( ! is_front_page() ) {
        $classes[] = 'not-front';
    }
    if (get_theme_mod('ct_tracks_header_color_setting') == 'dark'){
        $classes[] = 'dark-header';
    }
    if(get_theme_mod('premium_layouts_setting') == 'full-width'){
        $classes[] = 'full-width';

        if(get_theme_mod('premium_layouts_full_width_full_post') == 'yes'){
            $classes[] = 'full-post';
        }
    }
    elseif(get_theme_mod('premium_layouts_setting') == 'full-width-images'){
        $classes[] = 'full-width-images';

        if(get_theme_mod('premium_layouts_full_width_image_height') == '2:1-ratio'){
            $classes[] = 'ratio';
        }
    }
    elseif(get_theme_mod('premium_layouts_setting') == 'two-column'){
        $classes[] = 'two-column';
    }
    elseif(get_theme_mod('premium_layouts_setting') == 'two-column-images'){
        $classes[] = 'two-column-images';
    }
    if(get_theme_mod( 'ct_tracks_background_image_setting')){
        $classes[] = 'background-image-active';
    }
    if(get_theme_mod( 'ct_tracks_texture_display_setting') == 'yes'){
        $classes[] = 'background-texture-active';
    }
    return $classes;
}
add_filter( 'body_class', 'ct_tracks_body_class' );

// calls pages for menu if menu not set
function ct_tracks_wp_page_menu() {
    wp_page_menu(array(
            "menu_class" => "menu-unset"
        )
    );
}

function ct_tracks_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'ct_tracks_add_editor_styles' );

function ct_tracks_post_class_update($classes){

    $remove = array();
    $remove[] = 'entry';

    if ( ! is_singular() ) {
        foreach ( $classes as $key => $class ) {

            if ( in_array( $class, $remove ) ){
                unset( $classes[ $key ] );
                $classes[] = 'excerpt';
            }
        }
    }
    return $classes;
}
add_filter( 'post_class', 'ct_tracks_post_class_update' );

// fix for bug with Disqus saying comments are closed
if ( function_exists( 'dsq_options' ) ) {
    remove_filter( 'comments_template', 'dsq_comments_template' );
    add_filter( 'comments_template', 'dsq_comments_template', 99 ); // You can use any priority higher than '10'
}

/* add a smaller size for the portfolio page */
if( function_exists('add_image_size')){
    add_image_size('blog', 700, 350);
}

function ct_tracks_odd_even_post_class( $classes ) {

    // access the post object
    global $wp_query;

    // add even/odd class
    $classes[] = ($wp_query->current_post % 2 == 0) ? 'odd' : 'even';

    // add post # class
    $classes[] = "excerpt-" . ($wp_query->current_post + 1);

    return $classes;
}
add_filter ( 'post_class' , 'ct_tracks_odd_even_post_class' );

/* css output for hiding the scroll to top link */
function ct_tracks_return_top_settings_output(){

    $setting = get_theme_mod('additional_options_return_top_settings');

    /* if 'hide' is selected, hide it */
    if($setting == 'hide') {
        $css = "#return-top { display: none; }";
        wp_add_inline_style('style', $css);
    }
}
add_action('wp_enqueue_scripts','ct_tracks_return_top_settings_output');

/* css output for hiding the scroll to top link */
function ct_tracks_image_zoom_settings_output(){

    $setting = get_theme_mod('additional_options_image_zoom_settings');

    /* if 'hide' is selected, hide it */
    if($setting == 'no-zoom') {
        $css = "
            .featured-image-link:hover .featured-image { -ms-transform: none; -moz-transform: none; -o-transform: none; -webkit-transform: none; transform: none;}
            .featured-image-link:active .featured-image { -ms-transform: none; -moz-transform: none; -o-transform: none; -webkit-transform: none; transform: none;}
            .featured-image-link:focus .featured-image { -ms-transform: none; -moz-transform: none; -o-transform: none; -webkit-transform: none; transform: none;}
        ";
        wp_add_inline_style('style', $css);
    }
}
add_action('wp_enqueue_scripts','ct_tracks_image_zoom_settings_output');

// outputs linked social media icons from customizer
function ct_tracks_customizer_social_icons_output() {

    // array of social media site names
    $social_sites = ct_tracks_social_site_list();

    // any inputs that aren't empty are stored in $active_sites array
    foreach($social_sites as $social_site) {
        if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
            $active_sites[] = $social_site;
        }
    }

    // for each active social site, add it as a list item
    if(!empty($active_sites)) {
        echo "<ul class='social-media-icons'>";
        foreach ($active_sites as $active_site) { ?>
            <li>
            <a target="_blank" href="<?php echo esc_url(get_theme_mod( $active_site )); ?>">
                <?php if( $active_site ==  "flickr" || $active_site ==  "dribbble" || $active_site ==  "instagram" || $active_site ==  "soundcloud" || $active_site ==  "spotify" || $active_site ==  "vine" || $active_site ==  "yahoo" || $active_site ==  "codepen" || $active_site ==  "delicious" || $active_site ==  "stumbleupon" || $active_site ==  "deviantart" || $active_site ==  "digg" || $active_site ==  "hacker-news" || $active_site == 'vk') { ?>
                    <i class="fa fa-<?php echo $active_site; ?>"></i> <?php
                } else { ?>
                <i class="fa fa-<?php echo $active_site; ?>-square"></i><?php
                } ?>
            </a>
            </li><?php
        }
        echo "</ul>";
    }
}

// array of social media site names
function ct_tracks_social_site_list(){

    $social_sites = array('twitter', 'facebook', 'google-plus', 'flickr', 'pinterest', 'youtube', 'vimeo', 'tumblr', 'dribbble', 'rss', 'linkedin', 'instagram', 'reddit', 'soundcloud', 'spotify', 'vine','yahoo', 'behance', 'codepen', 'delicious', 'stumbleupon', 'deviantart', 'digg', 'git', 'hacker-news', 'steam', 'vk' );
    return $social_sites;
}

function ct_tracks_category_link(){
    $category = get_the_category();
    $category_link = get_category_link( $category[0]->term_id );
    $category_name = $category[0]->cat_name;
    $html = "<a href='" . $category_link . "'>" . $category_name . "</a>";
    echo $html;
}

// retrieves the attachment ID from the file URL
function ct_tracks_get_image_id($url) {

    // Split the $url into two parts with the wp-content directory as the separator
    $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

    // Get the host of the current site and the host of the $url, ignoring www
    $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
    $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match
    if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
        return;
    }

    // Now we're going to quickly search the DB for any attachment GUID with a partial path match
    // Example: /uploads/2013/05/test-image.jpg
    global $wpdb;

    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

    // Returns null if no attachment is found
    return $attachment[0];
}

function ct_tracks_profile_image_output(){

    // use User's profile image, else default to their Gravatar
    if(get_the_author_meta('user_profile_image')){

        // get the id based on the image's URL
        $image_id = ct_tracks_get_image_id(get_the_author_meta('user_profile_image'));

        // retrieve the thumbnail size of profile image
        $image_thumb = wp_get_attachment_image($image_id, 'thumbnail');

        // display the image
        echo $image_thumb;

    } else {
        echo get_avatar( get_the_author_meta( 'ID' ), 72 );
    }
}

function ct_tracks_custom_css_output(){

    $custom_css = get_theme_mod('ct_tracks_custom_css_setting');

    /* output custom css */
    if($custom_css) {
        wp_add_inline_style('style', $custom_css);
    }
}
add_action('wp_enqueue_scripts','ct_tracks_custom_css_output');


function ct_tracks_background_image_output(){

    $background_image = get_theme_mod( 'ct_tracks_background_image_setting');

    if($background_image){

        $background_image_css = "
            .background-image {
                background-image: url('$background_image');
            }
        ";
        wp_add_inline_style('style', $background_image_css);
    }
}
add_action('wp_enqueue_scripts','ct_tracks_background_image_output');

function ct_tracks_background_texture_output(){

    $background_texture = get_theme_mod( 'ct_tracks_background_texture_setting');
    $background_texture_display = get_theme_mod('ct_tracks_texture_display_setting');

    if($background_texture && $background_texture_display == 'yes'){

        $background_texture_css = "
            .overflow-container {
                background-image: url('" . get_template_directory_uri() . "/assets/images/textures/$background_texture.png');
            }
        ";
        wp_add_inline_style('style', $background_texture_css);
    }
}
add_action('wp_enqueue_scripts','ct_tracks_background_texture_output');

?>