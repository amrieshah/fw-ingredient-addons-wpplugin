<?php if(!defined('FW')) die('Forbidden'); ?>

<?php

$ext_ingredients_settings = fw()->extensions
                            ->get('ingredients')
                            ->get_settings();
$taxonomy_name = $ext_ingredients_settings['taxonomy_name'];

?>

<?php if ( has_post_thumbnail() ) : ?>
    <div class="item-media ingredient-image-radius">
        <?php 
        $full_image_src = wp_get_attachment_url(
        get_post_thumbnail_id( get_the_ID() ) );
        the_post_thumbnail();
        ?>
        <div class="media-links">
            <a class="abs-link" href="<?php the_permalink(); ?>"></a>            
        </div>
    </div>
<?php endif; ?>
    <!-- <div class> -->
        <h5>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h5>
        <p><?php echo fw_get_db_post_option(get_the_ID(), 'main_function'); ?></p>
    <!-- </div> -->

    

    
