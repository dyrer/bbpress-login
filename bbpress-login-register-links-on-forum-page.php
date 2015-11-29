<?php
/**
 * Plugin Name: Bbpress Login Register Links On Forum Topic Pages
 * Plugin URI:  http://athanasiadis.me
 * Description: Add bbpress login link, register links, on forum pages or topic pages so users can use our forums more easier.
 * Author:      Athanasiadis Evagelos
 * Author URI:  http://athanasiadis.me
 * Version:     0.1
 */

register_activation_hook(__FILE__,'bbpress_login_install');

function bbpress_login_install() {
	//do Checks

	if( version_compare(get_bloginfo('version'),'4.5','<'))
			{
		deactivate_plugins(basename(__FILE__)); //Deactivate plugin
			}
		if(!class_exists('bbPress'))
			{
			deactivate_plugins(plugin_basename(__FILE__));
			wp_die( __('Sorry, you need to activate bbPress first.', 'bbpress_notify'));
			}

	}


function bbpressLoginRegisterLinksOnForumPage()
{
	echo '<div class="bbpressloginlinks" style="float:right;padding-right:20px;">';
	if ( !is_user_logged_in() )
	{
		$login_url = site_url( 'wp-login.php' );
		echo "<a href='$login_url'>".' Log In '.'</a> ';

		$register_url = site_url( 'wp-login.php?action=register' );
		echo " <a href='$register_url' style='margin-left:20px;'>".' Register '.'</a> ';

		$lost_password_url = site_url( 'wp-login.php?action=lostpassword' );
		echo " <a href='$lost_password_url' style='margin-left:20px;'>".' Lost Password '.'</a> ';
	}
	else
	{
		$logout_url = wp_logout_url( get_permalink() );
		echo "<a href='$logout_url'>".' Log Out'.'</a> ';
	}
	echo '</div>'; // class of "bbpressloginlinks"
}
add_action('bbp_template_after_forums_loop','bbpressLoginRegisterLinksOnForumPage');
add_action('bbp_template_before_pagination_loop','bbpressLoginRegisterLinksOnForumPage');
add_action('bbp_template_after_single_forum','bbpressLoginRegisterLinksOnForumPage');
add_action('bbp_template_before_forums_loop','bbpressLoginRegisterLinksOnForumPage');
?>
