<?php
/**
 * Custom template tags for this theme
 *
 */

if ( ! function_exists( 'waas_the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function waas_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					waas_get_icon_svg( 'chevron_left', 22 ),
					__( 'Newer posts', 'twentynineteen' )
				),
				'next_text' => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					__( 'Older posts', 'twentynineteen' ),
					waas_get_icon_svg( 'chevron_right', 22 )
				),
			)
		);
	}
endif;