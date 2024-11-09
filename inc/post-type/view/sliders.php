<?php

function get_sliders() {

	$args = [
		'post_type'   => 'hmd_sliders',
		'numberposts' => - 1,
	];

	$sliders = get_posts( $args );

	?>
    <div class="hmd-slider-carousel">
        <div class="hmd-slider-list">
			<?php
			foreach ( $sliders as $slider ) {
				setup_postdata( $slider );
				$thumbnail_url   = get_the_post_thumbnail_url( $slider->ID, 'full' );
				$subtitle        = get_post_meta( $slider->ID, '_hmd_slider_subtitle', true );
				$description     = get_post_meta( $slider->ID, '_hmd_description', true );
				$btn_primary_txt = get_post_meta( $slider->ID, '_hmd_slider_btn_primary_text', true );
				$btn_primary_link   = get_post_meta( $slider->ID, '_hmd_slider_btn_primary_link', true );
				//$btn_primary_txt = get_post_meta( $slider->ID, '_hmd_slider_btn_primary_text', true );
				?>
                <div class="hmd-slider-item" style="background-image: url(<?php echo $thumbnail_url ?>);">
                    <div class="hmd-overlay"></div>
                    <div class="hmd-slider-content">
                        <div class="name"><?php echo $subtitle ?></div>
                        <div class="title"><?php echo $slider->post_title ?></div>
                        <div class="des"><?php echo $description ?></div>
                        <div class="hmd-slider-btn">
							<?php echo $btn_primary_txt ? '<a href="'. esc_attr( $btn_primary_link ) .'"> '. $btn_primary_txt .'</a>' : '' ?>
                            <a href="http://google.com">asfag</a>
                        </div>
                    </div>
                </div>
				<?php
			}
			?>
        </div>

        <!--next prev button-->
        <div class="arrows">
            <button class="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
            <button class="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                </svg>
            </button>
        </div>


        <!-- time running -->
        <div class="timeRunning"></div>

    </div>
	<?php
}
