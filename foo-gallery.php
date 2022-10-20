<?php

function my_foo_gallery_block_content( $html ) {
	if ( cmplz_uses_thirdparty('youtube') ) {
		$pattern = '/fg-type-video.*?<a href="(.*?)"/i';
        $pattern_slider_pro_template = '/fg-video-default/i';
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
		} elseif ( preg_match_all( $pattern_slider_pro_template, $html,
			$matches, PREG_PATTERN_ORDER )
            && cmplz_has_consent( 'marketing') != '1'
	        ) {
			foreach ( $matches[0] as $key => $html_match ) {
				$el     = $matches[0][ $key ];
                // Do not replace fg-video-default multiple times
				if ( strpos( $html, 'fg-video-default cmplz-placeholder-element') !== true ) {
					$new_el = str_replace( 'fg-video-default', 'fg-video-default cmplz-placeholder-element', $el );
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
            .fg-type-video .cmplz-blocked-content-container .cmplz-blocked-content-notice, .fg-video-default .cmplz-blocked-content-container .cmplz-blocked-content-notice {
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

/**
 * Force reload after consent
 * @return void
 */
function cmplz_foo_reload_after_consent() {
	?>
    <script>
        if ( document.getElementsByClassName('fg-video-default') ) {
            document.addEventListener('cmplz_status_change', function (e) {
                if (e.detail.category === 'marketing' && e.detail.value==='allow') {
                    location.reload();
                }
            });
            document.addEventListener('cmplz_status_change_service', function (e) {
                if ( e.detail.value ) {
                    location.reload();
                }
            });
        }
    </script>
	<?php
}
add_action( 'wp_footer', 'cmplz_foo_reload_after_consent' );
