<?php
	
function ethical_record_init()  {
	remove_action( 'wp_head', 'wp_generator' );
	show_admin_bar( false );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 700, 320, true );
	add_image_size( 'featured', 700, 320, true );
	add_image_size( 'article', 343, 120, true );
	add_image_size( 'speaker', 290, 290, true );
	$defaults = array(
		'default-image'          => get_template_directory_uri() . '/img/header/header.png',
		'random-default'         => true,
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );
	add_editor_style( 'editor-style.css' );	
	$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', );
	add_theme_support( 'html5', $markup );	
}
add_action( 'after_setup_theme', 'ethical_record_init' );

function er_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.1', true );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', false, '2.8.1', false );
	wp_register_script( 'gumby', get_template_directory_uri() . '/js/libs/gumby.min.js', false, '2.6', true );
	wp_register_script( 'cookie', get_template_directory_uri() . '/js/libs/cookie.js', false, '1.4.1', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', false, '2.6', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'gumby' );
	wp_enqueue_script( 'cookie' );
	wp_enqueue_script( 'main' );
}
add_action( 'wp_enqueue_scripts', 'er_scripts' );

function er_styles() {
	wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', false, '2.6' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_enqueue_style( 'normalise' );
	wp_enqueue_style( 'base' );
}
add_action( 'wp_enqueue_scripts', 'er_styles' );

