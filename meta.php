<?php



function poster_box_content() {
	// Noncename needed to verify where the data originated
	global $post;
	echo '<input type="hidden" name="meta_noncename" id="meta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	// Get the url data if its already been entered
	$poster_url = get_post_meta($post->ID, '_poster_url', true);
	
	// Echo out the field
	echo '<input type="text" name="_poster_url" value="' . $poster_url  . '" class="widefat" />';

}

function desc_box_content() {
	global $post;
	// Get the description if its already been entered
	$desc = get_post_meta($post->ID, '_short_desc', true);
	
	// Echo out the field
	echo '<input type="text" name="_short_desc" value="' . $desc  . '" class="widefat" />';

}

function year_box_content() {
	global $post;
	// Get the description if its already been entered
	$year = get_post_meta($post->ID, '_year', true);
	
	// Echo out the field
	echo '<input type="text" name="_year" value="' . $year  . '" class="widefat" />';

}

function rating_box_content() {
	global $post;
	// Get the description if its already been entered
	$rate = get_post_meta($post->ID, '_rate', true);
	
	// Echo out the field
	echo '<input type="text" name="_rate" value="' . $rate  . '" class="widefat" />';

}

function save_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	if ( !wp_verify_nonce( $_POST['meta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// Get post data
	
	$movies_meta['_poster_url'] = $_POST['_poster_url'];
	$movies_meta['_short_desc'] = $_POST['_short_desc'];
	$movies_meta['_year'] = $_POST['_year'];
	$movies_meta['_rate'] = $_POST['_rate'];
	
	// Add values of $movies_meta as custom fields
	
	foreach ($movies_meta as $key => $value) { 
		// Don't store custom data twice
		if( $post->post_type == 'revision' ) return; 
		
		// If the custom field already has a value
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 									

			// If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		// Delete if blank
		if(!$value) delete_post_meta($post->ID, $key); 
	}

}
// save hook
add_action('save_post', 'save_meta', 1, 2); 

?>