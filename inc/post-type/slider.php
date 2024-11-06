<?php

class HMD_Slider_Post_Type {

	public static $post_type = 'hmd-slider';

	public function __construct() {
		add_action( 'init', [ $this, 'create_post_type' ] );
	}

	public static function get_post_type_name()
	{
		return __('اسلایدر همراکت', self::$post_type);
	}

	public function create_post_type() {

		// Add Post Type
		$labels = array(
			'name' => self::get_post_type_name(),
			'singular_name' => self::get_post_type_name(),
			'menu_name' => self::get_post_type_name(),
			'name_admin_bar' => self::get_post_type_name(),
			'add_new' => __('افزودن', self::$post_type),
			'add_new_item' => __('افزودن', self::$post_type),
			'new_item' => __('ایجاد', self::$post_type),
			'edit_item' => __('ویرایش', self::$post_type),
			'view_item' => __('نمایش', self::$post_type),
			'all_items' => __('تمامی', self::$post_type),
			'search_items' => __('جستجو', self::$post_type),
			'parent_item_colon' => __('والد:', self::$post_type),
			'not_found' => __('هیچ آیتمی وجود ندارد.', self::$post_type),
			'not_found_in_trash' => __('هیچ آیتمی در سطل زباله یافت نشد.', self::$post_type)
		);

		$args = array(
			'labels' => $labels,
			'description' => '',
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => false,
			'has_archive' => false,
			'hierarchical' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'supports' => array(
				'title',
				'editor',
				'custom-fields',
				'thumbnail'

			)
		);
		register_post_type('hmd_sliders', $args);

	}

}

new HMD_Slider_Post_Type();