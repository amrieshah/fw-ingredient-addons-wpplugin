<?php if(!defined('FW')) die('Forbidden');

get_header();

$column_classes = fw_ext_extension_get_columns_classes( true );

// getting taxonomy name
$ext_ingredients_settings = fw()->extensions->get('ingredients')->get_settings();
$taxonomy_name = $ext_ingredients_settings['taxonomy_name'];

$categories = fw_ext_extension_get_listing_categories( array(), 'ingredients' );
global $wp_query;
$sort_classes = fw_ext_extension_get_sort_classes( $wp_query->posts, $categories, '', 'ingredients' );

// get taxonomy settings
$queried_object = get_queried_object();
$atts = fw_get_db_term_option($queried_object->term_taxonomy_id, $queried_object->taxonomy);


$unique_id = uniqid();
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		//no need to show filters on category set check to 100 categories
		if ( count( $categories ) > 100 ) : ?>
			<div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
				<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'fw' ); ?></a>
				<?php foreach ( $categories as $category ) : ?>
					<a href="#"
					   data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endforeach; ?>
			</div><!-- eof isotope_filters -->
		<?php endif; //count subcategories check ?>
		<?php if ( have_posts() ) : ?>
			<div class="isotope_container isotope row masonry-layout"
				<?php if ( count( $categories ) > 100 ) { ?>
					data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>"
				<?php } ?>
			>
				<?php
				while ( have_posts() ) : the_post();
					?>
					<div
						class="isotope-item col-lg-4 col-md-6 col-sm-12 <?php echo esc_attr( $sort_classes[get_the_ID()] ); ?>">
						<?php
						include( fw()->extensions->get( 'ingredients' )->locate_view_path( 'taxonomy-item' ) );
						?>
					</div>
				<?php endwhile; ?>
			</div><!-- eof isotope_container -->
			<?php
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
            <div class="ingredient-pagination-container">
            <?php // Previous/next page navigation.
                $pagination = paginate_links( array(
                    'prev_text' => __( 'Prev' ),
                    'next_text' => __( 'Next' ),
                    'type'      => 'list',
                ));
                if ( $pagination ) {
                    echo '<nav class="pagination-nav ingredient-pagination-container">' . wp_kses_post( str_replace( 'page-numbers', 'page-number pagination', $pagination ) ) . '</nav>';
                }
            ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>