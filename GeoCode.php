<?php
/*
Plugin Name: Geo Code Form
Plugin URI: null
Description: Geo Code
Author: Maxime G. Martin ( Clower Web Conception )
Version: 1.0.0
Author URI: https://www.clower.fr/
 */
/**
 * GeoCode
 */
class GeoCode
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        if (!defined('ABSPATH')) {
            define('ABSPATH', dirname(__FILE__) . '/');
        }
        add_action('rest_api_inti', [$this, 'reqisterEndpoints']);
        //$this->$data = include_once("model/GetAllData.php");
        $this->hooks();
    }

    /**
     * Method func_load_script
     *
     * @return void
     */
    public function func_load_script()
    {
        wp_enqueue_script('my-svelte-app',
            plugins_url('geoCode_Front/public/build/bundle.js', __FILE__),
            array(),
            '1.0.0'
        );
        wp_enqueue_style('my-svelte-app',
            plugins_url('geoCode_Front/public/build/bundle.css', __FILE__),
            array(),
            '1.0.0'
        );

        wp_enqueue_style('GeoCode_front',
            plugins_url('geoCodeStyle.css', __FILE__),
            array(),
            '1.0.0'
        );
    }

/*
 * Informations should be return for display the plugin in admin menu
 */
    public function admin_geoCode_plugin_menu()
    {
        add_menu_page(
            __('Geo Code', 'geocode'), //titre de la page
            __('Geo Code', 'geocode'), // titre du menu
            'manage_options', //Capability
            'geocode-plugin', //Slug
            [ & $this, 'load_geoCode_plugin_page']// Callback page function
        );
    }

// content of plugin page
    public function load_geoCode_plugin_page()
    {
        echo '<h1>' . __('Geo Code Form', 'geocode') . '</h1>';
        echo '<p>' . __('', 'geocode') . '</p>';
        $this->geocode_content();
    }

/**
 * Method geocode_content
 *
 * @return void
 */
    public function geoCode_content()
    {
        $this->func_load_script();
        echo "<div id='app'></div>";
    }


    private function hooks()
    {
        add_action('plugins_loaded', 'geoCodePlugin_update_db_check');
        //add plugin in admin menu list
        add_action("admin_menu", [$this, 'admin_geoCode_plugin_menu']);
        //        //add action for translate plugin
        //        add_action('plugins_loaded', [$this, 'load_plugin_text_domain']);
        //hook de chargement des scripts
        add_action('wp_enqueue_scripts', [$this, 'func_load_script']);
        add_shortcode('wpvue', 'geoCode_content');
        // add_action('wp_head', [$this, 'display_event']);

        /**
         *Script that import modules must use a script tag with type="module",
         * so let's set it for the script.
         */
        add_filter('script_loader_tag', function ($tag, $handle, $src) {

            switch ($handle) {
                case 'main':
                    return '<script type="module" src="' . esc_url($src) . '"></script>';
                    break;

                default:
                    return $tag;
                    break;
            }
        }, 10, 3);
    }

    function readDataList() {

    }

    function reqisterEndpoints() {
        foreach(['data-list' => $data] as $route => $callback) {
            register_rest_route(
            'geo/v1',
            $route,
            [
            'methods' => 'GET',
            'callback' => [$this, $callback],
            'permission_callback' => [$this, 'allowDeny']
            ]
            );
        }
    }
};
include_once 'model/CreateGeoDb.php';
register_activation_hook(__FILE__, 'geoCode_install');
//register_activation_hook(__FILE__, 'geoCode_install_data');
new GeoCode();
