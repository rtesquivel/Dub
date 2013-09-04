<?php

namespace Duarte\Process;

class Theme
{
	public function init(){

		register_nav_menu('primary', 'Main Menu');
		register_nav_menu('apps', 'Apps Menu');
		// template redirect for top level pages and for child pages

		add_filter('comment_form_default_fields', '\Duarte\Process\Theme::url_filtered');
		add_filter('icon_dir', '\Duarte\Process\Theme::icon_dir');
		add_filter('icon_dir_uri', '\Duarte\Process\Theme::icon_dir_uri');

		// kill widgets that arent used in this theme
		add_action( 'widgets_init', '\Duarte\Process\Theme::kill_widgets' );
		add_editor_style('editor.css');

		

		register_post_type('people',
			array(
				'labels' => array(
					'name'               => "People",
					'singular_name'      => "Person",
					'menu_name'          => "People",
					'all_items'          => "People",
					'add_new'            => "Add New",
					'add_new_item'       => "Add New Person",
					'edit_item'          => "Edit Person",
				    'new_item'           => "New Person",
				    'all_items'          => "People",
				    'view_item'          => "View Person",
				    'search_items'       => "Search People",
				    'not_found'          => "No people found",
				    'not_found_in_trash' => "No people found in Trash", 
				    'parent_item_colon'  => ""
				),
				'description'         => "Duarte People",
				'public'              => true,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'menu_position'       => 20,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'capability_type'     => 'post',
				'rewrite'             => array('slug' => 'people', 'with_front'=> false),
				'hierarchical'        => false,
				'supports'            => array('title','editor','thumbnail')
			)
		);

		add_filter('edit_people_per_page', function(){
			return 300;
		});

		register_post_type('teams',
			array(
				'labels' => array(
					'name'               => "Teams",
					'singular_name'      => "Team",
					'menu_name'          => "Teams",
					'all_items'          => "Teams",
					'add_new'            => "Add New",
					'add_new_item'       => "Add New Team",
					'edit_item'          => "Edit Team",
				    'new_item'           => "New Team",
				    'all_items'          => "Teams",
				    'view_item'          => "View Team",
				    'search_items'       => "Search Teams",
				    'not_found'          => "Team not found",
				    'not_found_in_trash' => "Team not found in Trash", 
				    'parent_item_colon'  => ""
				),
				'description'         => "Duarte Team",
				'public'              => true,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'menu_position'       => 20,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'capability_type'     => 'post',
				'rewrite'             => array('slug' => 'teams', 'with_front'=> false),
				'hierarchical'        => false,
				'supports'            => array('title','editor','thumbnail')
			)
		);

		register_post_type('rooms',
			array(
				'labels' => array(
					'name'               => "Rooms",
					'singular_name'      => "Room",
					'menu_name'          => "Rooms",
					'all_items'          => "Rooms",
					'add_new'            => "Add New",
					'add_new_item'       => "Add New Room",
					'edit_item'          => "Edit Room",
				    'new_item'           => "New Room",
				    'all_items'          => "Rooms",
				    'view_item'          => "View Room",
				    'search_items'       => "Search Rooms",
				    'not_found'          => "Room not found",
				    'not_found_in_trash' => "Room not found in Trash", 
				    'parent_item_colon'  => ""
				),
				'description'         => "Duarte Room",
				'public'              => true,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'menu_position'       => 20,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'capability_type'     => 'post',
				'rewrite'             => array('slug' => 'rooms', 'with_front'=> false),
				'hierarchical'        => false,
				'supports'            => array('title','editor','thumbnail')
			)
		);

		register_post_type('printers',
			array(
				'labels' => array(
					'name'               => "Printers",
					'singular_name'      => "Printer",
					'menu_name'          => "Printers",
					'all_items'          => "Printers",
					'add_new'            => "Add New",
					'add_new_item'       => "Add New Printer",
					'edit_item'          => "Edit Printer",
				    'new_item'           => "New Printer",
				    'all_items'          => "Printers",
				    'view_item'          => "View Printer",
				    'search_items'       => "Search Printers",
				    'not_found'          => "Printer not found",
				    'not_found_in_trash' => "Printer not found in Trash", 
				    'parent_item_colon'  => ""
				),
				'description'         => "Duarte Printer",
				'public'              => true,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'menu_position'       => 20,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'capability_type'     => 'post',
				'rewrite'             => array('slug' => 'printers', 'with_front'=> false),
				'hierarchical'        => false,
				'supports'            => array('title','editor','thumbnail')
			)
		);

		
	}