function er_menu() {
	$locations = array(
		'ermenu' => __( 'Ethical Record Menu', 'er' ),
		'chmenu' => __( 'Conway Hall Menu', 'er' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'er_menu' );

register_sidebar( array(
	'id' => 'homepage',
	'name' => __( 'Home Page Sidebar', 'er' ),
	'description' => __( 'Sidebar for the home page/archives', 'er' ),
	'before_title' => '<h5 class="widget">',
	'after_title' => '</h5>',
	'before_widget' => '<li id="%1$s" class="widget field %2$s">',
	'after_widget' => '</li>',
));

function twentytwelve_get_featured_content( $num = 1 ) {
	global $featured;
	$featured = apply_filters( 'twentytwelve_featured_content', array() );
	if ( is_array( $featured ) || $num >= count( $featured ) )
		return true;
	return false;
}

function the_post_thumbnail_caption() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id($post->ID);
	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
	if ($thumbnail_image && isset($thumbnail_image[0])) {
		echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
	}
}

function er_post_tax() {
	$labels = array(
		'name'                       => _x( 'Sections', 'Taxonomy General Name', 'er' ),
		'singular_name'              => _x( 'Section', 'Taxonomy Singular Name', 'er' ),
		'menu_name'                  => __( 'Sections', 'er' ),
		'all_items'                  => __( 'All Sections', 'er' ),
		'parent_item'                => __( 'Parent Section', 'er' ),
		'parent_item_colon'          => __( 'Parent Section:', 'er' ),
		'new_item_name'              => __( 'New Section', 'er' ),
		'add_new_item'               => __( 'Add New Section', 'er' ),
		'edit_item'                  => __( 'Edit Section', 'er' ),
		'update_item'                => __( 'Update Section', 'er' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'er' ),
		'search_items'               => __( 'Search Sections', 'er' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'er' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'er' ),
		'not_found'                  => __( 'Not Found', 'er' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'section', array( 'ethicalrecord' ), $args );
}
add_action( 'init', 'er_post_tax', 0 );

function er_tax() {
	$labels = array(
		'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'er' ),
		'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'er' ),
		'menu_name'                  => __( 'Taxonomy', 'er' ),
		'all_items'                  => __( 'All Items', 'er' ),
		'parent_item'                => __( 'Parent Item', 'er' ),
		'parent_item_colon'          => __( 'Parent Item:', 'er' ),
		'new_item_name'              => __( 'New Item Name', 'er' ),
		'add_new_item'               => __( 'Add New Item', 'er' ),
		'edit_item'                  => __( 'Edit Item', 'er' ),
		'update_item'                => __( 'Update Item', 'er' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'er' ),
		'search_items'               => __( 'Search Items', 'er' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'er' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'er' ),
		'not_found'                  => __( 'Not Found', 'er' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'taxonomy', array( 'ethicalrecord' ), $args );
}
add_action( 'init', 'er_tax', 0 );

add_filter( 'post_class', 'er_taxonomy_post_class', 10, 3 );
 
function er_taxonomy_post_class( $classes, $class, $ID ) {
    $taxonomy = 'taxonomy';
    $terms = get_the_terms( (int) $ID, $taxonomy );
    if( !empty( $terms ) ) {
        foreach( (array) $terms as $order => $term ) {
            if( !in_array( $term->slug, $classes ) ) {
                $classes[] = $term->slug;
            }
        }
    }
    return $classes;
} 

function er_posts() {
	$labels = array(
		'name'                => _x( 'ER Posts', 'Post Type General Name', 'er' ),
		'singular_name'       => _x( 'ER Post', 'Post Type Singular Name', 'er' ),
		'menu_name'           => __( 'ER Posts', 'er' ),
		'parent_item_colon'   => __( 'Parent ER Post:', 'er' ),
		'all_items'           => __( 'All ER Posts', 'er' ),
		'view_item'           => __( 'View ER Post', 'er' ),
		'add_new_item'        => __( 'Add New ER Post', 'er' ),
		'add_new'             => __( 'Add New', 'er' ),
		'edit_item'           => __( 'Edit ER Post', 'er' ),
		'update_item'         => __( 'Update ER Post', 'er' ),
		'search_items'        => __( 'Search ER Posts', 'er' ),
		'not_found'           => __( 'Not found', 'er' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'er' ),
	);
	$args = array(
		'label'               => __( 'ethicalrecord', 'er' ),
		'description'         => __( 'Ethical Record Posts', 'er' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'post_tag', 'tags', 'thumbnail'),
		'taxonomies'          => array( 'post_tag', 'tags' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'ethicalrecord', $args );
}
add_action( 'init', 'er_posts', 0 );

function speaker() {
	$labels = array(
		'name'                => _x( 'Speakers', 'Post Type General Name', 'er' ),
		'singular_name'       => _x( 'Speaker', 'Post Type Singular Name', 'er' ),
		'menu_name'           => __( 'Speakers', 'er' ),
		'parent_item_colon'   => __( 'Parent Speaker:', 'er' ),
		'all_items'           => __( 'All Speakers', 'er' ),
		'view_item'           => __( 'View Speaker', 'er' ),
		'add_new_item'        => __( 'Add New Speaker', 'er' ),
		'add_new'             => __( 'Add New', 'er' ),
		'edit_item'           => __( 'Edit Speaker', 'er' ),
		'update_item'         => __( 'Update Speaker', 'er' ),
		'search_items'        => __( 'Search Speakers', 'er' ),
		'not_found'           => __( 'Not found', 'er' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'er' ),
	);
	$args = array(
		'label'               => __( 'speaker', 'er' ),
		'description'         => __( 'Lecture Speakers', 'er' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'speaker', $args );
}
add_action( 'init', 'speaker', 0 );

function issue() {
	$labels = array(
		'name'                => _x( 'Issues', 'Post Type General Name', 'er' ),
		'singular_name'       => _x( 'Issue', 'Post Type Singular Name', 'er' ),
		'menu_name'           => __( 'Issues', 'er' ),
		'parent_item_colon'   => __( 'Parent Issue:', 'er' ),
		'all_items'           => __( 'All Issues', 'er' ),
		'view_item'           => __( 'View Issue', 'er' ),
		'add_new_item'        => __( 'Add New Issue', 'er' ),
		'add_new'             => __( 'Add New', 'er' ),
		'edit_item'           => __( 'Edit Issue', 'er' ),
		'update_item'         => __( 'Update Issue', 'er' ),
		'search_items'        => __( 'Search Issues', 'er' ),
		'not_found'           => __( 'Not found', 'er' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'er' ),
	);
	$args = array(
		'label'               => __( 'issue', 'er' ),
		'description'         => __( 'Ethical Record Issue', 'er' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'post_tag', 'tags' ),
		'taxonomies'          => array( 'post_tag', 'tags' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'issue', $args );
}
add_action( 'init', 'issue', 0 );

function lectureSpeaker() {
    p2p_register_connection_type( array(
        'name' => 'lectures2speakers',
        'from' => 'speaker',
        'to' => 'ethicalrecord'
	) );
}
add_action( 'p2p_init', 'lectureSpeaker' );

function issuePost() {
    p2p_register_connection_type( array(
        'name' => 'issue2post',
        'from' => 'issue',
        'to' => 'ethicalrecord'
    ) );
}
add_action( 'p2p_init', 'issuePost' );

function extra_info( $meta_boxes ) {
	$prefix = '_cmb_'; 
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Meta Info',
		'pages' => array('ethicalrecord'), 
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'Lectures',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Speaker',
				'desc' => 'Copy the name of the speaker here (for the eBooks option)',
				'type' => 'text',
				'id' => $prefix . 'lecspeaker'
			),
			array(
				'name' => 'Lecture Date',
				'desc' => '',
				'type' => 'text_date',
				'id' => $prefix . 'lecdate'
			),
			array(
				'name' => 'Lecture Abstract',
				'desc' => 'Try to limit to around 20 - 50 words.',
				'type' => 'textarea',
				'id' => $prefix . 'abstract'
			),
			array(
				'name' => 'Lecture References/Footnotes',
				'desc' => '',
				'type' => 'wysiwyg',
				'options' => array(
					'wpautop' => true, // use wpautop?
					'media_buttons' => true, // show insert/upload button(s)
					'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
					'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
					'tabindex' => '',
					'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
					'editor_class' => '', // add extra class(es) to the editor textarea
					'teeny' => true, // output the minimal editor config used in Press This
					'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
					'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()  
				),
				'id' => $prefix . 'ref'
			),
			array(
				'name' => 'Lecture Video',
				'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
				'type' => 'oembed',
				'id' => $prefix . 'lecture_video'
			),
			array(
				'name' => 'Book Reviews',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Book Author(s)',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'author'
			),
			array(
				'name' => 'Book Publisher',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'publisher'
			),
			array(
				'name' => 'ISBN',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'isbn'
			),
			array(
				'name' => 'Review Author',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'vpauthor'
			),	
			array(
				'name' => 'Videos',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'Video',
				'desc' => 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.',
				'type' => 'oembed',
				'id' => $prefix . 'video'
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'extra_info' );

function archive_issue( $meta_boxes ) {
	$prefix = '_cmb_'; 
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'Meta Info',
		'pages' => array('issue'), 
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true,
		'fields' => array(	
			array(
				'name' => 'PDF Archive Issue',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . ''
			),
			array(
				'name' => 'URL',
				'desc' => '',
				'type' => 'file',
				'id' => $prefix . 'issue'
			)			
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'archive_issue' );

add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}

function SearchFilter($query) {
	if ($query->is_search or $query->is_feed) {
		if($_GET['post_type'] == "lecture") {
			$query->set('post_type', 'lecture');
		}
		elseif($_GET['post_type'] == "book_review") {
			$query->set('post_type','book_review');
		}
		elseif($_GET['post_type'] == "video") {
			$query->set('post_type','video');
		}
		elseif($_GET['post_type'] == "all") {
			$query->set('post_type', array('lecture', 'viewpoint', 'book_review', 'video', 'page', 'post'));
		}
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

function new_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More &raquo;', 'stop_ivory') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function er_twitter_site( $og_tags ) {
	$og_tags['twitter:site'] = '@ConwayHall';
	return $og_tags;
}
add_filter( 'jetpack_open_graph_tags', 'er_twitter_site', 11 );

function like_scripts() {
	wp_enqueue_script( 'jm_like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
	wp_localize_script( 'jm_like_post', 'ajax_var', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
}
add_action( 'init', 'like_scripts' );

function enqueue_icons () {
	wp_register_style( 'icon-style', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css' );
    wp_enqueue_style( 'icon-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_icons' );

add_action( 'wp_ajax_nopriv_jm-post-like', 'jm_post_like' );
add_action( 'wp_ajax_jm-post-like', 'jm_post_like' );
function jm_post_like() {
	$nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );
	
	if ( isset( $_POST['jm_post_like'] ) ) {
	
		$post_id = $_POST['post_id']; // post id
		$post_like_count = get_post_meta( $post_id, "_post_like_count", true ); // post like count
		
		if ( is_user_logged_in() ) { // user is logged in
			$user_id = get_current_user_id(); // current user
			$meta_POSTS = get_user_option( "_liked_posts", $user_id  ); // post ids from user meta
			$meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
			$liked_POSTS = NULL; // setup array variable
			$liked_USERS = NULL; // setup array variable
			
			if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values
				$liked_POSTS = $meta_POSTS;
			}
			
			if ( !is_array( $liked_POSTS ) ) // make array just in case
				$liked_POSTS = array();
				
			if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
				$liked_USERS = $meta_USERS[0];
			}		

			if ( !is_array( $liked_USERS ) ) // make array just in case
				$liked_USERS = array();
				
			$liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
			$liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
			$user_likes = count( $liked_POSTS ); // count user likes
	
			if ( !AlreadyLiked( $post_id ) ) { // like the post
				update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Add user ID to post meta
				update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
				update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
				update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
				echo $post_like_count; // update count on front end

			} else { // unlike the post
				$pid_key = array_search( $post_id, $liked_POSTS ); // find the key
				$uid_key = array_search( $user_id, $liked_USERS ); // find the key
				unset( $liked_POSTS[$pid_key] ); // remove from array
				unset( $liked_USERS[$uid_key] ); // remove from array
				$user_likes = count( $liked_POSTS ); // recount user likes
				update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Remove user ID from post meta
				update_post_meta($post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
				update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Remove post ID from user meta			
				update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta
				echo "already".$post_like_count; // update count on front end
				
			}
			
		} else { // user is not logged in (anonymous)
			$ip = $_SERVER['REMOTE_ADDR']; // user IP address
			$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
			$liked_IPS = NULL; // set up array variable
			
			if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
				$liked_IPS = $meta_IPS[0];
			}
	
			if ( !is_array( $liked_IPS ) ) // make array just in case
				$liked_IPS = array();
				
			if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
				$liked_IPS['ip-'.$ip] = $ip; // add IP to array
			
			if ( !AlreadyLiked( $post_id ) ) { // like the post
				update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Add user IP to post meta
				update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
				echo $post_like_count; // update count on front end
				
			} else { // unlike the post
				$ip_key = array_search( $ip, $liked_IPS ); // find the key
				unset( $liked_IPS[$ip_key] ); // remove from array
				update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Remove user IP from post meta
				update_post_meta( $post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
				echo "already".$post_like_count; // update count on front end
				
			}
		}
	}
	
	exit;
}

function AlreadyLiked( $post_id ) { // test if user liked before
	if ( is_user_logged_in() ) { // user is logged in
		$user_id = get_current_user_id(); // current user
		$meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
		$liked_USERS = ""; // set up array variable
		
		if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
			$liked_USERS = $meta_USERS[0];
		}
		
		if( !is_array( $liked_USERS ) ) // make array just in case
			$liked_USERS = array();
			
		if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
			return true;
		}
		return false;
		
	} else { // user is anonymous, use IP address for voting
	
		$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
		$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
		$liked_IPS = ""; // set up array variable
		
		if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
			$liked_IPS = $meta_IPS[0];
		}
		
		if ( !is_array( $liked_IPS ) ) // make array just in case
			$liked_IPS = array();
		
		if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
			return true;
		}
		return false;
	}
	
}

function getPostLikeLink( $post_id ) {
	$like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
	$count = ( empty( $like_count ) || $like_count == "0" ) ? 'Like' : esc_attr( $like_count );
	if ( AlreadyLiked( $post_id ) ) {
		$class = esc_attr( ' liked' );
		$title = esc_attr( 'Unlike' );
		$heart = '<i class="fa fa-heart"></i>';
	} else {
		$class = esc_attr( '' );
		$title = esc_attr( 'Like' );
		$heart = '<i class="fa fa-heart-o"></i>';
	}
	$output = '<a href="#" class="jm-post-like'.$class.'" data-post_id="'.$post_id.'" title="'.$title.'">'.$heart.'&nbsp;'.$count.'</a>';
	return $output;
}

add_action( 'show_user_profile', 'show_user_likes' );
add_action( 'edit_user_profile', 'show_user_likes' );
function show_user_likes( $user ) { ?>        
    <table class="form-table">
        <tr>
			<th><label for="user_likes"><?php _e( 'You Like:', 'er' ); ?></label></th>
			<td>
            <?php
			$user_likes = get_user_option( "_liked_posts", $user->ID );
			if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
				$the_likes = $user_likes;
			} else {
				$the_likes = '';
			}
			if ( !is_array( $the_likes ) )
			$the_likes = array();
			$count = count( $the_likes ); 
			$i=0;
			if ( $count > 0 ) {
				$like_list = '';
				echo "<p>\n";
				foreach ( $the_likes as $the_like ) {
					$i++;
					$like_list .= "<a href=\"" . esc_url( get_permalink( $the_like ) ) . "\" title=\"" . esc_attr( get_the_title( $the_like ) ) . "\">" . get_the_title( $the_like ) . "</a>\n";
					if ($count != $i) $like_list .= " &middot; ";
					else $like_list .= "</p>\n";
				}
				echo $like_list;
			} else {
				echo "<p>" . _e( 'You don\'t like anything yet.' ) . "</p>\n";
			} ?>
            </td>
		</tr>
    </table>
<?php }

function jm_like_shortcode() {
	return getPostLikeLink( get_the_ID() );
}
add_shortcode('jmliker', 'jm_like_shortcode');

function frontEndUserLikes() {
	if ( is_user_logged_in() ) { // user is logged in
		$like_list = '';
		$user_id = get_current_user_id(); // current user
		$user_likes = get_user_option( "_liked_posts", $user_id );
		if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
			$the_likes = $user_likes;
		} else {
			$the_likes = '';
		}
		if ( !is_array( $the_likes ) )
			$the_likes = array();
		$count = count( $the_likes );
		if ( $count > 0 ) {
			$limited_likes = array_slice( $the_likes, 0, 5 ); // this will limit the number of posts returned to 5
			$like_list .= "<aside>\n";
			$like_list .= "<h3>" . __( 'You Like:', 'er' ) . "</h3>\n";
			$like_list .= "<ul>\n";
			foreach ( $limited_likes as $the_like ) {
				$like_list .= "<li><a href='" . esc_url( get_permalink( $the_like ) ) . "' title='" . esc_attr( get_the_title( $the_like ) ) . "'>" . get_the_title( $the_like ) . "</a></li>\n";
			}
			$like_list .= "</ul>\n";
			$like_list .= "</aside>\n";
		}
		echo $like_list;
	}
}

function jm_most_popular_today() {
	global $post;
	$today = date('j');
  	$year = date('Y');
	$args = array(
		'year' => $year,
		'day' => $today,
		'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
		'meta_key' => '_post_like_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'posts_per_page' => 5
		);
	$pop_posts = new WP_Query( $args );
	if ( $pop_posts->have_posts() ) {
		echo "<aside>\n";
		echo "<h3>" . _e( 'Today\'s Most Popular Posts' ) . "</h3>\n";
		echo "<ul>\n";
		while ( $pop_posts->have_posts() ) {
			$pop_posts->the_post();
			echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
		}
		echo "</ul>\n";
		echo "</aside>\n";
	}
	wp_reset_postdata();
}

/**
 * (10) Outputs a list of the 5 posts with the most user likes for THIS MONTH
 * Markup assumes sidebar/widget usage
 */
function jm_most_popular_month() {
	global $post;
	$month = date('m');
  	$year = date('Y');
	$args = array(
		'year' => $year,
		'monthnum' => $month,
		'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
		'meta_key' => '_post_like_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'posts_per_page' => 5
		);
	$pop_posts = new WP_Query( $args );
	if ( $pop_posts->have_posts() ) {
		echo "<aside>\n";
		echo "<h3>" . _e( 'This Month\'s Most Popular Posts' ) . "</h3>\n";
		echo "<ul>\n";
		while ( $pop_posts->have_posts() ) {
			$pop_posts->the_post();
			echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
		}
		echo "</ul>\n";
		echo "</aside>\n";
	}
	wp_reset_postdata();
}

function jm_most_popular_week() {
	global $post;
	$week = date('W');
  	$year = date('Y');
	$args = array(
		'year' => $year,
		'w' => $week,
		'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
		'meta_key' => '_post_like_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'posts_per_page' => 5
		);
	$pop_posts = new WP_Query( $args );
	if ( $pop_posts->have_posts() ) {
		echo "<aside>\n";
		echo "<h3>" . _e( 'This Week\'s Most Popular Posts' ) . "</h3>\n";
		echo "<ul>\n";
		while ( $pop_posts->have_posts() ) {
			$pop_posts->the_post();
			echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
		}
		echo "</ul>\n";
		echo "</aside>\n";
	}
	wp_reset_postdata();
}

function jm_most_popular() {
	global $post;
	echo "<aside>\n";
	echo "<h3>" . _e( 'Most Popular Posts', 'er' ) . "</h3>\n";
	echo "<ul>\n";
	$args = array(
		 'post_type' => array( 'post', 'enter-your-comma-separated-post-types-here' ),
		 'meta_key' => '_post_like_count',
		 'orderby' => 'meta_value_num',
		 'order' => 'DESC',
		 'posts_per_page' => 5 
		 );
	$pop_posts = new WP_Query( $args );
	while ( $pop_posts->have_posts() ) {
		$pop_posts->the_post();
		echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
	}
	wp_reset_postdata();
	echo "</ul>\n";
	echo "</aside>\n";
}

class er_join_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'er_widget', 
			__('Join Us', 'er'), 
			array( 'description' => __( 'Link to join form for Ethical Record', 'er' ), ) 
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		echo __( 'Hello, World!', 'er' );
	}
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'er' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'er' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}
function er_load_join_widget() {
	register_widget( 'er_join_widget' );
}
add_action( 'widgets_init', 'er_load_join_widget' );

class er_search_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'er_widget', 
			__('Search', 'er'), 
			array( 'description' => __( 'Link to custom search form for Ethical Record', 'er' ), ) 
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
?>
<form id="search" name="searchform" method="get" action="<?php bloginfo("url"); ?>">
	<div class="field">
		<input type="search" class="input narrow" id="s" name="s" placeholder="Search" value="<?php the_search_query(); ?>" /> 
		<div class="btn secondary medium">
			<a href="#" id="submitForm"><i class="icon-search"></i></a>
		</div>
		<br /><a href="#" id="searchAnchor"><i id="toggle" class="icon-down-open-big"></i> Search Options</a>
	</div>
	<div class="field" id="options">
		<select name="category_name">
			<option value="" selected>Everything</option>
			<?php
				$categories = get_categories();
				foreach ($categories as $category) {
				    echo '<option value="', $category->slug, '">', $category->name, "</option>\n";
				}
			?>
		</select>
	</div>
</form>
<?php
	}
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'er' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'er' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}
function er_load_search_widget() {
	register_widget( 'er_search_widget' );
}
add_action( 'widgets_init', 'er_load_search_widget' );

