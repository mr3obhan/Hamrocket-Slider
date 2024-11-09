<?php

class HMD_Slider_Post_Type {

	public static $post_type = 'hmd-slider';

	public function __construct() {
		add_action( 'init', [ $this, 'create_post_type' ] );
		add_action( 'add_meta_boxes', [ $this, 'create_custom_meta_meta_box' ] );
		add_action( 'save_post', [ $this, 'hmd_save_custom_meta_box_data' ] );
	}

	public static function get_post_type_name() {
		return __( 'اسلایدر همراکت', self::$post_type );
	}

	public function create_post_type() {

		// Add Post Type
		$labels = array(
			'name'               => self::get_post_type_name(),
			'singular_name'      => self::get_post_type_name(),
			'menu_name'          => self::get_post_type_name(),
			'name_admin_bar'     => self::get_post_type_name(),
			'add_new'            => __( 'افزودن', self::$post_type ),
			'add_new_item'       => __( 'افزودن', self::$post_type ),
			'new_item'           => __( 'ایجاد', self::$post_type ),
			'edit_item'          => __( 'ویرایش', self::$post_type ),
			'view_item'          => __( 'نمایش', self::$post_type ),
			'all_items'          => __( 'تمامی', self::$post_type ),
			'search_items'       => __( 'جستجو', self::$post_type ),
			'parent_item_colon'  => __( 'والد:', self::$post_type ),
			'not_found'          => __( 'هیچ آیتمی وجود ندارد.', self::$post_type ),
			'not_found_in_trash' => __( 'هیچ آیتمی در سطل زباله یافت نشد.', self::$post_type )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => '',
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'has_archive'        => false,
			'show_in_rest'       => false,
			'hierarchical'       => false,
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'supports'           => array(
				'title',
				'thumbnail'

			)
		);
		register_post_type( 'hmd_sliders', $args );

	}

	public function create_custom_meta_meta_box() {

		add_meta_box(
			'hmd_custom_meta_meta_box',
			'تنظیمات اسلایدر',
			'hmd_custom_meta_box_subtitle_callback',
			'hmd_sliders',
		);

		function hmd_custom_meta_box_subtitle_callback( $post ) {

			$subtitle           = get_post_meta( $post->ID, '_hmd_slider_subtitle', true );
			$description        = get_post_meta( $post->ID, '_hmd_description', true );
			$btn_primary_txt    = get_post_meta( $post->ID, '_hmd_slider_btn_primary_text', true );
			$btn_primary_link   = get_post_meta( $post->ID, '_hmd_slider_btn_primary_link', true );
			$btn_secondary_txt  = get_post_meta( $post->ID, '_hmd_slider_btn_secondary_text', true );
			$btn_secondary_link = get_post_meta( $post->ID, '_hmd_slider_btn_secondary_link', true );

			wp_nonce_field( 'hmd_save_custom_meta_box_data', 'hmd_meta_box_nonce' )

			?>
            <p>
                <label for="hmd_slider_subtitle">زیر عنوان : </label>
                <input type="text" id="hmd_slider_subtitle" name="hmd_slider_subtitle"
                       value="<?php echo esc_attr( $subtitle ); ?>"/>
            </p>

            <p>
                <label for="hmd_slider_des">توضیحات : </label>
				<?php
				wp_editor( $description, 'hmd_description', array(
					'textarea_name' => 'hmd_description',
					'textarea_rows' => 12,
					'editor_class'  => 'wp-editor-area',
				) );
				?>
            </p>

            <p>
                <label for="hmd_slider_btn_primary_text">دکمه اصلی : </label>
                <input type="text" id="hmd_slider_btn_primary_text" name="hmd_slider_btn_primary_text"
                       value="<?php echo esc_attr( $btn_primary_txt ); ?>"/>

                <label for="hmd_slider_btn_primary_link">لینک دکمه اصلی : </label>
                <input type="text" id="hmd_slider_btn_primary_link" name="hmd_slider_btn_primary_link"
                       value="<?php echo esc_attr( $btn_primary_link ); ?>"/>
            </p>

            <p>
                <label for="hmd_slider_btn_secondary_text">عنوان دکمه ثانویه : </label>
                <input type="text" id="hmd_slider_btn_secondary_text" name="hmd_slider_btn_secondary_text"
                       value="<?php echo esc_attr( $btn_secondary_txt ); ?>"/>

                <label for="hmd_slider_btn_secondary_link">لینک دکمه ثانویه : </label>
                <input type="text" id="hmd_slider_btn_secondary_link" name="hmd_slider_btn_secondary_link"
                       value="<?php echo esc_attr( $btn_secondary_link ); ?>"/>
            </p>
			<?php

		}

	}

	function hmd_save_custom_meta_box_data( $post_id ) {

		if ( ! isset( $_POST['hmd_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['hmd_meta_box_nonce'], 'hmd_save_custom_meta_box_data' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['hmd_slider_subtitle'] ) ) {
			$subtitle = sanitize_text_field( $_POST['hmd_slider_subtitle'] );
			update_post_meta( $post_id, '_hmd_slider_subtitle', $subtitle );
		}

        if ( isset( $_POST['hmd_description'] ) ) {
	        $description = sanitize_text_field( $_POST['hmd_description'] );
            update_post_meta( $post_id, '_hmd_description', $description );
        }

        if ( isset( $_POST['hmd_slider_btn_primary_text'] ) ) {
	        $btn_primary_txt = sanitize_text_field( $_POST['hmd_slider_btn_primary_text'] );
            update_post_meta( $post_id, '_hmd_slider_btn_primary_text', $btn_primary_txt );
        }

        if ( isset( $_POST['hmd_slider_btn_primary_link'] ) ) {
	        $btn_primary_link = sanitize_text_field( $_POST['hmd_slider_btn_primary_link'] );
            update_post_meta( $post_id, '_hmd_slider_btn_primary_link', $btn_primary_link );
        }

	}

}

new HMD_Slider_Post_Type();