	public function styles(){

		// wp_enqueue_script('jloupe', get_stylesheet_directory_uri(). "/jquery.jloupe.js", array('duarte-vogue'));

		// Load Vogue
		switch(ENVIRONMENT){
			case 'vagrant':
			case 'labs': 
				wp_enqueue_style('duarte-vogue', "http://vogue.labs.duarte.com/duarte.css");
				wp_enqueue_script('duarte-vogue', "http://vogue.labs.duarte.com/duarte.js");

				break;

			default:
				wp_enqueue_style('duarte-vogue', "https://s3-us-west-1.amazonaws.com/com.duarte.vogue/duarte.css");
				wp_enqueue_script('duarte-vogue', "https://s3-us-west-1.amazonaws.com/com.duarte.vogue/duarte.js");
				break;
		}
		wp_enqueue_style('process-style', get_stylesheet_uri()."?".rand(1000,9999) );
		wp_enqueue_script('underscore', get_stylesheet_directory_uri() ."/underscore-min.js");
		wp_enqueue_script('process-scripts', get_stylesheet_directory_uri() ."/scripts.js");
	}

	public function kill_widgets(){
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
	}

	public function icon_dir($dir){
		return  get_stylesheet_directory() ."/img/icons";

	}

	public function icon_dir_uri($uri){
		return  get_stylesheet_directory_uri() ."/img/icons";

	}

	public function template_redirect(){
		global $post, $wp_query;

		// the post will be set if a search is successful since it is primed for the loop
		// this checks if the search query is set and if it is, avoids the template redirect 
		if(array_key_exists('s', $wp_query->query_vars) and $wp_query->query_vars['s'] != ''){
			return;
		}
		if( $post && ( $post->post_type == 'studio' || $post->post_type == 'factory' )){
			// check if a parent
			if($post->post_parent == 0){
				$tpl = locate_template(array('phase.php'), true);
				exit;
			}
			else {
				$tpl = locate_template(array('step.php'), true);
				exit;
			}
		}
		else {
			return;
		}
	}


	public function comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback' :
			case 'trackback' :
				break;
			default :
				global $post; 
		?>
				<div class="row comment-block" id="comment-<?php comment_ID(); ?>">
					
						<div class="comment-meta comment-author vcard three columns">
							<?php
								// echo get_avatar( $comment, 44 );
								printf('<h5 class="fn">%1$s</h5>', get_comment_author_link());

								printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s', 'twentytwelve' ), get_comment_date() )
								);
							?>
						</div><!-- .comment-meta -->				

						<div class="comment-content comment nine columns">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
							<?php endif; ?>

							<?php comment_text(); ?>
							<?php //edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>

							<div class="reply">

							<?php
							

							//comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
							?>
							</div><!-- .reply -->
						</div><!-- .comment-content -->
				</div>

		<?php		
				break;
		}
	}

	public function url_filtered($fields) {
		if(isset($fields['url']))
			unset($fields['url']);
		return $fields;
	}

	// Filter to adjust wp_nav_menu auto highlighting for custom post types
	public function customize_menu($classes = array(), $item = false){		
	    // Force the Portfolio to highlight for portfolio post types
	    if( in_array(get_post_type(), array('studio')) && $item->title == 'Studio'){
	    	$classes[] = 'current_page_parent';
	    }

	    // Force the About to highlight for job and staff post types
	    if( in_array(get_post_type(), array('factory')) && $item->title == 'Factory'){
	    	$classes[] = 'current_page_parent';
	    }
	    return $classes;
	}

	public function editor_insert_formats($init_array){
		$style_formats = array(  
			// Each array child is a format with it's own settings
			array(
				'title' => 'Caption',
				'block' => 'p',
				'classes' => 'caption',
				'wrapper' => false
			),
			array(
				'title' => 'Quote Callout',
				'block' => 'q',
				'classes' => 'quote-callout',
				'wrapper' => false
			),			
			array(
				'title' => 'H2 Thin',
				'block' => 'h2',
				'classes' => 'thin',
				'wrapper' => false
			),
			array(
				'title' => 'H3 Thin',
				'block' => 'h3',
				'classes' => 'thin',
				'wrapper' => false
			),
			array(
				'title' => 'H4 Thin',
				'block' => 'h4',
				'classes' => 'thin',
				'wrapper' => false
			),
			array(
				'title' => 'Citation',
				'block' => 'cite',
				'wrapper' => false
			),
			array(  
				'title' => 'Button',  
				'selector' => 'a',  
				'classes' => 'button black'
			),
			array(  
				'title' => 'Button Next',  
				'selector' => 'a',  
				'classes' => 'button black next'
			),
			array(  
				'title' => 'Button Prev',  
				'selector' => 'a',  
				'classes' => 'button black prev'
			),
			array(  
				'title' => 'Button Up',  
				'selector' => 'a',  
				'classes' => 'button black up'
			),
			array(  
				'title' => 'Button down',  
				'selector' => 'a',  
				'classes' => 'button black down'
			),
			array(  
				'title' => 'Row',  
				'block' => 'div',  
				'classes' => 'row',
				'wrapper' => true,
			),
			array(  
				'title' => 'Two Columns',  
				'block' => 'div',  
				'classes' => 'two columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Three Columns',  
				'block' => 'div',  
				'classes' => 'three columns',
				'wrapper' => true,
			), 
			array(  
				'title' => 'Four Columns',  
				'block' => 'div',  
				'classes' => 'four columns',
				'wrapper' => true,
			), 
			array(  
				'title' => 'Five Columns',  
				'block' => 'div',  
				'classes' => 'five columns',
				'wrapper' => true,
			), 
			array(  
				'title' => 'Six Columns',  
				'block' => 'div',  
				'classes' => 'six columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Seven Columns',  
				'block' => 'div',  
				'classes' => 'seven columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Eight Columns',  
				'block' => 'div',  
				'classes' => 'Eight columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Nine Columns',  
				'block' => 'div',  
				'classes' => 'nine columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Ten Columns',  
				'block' => 'div',  
				'classes' => 'Ten columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Eleven Columns',  
				'block' => 'div',  
				'classes' => 'eleven columns',
				'wrapper' => true,
			),
			array(  
				'title' => 'Twelve Columns',  
				'block' => 'div',  
				'classes' => 'twelve columns',
				'wrapper' => true,
			)
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array; 
	}

	public function enable_styleselect( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	public function watch_post_save( $post_id ){
		error_log("post saved with id $post_id", 0);
		if(get_post_type($post_id) == "people"){
			if(isset($_POST['fields'])) {
				// pluck the url of the bio page
				$url = $_POST['fields']['field_51ef22f30a692'];

				if($url != ""){
					// get the page
					$bio_page = file_get_contents( $url );
					$doc = new \DOMDocument;

					// prevent warnings for HTML5
					libxml_use_internal_errors(true);

					// process document
					$doc->loadHTML( $bio_page );

					// find all image tags on page					
					$images = $doc->getElementsByTagName('img');
					
					// on this page the only images seem to be the photos
					// pick the first one and get the source
					$photo = $images->item(0)->getAttribute("src");
									
					// inject into the post to save the field
					$_POST['fields']['field_peoplbiophoto'] = $photo;

					error_log($photo, 0);

					libxml_clear_errors();
				} else {
					$_POST['fields']['field_peoplbiophoto'] = get_stylesheet_directory_uri() ."/img/bioPhotoPlaceholder.jpg";
				}
				// skip if no url was supplied
			}
		}		
	}
}


add_action('after_setup_theme', "Duarte\Process\Theme::init");
add_action('wp_enqueue_scripts', "Duarte\Process\Theme::styles");
add_action('template_redirect', "Duarte\Process\Theme::template_redirect");

add_action('acf/save_post', 'Duarte\Process\Theme::watch_post_save', 1);

add_filter('nav_menu_css_class', "Duarte\Process\Theme::customize_menu", 10, 2);

add_filter('tiny_mce_before_init', "Duarte\Process\Theme::editor_insert_formats");
add_filter('mce_buttons_2', "Duarte\Process\Theme::enable_styleselect");

function is_studio() {
	global $post;
	if(is_object($post))
		return ($post->post_type == 'studio');
	else return false;
}

function is_factory() {
	global $post;
	if(is_object($post))
		return ($post->post_type == 'factory');
	else return false;
}

function get_all($type) {
	if($type == 'studio'){
		$args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order',
			'hierarchical' => 0,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => 0,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'studio',
			'post_status' => 'publish'
		); 
		return get_pages($args);
	}
	elseif($type == 'factory') {
		$args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order',
			'hierarchical' => 0,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => 0,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'factory',
			'post_status' => 'publish'
		); 
		return get_pages($args); 
	}
}

function time_elapsed_string($ptime) {
    $etime = time() - $ptime;
    
    if ($etime < 1) {
        return '0 seconds';
    }
    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '');
        }
    }
}

include "_fields/people.php";
include "_fields/printers.php";
include "_fields/rooms.php";
include "_fields/teams.php";


