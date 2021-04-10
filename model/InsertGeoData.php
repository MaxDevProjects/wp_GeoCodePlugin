<?php

/**
* insertion des données par method post puis get
* import du wp-config pour avoir accés à $wpdb
*/
if ( ! defined( 'ABSPATH' ) ) {
    // Call dirname() 4 times as this file is in '/wp-contents/plugins/plugin-dir/' and wp-config.php is in '/'
    require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/../wp-config.php';
}
function insertData() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'geo';

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $_GET['name'],
            'numero' => $_GET['number'],
            'type' => $_GET['type'],
            'adresse' => $_GET['address'],
            'codepostal' => $_GET['cp'],
            'ville' => $_GET['city'],
            'pays' => $_GET['country'],
            'longitude' => $_GET['lon'],
            'latitude' => $_GET['lat'],
        )
    );
}

insertData();