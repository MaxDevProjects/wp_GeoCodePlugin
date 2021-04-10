<?php
global $version_db;
$version_db = '1.0';
/**
 * Method geo_code_install
 *
 * @return void
 */
function geoCode_install()
{
    global $wpdb;
    global $version_db;
    $installed_ver = get_option('version_db');
    if ($installed_ver != $version_db) {
        $table_name = $wpdb->prefix . 'geo';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
            nom TEXT(255) DEFAULT '',
            numero TEXT(255) DEFAULT '',
            type TEXT(255) DEFAULT '',
            adresse TEXT(255) DEFAULT '',
            codepostal TEXT(255) DEFAULT '',
            ville TEXT(255) DEFAULT '',
            pays TEXT(255) DEFAULT '',
            longitude TEXT(255) DEFAULT '',
            latitude TEXT(255) DEFAULT '',
            PRIMARY KEY (id)
        )";

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
        add_option('version_db', $version_db);
    }
}


/**
 * Method geo_code_install_data
 *
 * @return void
 */
/*function geo_code_install_data()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'geo';

    $wpdb->insert(
        $table_name,
        array(
            'date_depart' => date("Y.m.d"),
            'date_retour' => '',
            'message' => 'Congratulations, you just completed the installation!',
        )
    );
}
*/

/**
 * Method geoCodePlugin_update_db_check
 *
 * @return void
 */
function geoCodePlugin_update_db_check()
{
    global $version_db;
    if (get_site_option('version_db') != $version_db) {
        geoCode_install();
    }
}
