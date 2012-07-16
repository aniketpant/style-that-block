<?php

/*
 * Plugin Name: Style That Block
 * Plugin URI: http://aniketpant.com
 * Description: Saves quite some time for me
 * Version: 1.3
 * Author: Aniket Pant
 * Author URI: http://aniketpant.com
*/

/*
 * Runs when plugin is activated
 */
register_activation_hook(__FILE__, 'stb_install'); 

/*
 * Runs when plugin is deactivated
 */
register_deactivation_hook(__FILE__, 'stb_remove'); 

function stb_install() {
    /* Creates new database field */
    add_option("stb_settings", 'Default', '', 'yes');
}

function stb_remove() {
    /* Deletes the database field */
    delete_option("stb_settings");
}

function style_that_block($content) {
    $match = preg_match_all('/`.+\`/', $content, $matches);

    if($match)
    {  
        $theContent = preg_replace('/`(.+)\`/', '<span class="the-bloc">$1</span>', $content);
    }  

    else  
    {  
        $theContent = $content;  
    }   
    
    return $theContent; 
}

add_filter('the_content', 'style_that_block');

/*
 * Admin Options
 */

function stb_admin() {
    include('stb-admin-options.php');
}

function stb_admin_actions() {
    add_options_page('Style That Block', 'Style That Block', 1, 'style-that-block', 'stb_admin');
}

add_action('admin_menu', 'stb_admin_actions');

/*
 * User Functions
 */
function stb_get_details() {
    $stb_settings = get_option('stb_settings');
    return  $stb_settings;
}

function stb_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';
        
        $settings = stb_get_details();
        $theme = $settings['theme'];
        $padding = $settings['padding'].'px';
        
        if ($theme == 'light') {
            echo "
            <style type='text/css'>
                span.the-bloc {
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
                span.the-bloc {
                    background: rgba(0, 0, 0, 0.75);
                    color: #fff;
                    padding: 2px $padding;
                }
            </style>
            "; 
        }
        else if ($theme == 'awesome') {
            echo "
            <style type='text/css'>
                span.the-bloc {
                    background: rgba(0, 0, 0, 0.05);
                    color: #ff487f;
                    box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.25);
                    padding: 2px $padding;
                }
            </style>
            ";
        }
}

add_action('wp_head', 'stb_css');

?>