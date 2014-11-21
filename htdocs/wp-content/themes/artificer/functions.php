<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', '80cpmgmo9pspi70ck31cwaapn47s7f6dh' );

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php'			// Theme installation
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/




function my_avatar($avatar) {
	return "<img alt='' src='/avatar/default.jpg' class='avatar avatar-64 photo' height='64' width='64' />";
     $tmp = strpos($avatar, 'http');
     $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
     $tmp = strpos($g, 'avatar/') + 7;
     $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
     $w = home_url(); // $w = get_bloginfo('url');
	error_log("====>ABSPATH:".ABSPATH."\n", 3, "/var/www/silkway/logs/php.log");

     // $e = preg_replace('/wordpress//', '', ABSPATH) .'avatar/'. $f .'.jpg';
	$e =  ABSPATH .'avatar/'. $f .'.jpg';
	error_log("====>gravatar:".$e."\n", 3, "/var/www/silkway/logs/php.log");
     $t = 129600; //设定15天, 单位:秒
     if ( empty($default) ) $default = $w. '/avatar/default.jpg';
     if ( !is_file($e) || (time() - filemtime($e)) > $t ) //当头像不存在或者文件超过15天才更新
         copy(htmlspecialchars_decode($g), $e);
     else
         $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));
     if (filesize($e) < 500) copy($default, $e);
	error_log("===>av:".$avatar."\n", 3, "/var/www/silkway/logs/php.log");
     return $avatar;
}
add_filter('get_avatar', 'my_avatar');



/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>