<?php if (!defined('FW')) die('Forbidden');

    class FW_Extension_Ingredients extends FW_Extension {
        private $post_type      = 'ingredient';
        private $post_slug      = 'ingredient';
        private $taxonomy_name  = 'ingredient-category';

        public function get_post_type_name() {
            return $this->post_type;
        }
        
        public function get_post_type_slug() {
            return $this->post_slug;
        }

        public function get_taxonomy_name() {
            return $this->taxonomy_name;
        }

        public function _init() {
            if ( is_admin() ) $this->add_admin_filters(); $this->add_admin_actions();            
        }

        public function add_admin_actions() {
            add_action( 'manage_' . $this->post_type . '_posts_custom_column', array($this, '_action_admin_manage_custom_column') );
            add_action( 'restrict_manage_posts', array( $this, '_action_admin_add_ingredient_edit_page_filter' ) );
        }

        public function add_admin_filters() {
            add_filter('parse_query', array( $this, '_filter_admin_filter_ingredients_by_ingredient_category' ), 10, 2 );
            add_filter('months_dropdown_results', array( $this ,'_filter_admin_remove_select_by_date_filter' ) );
            add_filter( 'manage_edit-' . $this->post_type . '_columns', 
            array( $this, '_filter_admin_manage_edit_columns' ),10,1 );            
        }

        public function _action_admin_manage_custom_column( $column_name ) {
            $id = get_the_ID();
            switch ( $column_name ) {
                case 'image':
                    if ( get_the_post_thumbnail( intval( $id ) ) ) {
                        $value = '<a href="' . get_edit_post_link( $id, true ) . '">' . '<img src="' . fw_resize( get_post_thumbnail_id( intval( $id ) ), 150, 150,
                        true ) . '"' . 'width="100" height="100">' . '</a>';
                    }
                    echo $value;
                    break;

                default:
                    break;
            }
        }

        public function _action_admin_add_ingredient_edit_page_filter() {
            $screen = fw_current_screen_match( array(
                'only' => array(
                    'base'      => 'edit',
                    'id'        => 'edit-' . $this->post_type,
                    'post_type' => $this->post_type
                )
                
            ) );

            if ( ! $screen ) {
                return;
            }

            $terms = get_terms( $this->taxonomy_name );

            if ( empty($terms) || is_wp_error($terms )) {
                echo '<select name=">' . $this->post_type . 
                '-filter-by-ingredient-category"><option value="0">' 
                . __( 'View All',  'ingredients') . '</option></select>';

                return;
            }

            $get = FW_Request::GET( $this->get_name() . '-filter-by-ingredient-category' );
            $id = ( ! empty( $get ) ) ? (int) $get : 0 ;

            $dropdown_options = array(
                'selected'          => $id,
                'name'              => $this->get_name() . '-filter-by-ingredient-category' ,
                'taxonomy'          => $this->get_taxonomy_name(),
                'show_option_all'   => __( 'View all categories', 'ingredients' ),
                'hide_empty'        => true,
                'hierarchical'      => 1,
                'show_count'        => 0,
                'order_by'          => 'name'
            );

            wp_dropdown_categories( $dropdown_options );
        }

        public function _filter_admin_manage_edit_columns( $columns ) {
            $new_columns            = array();
            $new_columns['cb']      = $columns['cb'];
            $new_columns['image']   = __( 'Cover Image', 'ingredients' );

            return array_merge( $new_columns, $columns );
        }

        public function _filter_admin_filter_ingredients_by_ingredient_category( $query ) {
            $screen = fw_current_screen_match( array(
                'only' => array(
                    'base'      => 'edit',
                    'id'        => 'edit-' . $this->post_type,
                    'post_type' => $this->post_type

                ))
            );

            if ( ! $screen || ! $query->is_main_query() ) {
                return $query;
            }

            $filter_value = FW_Request::GET( $this->get_name() . '-filter-by-ingredient-category' );

            if (empty( $filter_value) ) {
                return $query;
            }

            $filter_value = ( int ) $filter_value;

            $query->set( 'tax_query',
                array(
                    array(
                        'taxonomy'  => $this->taxonomy_name,
                        'field'     => 'id',
                        'terms'     => $filter_value
                    )
                ) );
            
            return $query;
        }

        public function _filter_admin_remove_select_by_date_filter( $filters ) {
            $screen = array(
                'only' => array(
                    'base' => 'edit',
                    'id' => 'edit-' . $this->post_type,
                )
            );

            if ( ! fw_current_screen_match( $screen ) ) {
                return $filters;
            }

            return array();
        }

        public function get_settings() {
            $settings = array (
                'post_type'     => $this->post_type,
                'taxonomy_name' => $this->taxonomy_name,
            );

            return $settings;
        }

    }



?>