class er_Image_Widget extends WP_Widget {
	function er_Image_Widget() {
		$widget_ops = array( 'classname' => 'widget_image', 'description' => __( "Display an image link to the join us form", 'er' ) );
		$control_ops = array( 'width' => 400 );
		$this->WP_Widget( 'image', __( 'Join Us Image', 'er' ), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title )
			echo $before_title . esc_html( $title ) . $after_title;
		if ( '' != $instance['img_url'] ) {
			$output = '<img src="' . esc_attr( $instance['img_url'] ) .'" ';
			if ( '' != $instance['alt_text'] )
				$output .= 'alt="' . esc_attr( $instance['alt_text'] ) .'" ';
			if ( '' != $instance['img_title'] )
				$output .= 'title="' . esc_attr( $instance['img_title'] ) .'" ';
			if ( '' == $instance['caption'] )
				$output .= 'class="align' . esc_attr( $instance['align'] ) . '" ';
			if ( '' != $instance['img_width'] )
				$output .= 'width="' . esc_attr( $instance['img_width'] ) .'" ';
			if ( '' != $instance['img_height'] )
				$output .= 'height="' . esc_attr( $instance['img_height'] ) .'" ';
			$output .= '/>';
			if ( '' != $instance['link'] )
				$output = '<a href="' . esc_attr( $instance['link'] ) . '">' . $output . '</a>';
			if ( '' != $instance['caption'] ) {
				$caption = apply_filters( 'widget_text', $instance['caption'] );
				$output = '[caption align="align' .  esc_attr( $instance['align'] ) . '" width="' . esc_attr( $instance['img_width'] ) .'"]' . $output . ' ' . $caption . '[/caption]<div class="medium secondary btn"><a href="' . esc_attr( $instance['link'] ) . '">' . esc_attr( $instance['alt_text'] ) . '</a></div>'; // wp_kses_post caption on update 
			}
			echo '<div class="jetpack-image-container">' . do_shortcode( $output ) . '</div>';
		}
		echo "\n" . $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		 $allowed_caption_html = array( 
		 	'a' => array( 
		 		'href' => array(), 
		 		'title' => array(),
		 		), 
		 	'b' => array(), 
		 	'em' => array(), 
		 	'i' => array(), 
		 	'p' => array(), 
		 	'strong' => array() 
		 	);
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['img_url']    = esc_url( $new_instance['img_url'], null, 'display' );
		$instance['alt_text']   = strip_tags( $new_instance['alt_text'] );
		$instance['img_title']  = strip_tags( $new_instance['img_title'] );
		$instance['caption']    = wp_kses( stripslashes($new_instance['caption'] ), $allowed_caption_html ); 
		$instance['align']      = $new_instance['align'];
		$instance['img_width']  = absint( $new_instance['img_width'] );
		$instance['img_height'] = absint( $new_instance['img_height'] );
		$instance['link']       = esc_url( $new_instance['link'], null, 'display' );
		return $instance;
	}
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'img_url' => '', 'alt_text' => '', 'img_title' => '', 'caption' => '', 'align' => 'none', 'img_width' => '', 'img_height' => '', 'link' => '' ) );

		$title      = esc_attr( $instance['title'] );
		$img_url    = esc_url( $instance['img_url'], null, 'display' );
		$alt_text   = esc_attr( $instance['alt_text'] );
		$img_title  = esc_attr( $instance['img_title'] );
		$caption    = esc_textarea( $instance['caption'] );
		$align      = esc_attr( $instance['align'] );
		$img_width  = esc_attr( $instance['img_width'] );
		$img_height = esc_attr( $instance['img_height'] );

		if ( !empty( $instance['img_url'] ) ) {
			$tmp_file = download_url( $instance['img_url'], 30 );
			if ( ! is_wp_error( $tmp_file ) ) {
				$size = getimagesize( $tmp_file );
				if ( '' == $instance['img_width'] ) {
					$width = $size[0];
					$img_width = $width;
				} else {
					$img_width = absint( $instance['img_width'] );
				}
				if ( '' == $instance['img_height'] ) {
					$height = $size[1];
					$img_height = $height;
				} else {
					$img_height = absint( $instance['img_height'] );
				}
				unlink( $tmp_file );
			}
		}
		$link = esc_url( $instance['link'], null, 'display' );
		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . esc_html__( 'Widget title:', 'er' ) . '
			<input class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . $title . '" />
			</label></p>
			<p><label for="' . $this->get_field_id( 'img_url' ) . '">' . esc_html__( 'Image URL:', 'er' ) . '
			<input class="widefat" id="' . $this->get_field_id( 'img_url' ) . '" name="' . $this->get_field_name( 'img_url' ) . '" type="text" value="' . $img_url . '" />
			</label></p>
			<p><label for="' . $this->get_field_id( 'alt_text' ) . '">' . esc_html__( 'Alternate text:', 'er' ) . '  <a href="http://support.wordpress.com/widgets/image-widget/#image-widget-alt-text" target="_blank">( ? )</a>
			<input class="widefat" id="' . $this->get_field_id( 'alt_text' ) . '" name="' . $this->get_field_name( 'alt_text' ) . '" type="text" value="' . $alt_text . '" />
			</label></p>
			<p><label for="' . $this->get_field_id( 'img_title' ) . '">' .  esc_html__( 'Image title:', 'er' ) . ' <a href="http://support.wordpress.com/widgets/image-widget/#image-widget-title" target="_blank">( ? )</a>
			<input class="widefat" id="' . $this->get_field_id( 'img_title' ) . '" name="' . $this->get_field_name( 'img_title' ) . '" type="text" value="' . $img_title . '" />
			</label></p>
			<p><label for="' . $this->get_field_id( '_caption' ) . '">' . esc_html__( 'Caption:', 'er' ) . ' <a href="http://support.wordpress.com/widgets/image-widget/#image-widget-caption" target="_blank">( ? )</a>
			<textarea class="widefat" id="' . $this->get_field_id( 'caption' ) . '" name="' . $this->get_field_name( 'caption' ) . '" rows="2" cols="20">' . $caption . '</textarea> 
			</label></p>';
		$alignments = array(
			'none'   => __( 'None', 'er' ),
			'left'   => __( 'Left', 'er' ),
			'center' => __( 'Center', 'er' ),
			'right'  => __( 'Right', 'er' ),
		);
		echo '<p><label for="' . $this->get_field_id( 'align' ) . '">' .  esc_html__( 'Image Alignment:', 'er' ) . '
			<select id="' . $this->get_field_id( 'align' ) . '" name="' . $this->get_field_name( 'align' ) . '">';
		foreach ( $alignments as $alignment => $alignment_name ) {
			echo  '<option value="' . esc_attr( $alignment ) . '" ';
			if ( $alignment == $align )
				echo 'selected="selected" ';
			echo '>' . esc_html($alignment_name) . "</option>\n";
		}
		echo '</select></label></p>';
		echo '<p><label for="' .  $this->get_field_id( 'img_width' ) . '">' . esc_html__( 'Width:', 'er' ) . '
		<input size="3" id="' .  $this->get_field_id( 'img_width' ) . '" name="' . $this->get_field_name( 'img_width' ) . '" type="text" value="' .  $img_width . '" />
		</label>
		<label for="' . $this->get_field_id( 'img_height' ) . '">' . esc_html__( 'Height:', 'er' ) . '
		<input size="3" id="' . $this->get_field_id( 'img_height' ) . '" name="' . $this->get_field_name( 'img_height' ) . '" type="text" value="' . $img_height . '" />
		</label><br />
		<small>' . esc_html__( "If empty, we will attempt to determine the image size.", 'er' ) . '</small></p>
		<p><label for="' . $this->get_field_id( 'link' ) . '">' . esc_html__( 'Link URL (when the image is clicked):', 'er' ) . '
		<input class="widefat" id="' . $this->get_field_id( 'link' ) . '" name="' . $this->get_field_name( 'link' ) . '" type="text" value="' . $link . '" />
		</label></p>';
	}
}
function er_image_widget_init() {
	register_widget( 'er_Image_Widget' );
}
add_action( 'widgets_init', 'er_image_widget_init' );

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

