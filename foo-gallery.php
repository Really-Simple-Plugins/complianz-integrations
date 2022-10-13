<?php

function my_foo_gallery_block_content( $html ){
	if ( cmplz_uses_thirdparty('youtube') ) {
		$pattern = '/fg-type-video.*?<a href="(.*?)"/i';
		if ( preg_match_all( $pattern, $html,
			$matches, PREG_PATTERN_ORDER )
		) {
			foreach ( $matches[0] as $key => $html_match ) {
				$el     = $matches[0][ $key ];
				$src     = $matches[1][ $key ];
				if (strpos($src, 'youtube') !== false) {
					$new_el = str_replace( 'class="fg-item-inner', 'class="fg-item-inner cmplz-placeholder-element ', $el );
					$html   = str_replace( $el, $new_el, $html );
				}
			}
		}
	}
	return $html;
}
add_filter( 'cmplz_cookie_blocker_output' , 'my_foo_gallery_block_content' );


function my_cmplz_foo_gallery_css() {
	if ( cmplz_uses_thirdparty('youtube') ) {
		?>
		<style>
            .fg-type-video .cmplz-blocked-content-container .cmplz-blocked-content-notice {
                width: 100%;
                top: 0;
                left: 0;
		bottom: 0;
                padding:3px;
                transform: translate(0, 0);
                font-size: 12px;
                line-height: 15px;
            }
		</style>
		<?php
	}
}
add_action( 'wp_footer', 'my_cmplz_foo_gallery_css' );
