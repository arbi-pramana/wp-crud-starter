<?php

/*
  Plugin Name: Plugin by Arbi Pramana
  Description: This plugin is very easy for starter template to create CRUD in Wordpress
  Version: 1.0.0
  Author: Arbi Pramana
  Author URI: http://arbipram.com
*/
global $db_version;
$db_version = '1.0';

function db_install() {
    global $wpdb;
    global $db_version;

    $table_name = $wpdb->prefix . 'employee_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id bigint(9) NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'db_version', $db_version );
}
register_activation_hook( __FILE__, 'db_install' );
//adding in menu
add_action('admin_menu', 'employee_menu');

function employee_menu() {
    //adding plugin in menu
    add_menu_page('employee_list', //page title
        'Employees', //menu title
        'manage_options', //capabilities
        'employee-list', //menu slug
        'employee_list', //function
        plugin_dir_url( __FILE__ ) . 'images/menu.png', //icon
        2, //position menu
    );
    //adding submenu to a menu
    add_submenu_page('employee-list',//parent page slug
        'employee_create',//page title
        'Add New',//menu title
        'manage_options',//manage optios
        'employee-create',//slug
        'employee_create'//function
    );
    add_submenu_page( null,//parent page slug
        'employee_edit',//$page_title
        'Employee edit',// $menu_title
        'manage_options',// $capability
        'employee-edit',// $menu_slug,
        'employee_edit'// $function
    );
    add_submenu_page( null,//parent page slug
        'employee_delete',//$page_title
        'Employee Delete',// $menu_title
        'manage_options',// $capability
        'employee-delete',// $menu_slug,
        'employee_delete'// $function
    );
}


// returns the root directory path of particular plugin
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'employee_list.php');
require_once (ROOTDIR.'employee_create.php');
require_once (ROOTDIR.'employee_edit.php');
require_once (ROOTDIR.'employee_delete.php');
?>