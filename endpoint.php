<?php

	function endpoint(){
		add_rewrite_tag( '%movies%', '([^&]+)' );
		add_rewrite_rule( '/movies/movies.json', 'index.php?movies=all', 'top' );
	}

	function endpoint_data() {
 
	    global $wp_query;
	 
	    $movies_tag = $wp_query->get( 'movies' );
	 
	    if ( ! $movies_tag ) {
	        return;
	    }
	 
	    $movies_data = array();
	 
	    $args = array(
	        'post_type'      => 'movies',
	        'posts_per_page' => 100,
	    );
	    $movies_query = new WP_Query( $args );
	    if ( $movies_query->have_posts() ) : while ( $movies_query->have_posts() ) : $movies_query->the_post();
	        // $img_id = get_post_thumbnail_id();
	        // $img = wp_get_attachment_image_src( $img_id, 'full' );
	         $movies_data[data][] = array(
	         	 'id' => get_the_ID(),
	             'title' => get_the_title(),
	             'poster_url' => get_post_meta(get_the_ID(), "_poster_url", true),
	             'rating' => get_post_meta(get_the_ID(), "_rate", true),
	             'year' => get_post_meta(get_the_ID(), "_year", true),
	             'short_description' => get_post_meta(get_the_ID(), "_short_desc", true)
	         );
	    endwhile; wp_reset_postdata(); endif;
	 
	    wp_send_json( $movies_data  );
 
	}
	add_action( 'template_redirect', 'endpoint_data' );
	add_action( 'init', 'endpoint' );


?>