<?php

/**
 * Plugin Name:     Ingredient Addons
 * Description:     Additional extensions for ingredient post
 * Version:         1.0
 * Author:          amrieshah
 * Author URI:      https://github.com/amrieshah/orb-ingredient-fw-ingredients
 * License:         GPLv2 or later
 */

function _filter_plugin_fw_ingredient_addons($locations) {
    $locations[ dirname( __FILE__ ) . '/extensions' ]
    =
    plugin_dir_url( __FILE__ ) . 'extensions';

    return $locations;
}
add_filter( 'fw_extensions_locations', '_filter_plugin_fw_ingredient_addons' );

?>