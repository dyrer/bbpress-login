<?php
/**
 * Plugin Name: Login bbPress
 * Plugin URI:  http://athanasiadis.me
 * Description: Add bbPress login, register, links on forum pages or topic pages so users can use our forums more easier.
 * Author:      Athanasiadis Evagelos
 * Author URI:  http://athanasiadis.me
 * Version:     0.1
 * Domain Path: /languages
 * Text Domain: bbpress-login
 * License: GPLv2
 */

 /* Search for translations */
if (!load_plugin_textdomain('bbpress-login', false, dirname(plugin_basename(__FILE__)) . '/../../languages/')) {
  load_plugin_textdomain('bbpress-login', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

register_activation_hook(__FILE__,'bbpress_login_install');

function bbpress_login_install() {
	if(!class_exists('bbPress')) {
	  deactivate_plugins(plugin_basename(__FILE__));
				wp_die( __('Sorry, you need to activate bbPress first.', 'bbpress-login'));
	  }

}

//Styling plugin

	function bbpress_login_css() {
  wp_enqueue_style('bbpress-style',
					   plugins_url('bbpress-login.css', __FILE__));
}

add_action('wp_enqueue_scripts','bbpress_login_css');

function bbpress_Login_main() {
  echo '<div class="bbpressloginlinks">';
	if ( !is_user_logged_in() )
	{
		$login_url = site_url( 'wp-login.php' );
		echo "<a href='$login_url'>".__('Log In').'</a> ';
		
		echo "<a href='<?php site_url( 'wp-login.php?action=register' ); class='bbpressloginlinks' ?>".__('Register').'</a> ';

		echo "<a href='<?php site_url( 'wp-login.php?action=lostpassword' ); class='bbpressloginlinks' ?>".__('Lost Password').'</a> ';

}

else {
		$logout_url = wp_logout_url( get_permalink() );
		echo "<a href='$logout_url' class='bbpressloginlinks'>".__('Log Out').'</a> ';

}

echo '</div>'; // class of "bbpressloginlinks"
}

add_action('bbp_template_after_forums_loop','bbpress_Login_main');
add_action('bbp_template_before_pagination_loop','bbpress_Login_main');
add_action('bbp_template_after_single_forum','bbpress_Login_main');
add_action('bbp_template_before_forums_loop','bbpress_Login_main');