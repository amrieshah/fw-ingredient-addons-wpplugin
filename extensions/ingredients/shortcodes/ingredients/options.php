<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_pipeline_settings = fw()->extensions->get( 'ingredients' )->get_settings();
$taxonomy = $ext_pipeline_settings['taxonomy_name'];

$options = array(
	'number'        => array(
		'type'       => 'slider',
		'value'      => 6,
		'properties' => array(
			'min'  => 1,
			'max'  => 12,
			'step' => 1, // Set slider step. Always > 0. Could be fractional.

		),
		'label'      => esc_html__( 'Items number', 'fw' ),
		'desc'       => esc_html__( 'Number of posts to display', 'fw' ),
	),
	'margin'        => array(
		'label'   => esc_html__( 'Horizontal item margin (px)', 'fw' ),
		'desc'    => esc_html__( 'Select horizontal item margin', 'fw' ),
		'value'   => '30',
		'type'    => 'select',
		'choices' => array(
			'0'  => esc_html__( '0', 'fw' ),
			'1'  => esc_html__( '1px', 'fw' ),
			'2'  => esc_html__( '2px', 'fw' ),
			'10' => esc_html__( '10px', 'fw' ),
			'30' => esc_html__( '30px', 'fw' ),
		)
	),
	'layout'        => array(
		'label'   => esc_html__( 'Layout', 'fw' ),
		'desc'    => esc_html__( 'Choose layout', 'fw' ),
		'value'   => 'carousel',
		'type'    => 'select',
		'choices' => array(
			'carousel' => esc_html__( 'Carousel', 'fw' ),
			'isotope'  => esc_html__( 'Masonry Grid', 'fw' ),
		)
	),
	'responsive_lg' => array(
		'label'   => esc_html__( 'Columns on large screens', 'fw' ),
		'desc'    => esc_html__( 'Select items number on wide screens (>1200px)', 'fw' ),
		'value'   => '4',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'fw' ),
			'2' => esc_html__( '2', 'fw' ),
			'3' => esc_html__( '3', 'fw' ),
			'4' => esc_html__( '4', 'fw' ),
			'6' => esc_html__( '6', 'fw' ),
		)
	),
	'responsive_md' => array(
		'label'   => esc_html__( 'Columns on middle screens', 'fw' ),
		'desc'    => esc_html__( 'Select items number on middle screens (>992px)', 'fw' ),
		'value'   => '3',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'fw' ),
			'2' => esc_html__( '2', 'fw' ),
			'3' => esc_html__( '3', 'fw' ),
			'4' => esc_html__( '4', 'fw' ),
			'6' => esc_html__( '6', 'fw' ),
		)
	),
	'responsive_sm' => array(
		'label'   => esc_html__( 'Columns on small screens', 'fw' ),
		'desc'    => esc_html__( 'Select items number on small screens (>768px)', 'fw' ),
		'value'   => '2',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'fw' ),
			'2' => esc_html__( '2', 'fw' ),
			'3' => esc_html__( '3', 'fw' ),
			'4' => esc_html__( '4', 'fw' ),
			'6' => esc_html__( '6', 'fw' ),
		)
	),
	'responsive_xs' => array(
		'label'   => esc_html__( 'Columns on extra small screens', 'fw' ),
		'desc'    => esc_html__( 'Select items number on extra small screens (<767px)', 'fw' ),
		'value'   => '1',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'fw' ),
			'2' => esc_html__( '2', 'fw' ),
			'3' => esc_html__( '3', 'fw' ),
			'4' => esc_html__( '4', 'fw' ),
			'6' => esc_html__( '6', 'fw' ),
		)
	),
	'show_filters'  => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show filters', 'fw' ),
		'desc'         => esc_html__( 'Hide or show categories filters', 'fw' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'fw' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'fw' ),
		),
	),
	'cat' => array(
		'type'  => 'multi-select',
		'label' => esc_html__('Select categories', 'fw'),
		'desc'  => esc_html__('You can select one or more categories', 'fw'),
		'population' => 'taxonomy',
		'source' => $taxonomy,
		'prepopulate' => 10,
		'limit' => 100,
	)
);