add_action( 'dashboard_glance_items', 'my_add_cpt_to_dashboard' );

function my_add_cpt_to_dashboard() {
	$showTaxonomies = 1;
	if ($showTaxonomies) {
		$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			$num_terms  = wp_count_terms( $taxonomy->name );
			$num = number_format_i18n( $num_terms );
			$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
			$associated_post_type = $taxonomy->object_type;
			if ( current_user_can( 'manage_categories' ) ) {
			  $output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . ' ' . $text .'</a>';
			}
			echo '<li class="taxonomy-count">' . $output . ' </li>';
		}
	}
	// Custom post types counts
	$post_types = get_post_types( array( '_builtin' => false ), 'objects' );
	foreach ( $post_types as $post_type ) {
		if($post_type->show_in_menu==false) {
			continue;
		}
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
		if ( current_user_can( 'edit_posts' ) ) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
		}
		echo '<li class="page-count ' . $post_type->name . '-count">' . $output . '</td>';
	}
}

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[10][0] = 'Uploads';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

function add_menu_icons_styles(){
 
echo '<style>
#adminmenu .menu-icon-speaker div.wp-menu-image:before {
	content: "\f488";
}
#adminmenu .menu-icon-issue div.wp-menu-image:before {
	content: "\f331";
}
#adminmenu .menu-icon-contacts div.wp-menu-image:before {
	content: "\f336";
}
#adminmenu .menu-icon-ethicalrecord div.wp-menu-image:before {
	content: "\f464";
}
#dashboard_right_now .speaker-count a:before {
    content: "\f488";
}
#dashboard_right_now .issue-count a:before {
    content: "\f331";
}
#dashboard_right_now .taxonomy-count a:before {
    content: "\f325";
}
#dashboard_right_now .feedback-count a:before {
    content: "\f466";
}
#dashboard_right_now .ethicalrecord-count a:before {
    content: "\f464";
}
</style>';

}
add_action( 'admin_head', 'add_menu_icons_styles' );

