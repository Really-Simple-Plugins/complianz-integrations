<?php
defined( 'ABSPATH' ) or die();

/**
 *
 */

function cmplz_elementor_backgroundvideo() {
	if ( cmplz_uses_thirdparty('youtube') || cmplz_uses_thirdparty('facebook') || cmplz_uses_thirdparty('twitter') ) {
		ob_start();
		?>
		<script>
            document.addEventListener("cmplz_enable_category", function(consentData) {
                var category = consentData.detail.category;
                var services = consentData.detail.services;
                var blockedContentContainers = [];
                let selectorVideo = '.cmplz-elementor-video_background[data-category="'+category+'"]';
                for (var service in services) {
                    if (services.hasOwnProperty(service)) {
                        selectorVideo +=',.cmplz-elementor-video_background[data-service="'+service+'"]';
                    }
                }
                document.querySelectorAll(selectorVideo).forEach(obj => {
                    let elementService = obj.getAttribute('data-service');
                    if ( cmplz_is_service_denied(elementService) ) {
                        return;
                    }
                    if (obj.classList.contains('cmplz-elementor-activated')) return;
                    obj.classList.add('cmplz-elementor-activated');

                    if ( obj.hasAttribute('data-cmplz_elementor_widget_type') ){
                        let attr = obj.getAttribute('data-cmplz_elementor_widget_type');
                        obj.classList.removeAttribute('data-cmplz_elementor_widget_type');
                        obj.classList.setAttribute('data-widget_type', attr);
                    }

                    obj.setAttribute('data-settings', obj.getAttribute('data-cmplz-elementor-settings'));
                    blockedContentContainers.push(obj);
                });

                document.querySelectorAll(selectorGeneric).forEach(obj => {
                    let elementService = obj.getAttribute('data-service');
                    if ( cmplz_is_service_denied(elementService) ) {
                        return;
                    }
                    if (obj.classList.contains('cmplz-elementor-activated')) return;

                    obj.classList.add('cmplz-elementor-activated');
                    obj.setAttribute('data-href', obj.getAttribute('data-cmplz-elementor-href'));
                    blockedContentContainers.push(obj.closest('.elementor-widget'));
                });

                /**
                 * Trigger the widgets in Elementor
                 */
                for (var key in blockedContentContainers) {
                    if (blockedContentContainers.hasOwnProperty(key) && blockedContentContainers[key] !== undefined) {
                        let blockedContentContainer = blockedContentContainers[key];
                        if (elementorFrontend.elementsHandler) {
                            elementorFrontend.elementsHandler.runReadyTrigger(blockedContentContainer)
                        }
                        var cssIndex = blockedContentContainer.getAttribute('data-placeholder_class_index');
                        blockedContentContainer.classList.remove('cmplz-blocked-content-container');
                        blockedContentContainer.classList.remove('cmplz-placeholder-' + cssIndex);
                    }
                }

            });
		</script>
		<?php
		$script = ob_get_clean();
		$script = str_replace(array('<script>', '</script>'), '', $script);
		wp_add_inline_script( 'cmplz-cookiebanner', $script);
	}
}
add_action( 'wp_enqueue_scripts', 'cmplz_elementor_backgroundvideo',PHP_INT_MAX );

/**
 * Filter cookie blocker output
 */

function cmplz_elementor_cookieblocker_backgroundvideo( $output ){

	if ( cmplz_uses_thirdparty('youtube') ) {
		/**
		 * Video background
		 */
		$iframe_pattern = '/[^>]section class=.*?data-settings="[^"]+?background_video_link[^;]*?&quot;:&quot;(https:.*?youtu.+?(?=&quot;))&quot;/is';
		if ( preg_match_all( $iframe_pattern, $output, $matches, PREG_PATTERN_ORDER ) ) {
			foreach ( $matches[0] as $key => $total_match ) {
				$placeholder = '';
				if ( cmplz_use_placeholder('youtube') && isset($matches[1][$key]) ) {
					$youtube_url = $matches[1][$key];
					$placeholder = 'data-placeholder-image="'.cmplz_placeholder( false, stripcslashes($youtube_url) ).'" ';
				}

				$new_match = str_replace('data-settings', $placeholder.' data-category="marketing" data-service="youtube" data-cmplz-elementor-settings', $total_match);
				$new_match = str_replace('data-widget_type', 'data-cmplz_elementor_widget_type', $new_match);
				$new_match = str_replace('class="', 'class="cmplz-elementor-video_background cmplz-placeholder-element ', $new_match);
				$output = str_replace($total_match, $new_match, $output);
			}
		}
	}

	return $output;
}
add_filter('cmplz_cookie_blocker_output', 'cmplz_elementor_cookieblocker_backgroundvideo');


