<?php if(!defined('FW')) die('Forbidden');

if (is_admin()) {
    return;
}

wp_enqueue_style( 'fw-ingredient-style', plugin_dir_url( __FILE__ ) . 'static/css/ingredient.css' , array(), '1.0.0' );