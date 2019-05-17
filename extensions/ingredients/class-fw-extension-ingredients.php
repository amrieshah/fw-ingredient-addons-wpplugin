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

        public function _filter_admin_manage_edit_columns( $columns ) {
            $new_columns            = array();
            $new_columns['cb']      = $columns['cb'];
            $new_columns['image']   = __( 'Cover Image', 'ingredients' );

            return array_merge( $new_columns, $columns );
        }


        public function add_admin_filters() {
            add_filter( 'manage_edit-' . $this->post_type . '_columns', 
            array( $this, '_filter_admin_manage_edit_columns' ),10,1 );
        }


        public function get_settings() {
            $settings = array (
                'post_type'     => $this->post_type,
                'taxonomy_name' => $this->taxonomy_name
            );

            return $settings;
        }

    }



?>