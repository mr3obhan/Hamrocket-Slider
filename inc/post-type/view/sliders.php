<?php

function get_sliders() {

	$args = [
		'post_type'   => 'hmd_sliders',
		'numberposts' => - 1,
	];

	$sliders = get_posts( $args );

    ?>
    <div class="carousel">
        <div class="list">
            <?php
	            foreach ($sliders as $slider) {
                    setup_postdata($slider);
                    $thumbnail_url = get_the_post_thumbnail_url($slider->ID, 'full');
        ?>
        <div class="item" style="background-image: url(<?php echo $thumbnail_url ?>);">
            <div class="hmd-overlay"></div>
			<div class="content">
				<div class="title"><?php echo $slider->post_title ?></div>
				<div class="name">EAGLE</div>
				<div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
				<div class="btn">
					<button>See More</button>
					<button>Subscribe</button>
				</div>
			</div>
		</div>
		<?php
    }
                ?>
        </div>

        <!--next prev button-->
        <div class="arrows">
            <button class="prev"><</button>
            <button class="next">></button>
        </div>


        <!-- time running -->
        <div class="timeRunning"></div>

    </div>
<?php
}
