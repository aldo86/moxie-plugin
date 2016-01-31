<?php

global $post;

function poster_box_content() {
	
	
	// Get the url data if its already been entered
	$poster_url = get_post_meta($post->ID, '_poster_url', true);
	
	// Echo out the field
	echo '<input type="text" name="_poster_url" value="' . $poster_url  . '" class="widefat" />';

}

function desc_box_content() {
	
	// Get the description if its already been entered
	$desc = get_post_meta($post->ID, '_short_desc', true);
	
	// Echo out the field
	echo '<input type="text" name="_short_desc" value="' . $desc  . '" class="widefat" />';

}

function year_box_content() {
	
	// Get the description if its already been entered
	$year = get_post_meta($post->ID, '_year', true);
	
	// Echo out the field
	echo '<input type="text" name="_year" value="' . $year  . '" class="widefat" />';

}

function rating_box_content() {
	
	// Get the description if its already been entered
	$rate = get_post_meta($post->ID, '_rate', true);
	
	// Echo out the field
	echo '<input type="text" name="_rate" value="' . $rate  . '" class="widefat" />';

}

?>