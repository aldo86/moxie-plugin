<?php



add_action( 'wp_footer', 'my_scripts' );

echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';	
function my_scripts() {


	wp_register_style('materialize',  plugins_url('materialize.min.css', __FILE__));
	wp_register_script('materializejs',  plugins_url('materialize.min.js', __FILE__));
	

	wp_enqueue_style(
		'materialize',
		plugins_url('materialize.min.css', __FILE__)
	);
	wp_enqueue_script(
		'materializejs',
		plugins_url('materialize.min.js', __FILE__)
	);
}
?>