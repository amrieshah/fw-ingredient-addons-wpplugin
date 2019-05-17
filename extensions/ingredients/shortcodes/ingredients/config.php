<?php if(!defined('FW')) die('Forbidden');

$ingredients = fw()->extensions->get( 'ingredients' );
if ( empty( $ingredients ) ) {
    return;
}

$cfg = array(
    'page_builder' => array(
        'title'       => esc_html__( 'Ingredients', 'ingredients' ),
		'description' => esc_html__( 'Ingredients project various views', 'ingredients' ),
		'tab'         => esc_html__( 'Content Elements', 'ingredients' )
    )
);

?>