function additional_admin_color_schemes() {  
	$theme_dir = get_template_directory_uri();  
	wp_admin_css_color( 'er', __( 'Ethical Record' ),  
		$theme_dir . '/css/er_admin.css',  
		array( '#ebebeb', '#ebf3f4', '#136972', '#ffffff' )  
	);  
}  
add_action('admin_init', 'additional_admin_color_schemes');

function remove_footer_admin () {
	echo '&copy; 1793 - '. date('Y') . ' Ethical Record/Conway Hall. Site built by <a href="https://www.facebook.com/Marks.Portfolio">Mark Duwe</a>.';
	echo '<style>#wp-admin-bar-updates,.update-plugins{display:none !important;}.category-adder {display: none !important;}</style>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function rdc_add_views_column( $cols ) {
	$cols['pageviews'] = 'Views';
	return $cols;
}
add_filter( 'manage_edit-post_columns', 'rdc_add_views_column' );
  
function rdc_add_views_colurdc_data( $colname ) {
	global $post;
	if ( 'pageviews' !== $colname )
		return false;
	if ( ! ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'stats' ) ) ) {
		echo 'Error 101';
		return false;
	}
	if ( ! function_exists( 'stats_get_csv' ) ) {
		echo 'Error 102';
		return false;
	}
	$view_count = get_post_meta( $post->ID, '_jetpack_post_views_count', true );
	$view_count_created = absint( get_post_meta( $post->ID, '_jetpack_post_views_count_created', true ) );
	if ( ! $view_count || time() > $view_count_created + 3600 ) {
		$postviews = stats_get_csv( 'postviews', "post_id={$post->ID}" );
		if ( ! $postviews ) {
			echo 'Error 103';
			return false;
		}
		update_post_meta( $post->ID, '_jetpack_post_views_count', absint( $postviews[0]['views'] ) );
		update_post_meta( $post->ID, '_jetpack_post_views_count_created', absint( time() ) );
	}
	echo '<strong>' . number_format( absint( $postviews[0]['views'] ) ) . '</strong>';
}
add_action( 'manage_posts_custom_column', 'rdc_add_views_colurdc_data' );

add_action('rss2_item', function(){
  global $post;

  $output = '';
  $thumbnail_ID = get_post_thumbnail_id( $post->ID );
  $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'featured');
  $output .= '<thumbnail>' . $thumbnail[0] . '</thumbnail>';

  echo $output;
});
