<?php
if ( ! defined( 'ABSPATH' ) ) {
    // Call dirname() 4 times as this file is in '/wp-contents/plugins/plugin-dir/' and wp-config.php is in '/'
    require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/../wp-config.php';
}
global $wpdb;

$table_name = $wpdb->prefix . 'geo';

$result = $wpdb->get_results('SELECT * FROM ' . $table_name . ' ORDER BY id DESC');

echo json_encode($result);