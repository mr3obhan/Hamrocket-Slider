<?php

class Front {

	public function __construct() {

		/*
         * Add Script
         */
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_style' ) );

		add_shortcode('hmd_slider', [$this, 'hmd_slider_function']);

	}

	/**
	 * Register Asset
	 */
	public function wp_enqueue_style() {

		wp_enqueue_style( 'hmd-slider', HMD_SLIDER::$plugin_url . '/asset/public/css/style.css', array(), HMD_SLIDER::$plugin_version, 'all' );

		wp_enqueue_script( 'hmd-slider', HMD_SLIDER::$plugin_url . '/asset/public/js/slider-app.js', array( 'jquery' ), HMD_SLIDER::$plugin_version, true );

	}

	function hmd_slider_function() {
		return get_sliders();
	}

}

new Front();