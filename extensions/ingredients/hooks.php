<?php if ( !defined('FW') ) die('Forbidden');

function _filter_fw_ext_ingredients_the_content( $the_content ) {

    $ingredients = fw()->extensions->get('ingredients');

    return fw_render_view( $ingredients->locate_view_path('content'), array( 'the_content' => $the_content ) );
}

function _filter_fw_ext_ingredients_template_include( $template ) {

    $ingredients = fw()->extensions->get( 'ingredients' );

    if ( is_singular( $ingredients->get_post_type_name() ) ) {

        if ( $ingredients->locate_view_path('single')) {
            return $ingredients->locate_view_path('single');
        } else {
            add_filter('the_content', '_filter_fw_ext_ingredients_the_content');
        }
    } else if (is_tax($ingredients->get_taxonomy_name()) && $ingredients->locate_view_path('taxonomy') ) {
        
        return $ingredients->locate_view_path('taxonomy');
    }

    return $template;
}

add_filter( 'template_include', '_filter_fw_ext_ingredients_template_include' );

?>
