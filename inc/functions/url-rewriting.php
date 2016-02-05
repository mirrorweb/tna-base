<?php

// Make styles and scripts paths relative
add_filter( 'script_loader_src', 'tna_styles_scripts_relative' );
add_filter( 'style_loader_src', 'tna_styles_scripts_relative' );
function tna_styles_scripts_relative( $url ) {
    return str_replace( site_url(), '', $url );
}
// Make template URLs relative
function make_path_relative( $url ) {
    global $pre_path;
    return str_replace( site_url(), $pre_path, $url );
}
// Fix URLs in wp_head
function tna_wp_head() {
    ob_start();
    wp_head();
    $wp_head = ob_get_contents();
    ob_end_clean();
    global $pre_path;
    $wp_head = str_replace( site_url(), 'http://www.nationalarchives.gov.uk' . $pre_path, $wp_head );
    echo $wp_head;
}

// Breadcrumb and url path variables (to be added to child theme)
function tnatheme_globals() {
	global $pre_path;
	global $pre_crumbs;
	$pre_crumbs = array(
		'About us' => '/about/',
		'Our role' => '/about/our-role/'
	);
	if (substr($_SERVER['REMOTE_ADDR'], 0, 3) === '10.') {
		$pre_path = '';
	} else {
		$pre_path = '/about';
	}
}
tnatheme_globals();