<?php
/*
* Plugin Name: WordPress ShortCode
* Description: Create your WordPress shortcode for Underpants Theme telphone number. Set in Appearance > Customise > Display Options.
* Version: 1.0
* Author: Mark Inns
* Author URI: https://markinns.com
*/

//Add custom shortcode to display a set telephone number on page or post.
function wp_telephone_shortcode(){
	return get_theme_mod( 'tcx_telephone_number_text', 'You need to set a number in Wordpress Appearance > Customise > Display Options' );
}
add_shortcode('telephone', 'wp_telephone_shortcode');

?>