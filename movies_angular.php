<?php



add_action( 'wp_footer', 'my_scripts' );

function my_scripts() {
	
	wp_register_script('angularjs',  plugins_url('angular.min.js', __FILE__), array('jquery'),'1.1', true);
	wp_register_script('appjs',  plugins_url('app.js', __FILE__));
	
	wp_enqueue_script(
		'angularjs',
		plugins_url('angular.min.js', __FILE__)
	);
	wp_enqueue_script(
		'appjs'
	);
}
?>