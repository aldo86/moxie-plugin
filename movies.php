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
			'supports'            => array( 'title', 'poster_url', 'rating', 'year', 'description'),
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
			'register_meta_box_cb' => 'add_events_metaboxes'

		);
		
		register_post_type( 'movies', $args );

	}

	/* Add meta data boxes
	*/

	function movie_poster_box() {
	    add_meta_box( 
	        'movie_poster_box',
	        __( 'Poster URL'),
	        'poster_box_content',
	        'movies',
	        'normal',
	        'low'
	    );
	}


	function movie_rating_box() {
	    add_meta_box( 
	        'movie_rating_box',
	        __( 'Rating'),
	        'rating_box_content',
	        'movies',
	        'side',
	        'default'
	    );
	}

	function movie_year_box() {
	    add_meta_box( 
	        'movie_year_box',
	        __( 'Year'),
	        'year_box_content',
	        'movies',
	        'side',
	        'low'
	    );
	}

	function movie_desc_box() {
	    add_meta_box( 
	        'movie_desc_box',
	        __( 'Short Description'),
	        'desc_box_content',
	        'movies',
	        'normal',
	        'high'
	    );
	}


	//Shortcode function

	function list_moxie_movies(){
		//Register Materialize plugin
		include('scripts.php');
		try {

			//Get json from endpoint and parse it
		    $json_feed_url = 'http://localhost/wp-plugin/movies/movies.json';
			$json_feed = wp_remote_get( $json_feed_url );
			$response = wp_remote_retrieve_body( $json_feed );			
			$movies = json_decode($response);

			//Output html with Movies data to frontend
			echo '<div class="row">';

			foreach ($movies->data as $item) {
				echo '<div class="col s4 m4">';
			  	echo '<div class="card">';
			   	echo '<div class="card-image">';
		       	echo '<img src="' . $item->poster_url .'" >';
		       	echo '<span class="card-title">' . $item->title . ' (' . $item->year . ')</span></div>';
		       	echo '<div class="card-content">';
		       	echo '<p>' . $item->short_description . '</p>';

		       	for ($x = 0; $x < $item->rating; $x++) {
				    echo '<i class="tiny material-icons">grade</i>';
				} 
		       	echo '</div>';
		       	echo '</div></div>';
			}
			if (empty($movies)) {
			   	echo '<div class="col s6 offset-s3">';
			  	echo '<div class="card">';		       	
		       	echo '<div class="card-content">';   	
		       	echo '<span class="card-title">There are no Movies on the database</span>';
		       	echo '<p>Please add some movies on admin panel!</p>';
		       	echo '</div>';
		       	echo '</div></div>';
			}
			
			echo '</div>';
			
			
		} catch (Exception $e) {
		    echo "Caught exception: " . $e->getMessage() . "\n";
		}
		 
	}



	/* 
	* Hooks to functions
	*/

	add_action( 'init', 'custom_post_type', 0 );

	add_action( 'add_meta_boxes', 'movie_poster_box' );
	add_action( 'add_meta_boxes', 'movie_desc_box' );
	add_action( 'add_meta_boxes', 'movie_year_box' );
	add_action( 'add_meta_boxes', 'movie_rating_box' );

	include('endpoint.php');
	include('meta.php');
	

	add_shortcode('list-movies', 'list_moxie_movies');



?>