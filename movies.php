<?php 
    /*
    Plugin Name: Moxie Movies
    Plugin URI: http://www.bamaja.com.mx
    Description: Plugin for displaying movies
    Author: Aldo Barrera
    Version: 1.0
    Author URI: http://www.github.com/aldo86
    */

    // If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}


    function moxmov_admin_actions() {
 		add_options_page("Moxie Movies", "Moxie Movies", 1, "Moxie Movies", "moxmov_admin");
	}

	function moxmov_admin() {
    	include('moxie_import_admin.php');
	}

	// Movies custom post type function

	function custom_post_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Movies' ),
			'singular_name'       => _x( 'Movie' ),
			'menu_name'           => __( 'Movies' ),
			'all_items'           => __( 'All Movies'),
			'view_item'           => __( 'View Movie' ),
			'add_new_item'        => __( 'Add New Movie' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Movie' ),
			'update_item'         => __( 'Update Movie' ),
			'search_items'        => __( 'Search Movie' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);
		
	// Set other options for Custom Post Type
		
		$args = array(
			'label'               => __( 'movies' ),
			'description'         => __( 'List of Movies and rates'),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
			'taxonomies'          => array( 'genres' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		
		register_post_type( 'movies', $args );

	}
	/* Meta data
	*/

	function movie_poster_box() {
	    add_meta_box( 
	        'movie_poster_box',
	        __( 'Poster'),
	        'poster_box_content',
	        'movies',
	        'side',
	        'high'
	    );
	}

	function list_moxie_movies(){
		try {
			//echo "Entro";
		    $json_feed_url = 'http://localhost/wp-plugin/movies.json';
			$json_feed = wp_remote_get( $json_feed_url );
			$output = json_decode( "'".$json_feed."'" ); 
			$response = wp_remote_retrieve_body( $json_feed );
			// Decode the json
			
			//$movies = json_decode($json_feed['data']);
			
			echo "". $output;
		} catch (Exception $e) {
		    echo "Caught exception: " . $e->getMessage() . "\n";
		}
		 
	}

	/* 
	* Hooks to functions
	*/

	add_action( 'init', 'custom_post_type', 0 );

	add_action( 'add_meta_boxes', 'movie_poster_box' );
	
	add_action('admin_menu', 'moxmov_admin_actions');

	add_shortcode('list-movies', 'list_moxie_movies');

	

	class WP_Movies {
 
	    protected static $instance = null;
	 
	    private function __construct() {
	 		
	    }
	 
	}


?>