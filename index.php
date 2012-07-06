<?php

/*
 * Plugin Name: Format Code
 * Plugin URI: http://aniketpant.com
 * Description: Saves quite some time for me
 * Version: 1.2
 * Author: Aniket Pant
 * Author URI: http://aniketpant.com
*/

/*
 * Runs when plugin is activated
 */
register_activation_hook(__FILE__, 'forcod_install'); 

/*
 * Runs when plugin is deactivated
 */
register_deactivation_hook(__FILE__, 'forcod_remove'); 

function forcod_install() {
    /* Creates new database field */
    add_option("forcod_settings", 'Default', '', 'yes');
}

function forcod_remove() {
    /* Deletes the database field */
    delete_option("forcod_settings");
}

function format_code($content) {
    $match = preg_match_all('/`.+\`/', $content, $matches);

    if($match)
    {  
        $theContent = preg_replace('/`(.+)\`/', '<span class="code">$1</span>', $content);
    }  

    else  
    {  
        $theContent = $content;  
    }   
    
    return $theContent; 
}

add_filter('the_content', 'format_code');

/*
 * Admin Options
 */

function forcod_admin() {
    include('forcod-admin-options.php');
}

function forcod_admin_actions() {
    add_options_page('Format Code', 'Format Code', 1, 'format-code', 'forcod_admin');
}

add_action('admin_menu', 'forcod_admin_actions');

/*
 * User Functions
 */
function forcod_get_details() {
    $forcod_settings = get_option('forcod_settings');
    return  $forcod_settings;
}

function forcod_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';
        
        $settings = forcod_get_details();
        $theme = $settings['theme'];
        $padding = $settings['padding'].'px';
        
        if ($theme == 'light') {
            echo "
            <style type='text/css'>
                span.code {
                    background: rgba(0, 0, 0, 0.05);
                    color: #666;
                    padding: 2px $padding;
                }
            </style>
            ";
        }
        else if ($theme == 'dark') {
            echo "
            <style type='text/css'>
                span.code {
                    background: rgba(0, 0, 0, 0.75);
                    color: #fff;
                    padding: 2px $padding;
                }
            </style>
            "; 
        }
}

add_action('wp_head', 'forcod_css');

?>