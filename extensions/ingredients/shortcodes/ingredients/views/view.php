<?php if ( !defined('FW') ) die('Forbidden');

//1 - col-*-12
//2 - col-*-6
//3 - col-*-4
//4 - col-*-3
//6 - col-*-2

//bootstrap col-lg-* class
$lg_class = '';
switch ( $atts['responsive_lg'] ) :
	case ( 1 ) :
		$lg_class = 'col-lg-12';
		break;

	case ( 2 ) :
		$lg_class = 'col-lg-6';
		break;

	case ( 3 ) :
		$lg_class = 'col-lg-4';
		break;

	case ( 4 ) :
		$lg_class = 'col-lg-3';
		break;
	//6
	default:
		$lg_class = 'col-lg-2';
endswitch;

//bootstrap col-md-* class
$md_class = '';
switch ( $atts['responsive_md'] ) :
	case ( 1 ) :
		$md_class = 'col-md-12';
		break;

	case ( 2 ) :
		$md_class = 'col-md-6';
		break;

	case ( 3 ) :
		$md_class = 'col-md-4';
		break;

	case ( 4 ) :
		$md_class = 'col-md-3';
		break;
	//6
	default:
		$md_class = 'col-md-2';
endswitch;

//bootstrap col-sm-* class
$sm_class = '';
switch ( $atts['responsive_sm'] ) :
	case ( 1 ) :
		$sm_class = 'col-sm-12';
		break;

	case ( 2 ) :
		$sm_class = 'col-sm-6';
		break;

	case ( 3 ) :
		$sm_class = 'col-sm-4';
		break;

	case ( 4 ) :
		$sm_class = 'col-sm-3';
		break;
	//6
	default:
		$sm_class = 'col-sm-2';
endswitch;

//bootstrap col-xs-* class
$xs_class = '';
switch ( $atts['responsive_xs'] ) :
	case ( 1 ) :
		$xs_class = 'col-xs-12';
		break;

	case ( 2 ) :
		$xs_class = 'col-xs-6';
		break;

	case ( 3 ) :
		$xs_class = 'col-xs-4';
		break;

	case ( 4 ) :
		$xs_class = 'col-xs-3';
		break;
	//6
	default:
		$xs_class = 'col-xs-2';
endswitch;

//column paddings class
//margin values:
//0
//1
//2
//10
//30
$margin_class = '';
switch ( $atts['margin'] ) :
	case ( 0 ) :
		$margin_class = 'columns_padding_0';
		break;

	case ( 1 ) :
		$margin_class = 'columns_padding_1';
		break;

	case ( 2 ) :
		$margin_class = 'columns_padding_2';
		break;

	case ( 10 ) :
		$margin_class = 'columns_padding_5';
		break;
	//6
	default:
		$margin_class = 'columns_padding_15';
endswitch;

/**
 * @var $post_type
 * @var array $query_post
 */

$unique_id = uniqid();
$ingredients = fw()->extensions->get( 'ingredients' );
$categories = fw()->extensions->get('ingredients')->get_settings();
$query_post = new WP_Query( array( 
    'post_type' => $ingredients->get_post_type_name()
    ) );
?>

<?php 

$categories = fw_ext_extension_get_listing_categories( $categories['taxonomy_name'], 'ingredients' );
$sort_classes = fw_ext_extension_get_sort_classes($query_post->posts, $categories, '', 'ingredients');

if ( $atts['show_filters'] ) : ?>
    <div class="filters isotope_filters-<?php echo esc_attr( $unique_id ) ?> text-center">
        <a href="#" data-filter="*" class="selected"><?php esc_html_e('All', 'ingredients'); ?></a>
        <?php
        foreach ( $categories as $category ) :                
        ?>
        <a href="#" data-filter=".<?php echo esc_attr( $category->slug ); ?>">
        <?php echo esc_html( $category->name ); ?>
        </a>
        <?php endforeach; ?> 
    </div>
<?php endif; ?>

<div class="<?php echo esc_attr( $margin_class ); ?>">
    <div class="isotope_container isotope row masonry-layout"
        <?php if ($atts['show_filters']) : ?>
            data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>">
        <?php endif; ?>

        <?php while ($query_post->have_posts() ) : $query_post->the_post(); ?>
            <div class="isotope-item <?php echo esc_attr( $lg_class. ' ' . $md_class . ' ' . $sm_class . ' ' . $xs_class . ' ' . $sort_classes[get_the_ID()] );?>">
            <?php
            include( fw()->extensions->get('ingredients')->locate_view_path('ingredient-item') );
            ?>            
            </div>
        <?php endwhile; ?>		
    </div>
</div>