<?php
/**
 * Plugin Name: plugin-name
 * Plugin URI: https://github.com/wixaw/
 * Description: 
 * Version: 1.0
 * Author: William VINCENT -  William.Vincent@IRIT.fr 
 * Author URI: https://github.com/wixaw/
 * License: GPLv2
 */

 
if ( !isset( $_POST['action'] ) ) {
    echo '0';
    exit;
}


$obj = new stdClass();
$obj->slug = 'plugin-base.php';  
$obj->name = 'PluginName';
$obj->plugin_name = 'plugin-base.php';
$obj->new_version = '1.0.0';
// the url for the plugin homepage
$obj->url = 'https://wp.domain.fr/plugin-name/';
//the download location for the plugin zip file (can be any internet host)
$obj->package = 'https://wp.domain.fr/plugin-name/plugin.zip';
switch ( $_POST['action'] ) {
case 'version':  
    echo serialize( $obj );
    break;  
case 'info':   
    $obj->requires = '5.0';  
    $obj->tested = '5.3';  
    $obj->downloaded = 1;  
    $obj->last_updated = '2020-01-01';  
    $obj->sections = array( 
        'Changelog' => '<ul>
                            <li>
                                1.0.0: ...<br/>....
                            </li>
                            <li>
                                0.1.2: ...
                            </li>
                            <li>
                                0.1.1: ...
                            </li>
                        </ul>'
    );
    $obj->download_link = $obj->package;  
    echo serialize($obj);  
case 'license':  
    echo serialize( $obj );  
    break;  
}  
?>
