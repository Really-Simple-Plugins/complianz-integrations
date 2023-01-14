<?php
defined( 'ABSPATH' ) or die();

#set to false to disable placeholders
define('CMPLZ_ELEMENTOR_BACKGROUND_PLACEHOLDER', true);
#set to true to enable a placeholder accept button
define('CMPLZ_ELEMENTOR_BACKGROUND_PLACEHOLDER_BUTTON', false);
/**
 *
 */

function cmplz_elementor_backgroundvideo() {
	if ( cmplz_uses_thirdparty('youtube') ) {
		ob_start();
		?>
        <script>
			<?php if (CMPLZ_ELEMENTOR_BACKGROUND_PLACEHOLDER) {?>
            /**
             * This part adds the youtube screen as background image as long as consent is not given.
             */
            document.addEventListener("cmplz_before_cookiebanner", function() {
                document.querySelectorAll('.cmplz-elementor-video_background').forEach(obj => {
                    if ( obj.classList.contains('cmplz-processed') ) {
                        return;
                    }
                    obj.classList.add('cmplz-processed' );
                    let service = obj.getAttribute('data-service');
                    let category = obj.getAttribute('data-category');

                    //we set this element as container with placeholder image
                    let blocked_content_container;
                    if ( obj.classList.contains('cmplz-iframe')) {
                        //handle browser native lazy load feature
                        if ( obj.getAttribute('loading') === 'lazy' ) {
                            obj.removeAttribute('loading');
                            obj.setAttribute('data-deferlazy', 1);
                        }
                        blocked_content_container = obj.parentElement;
                    } else {
                        blocked_content_container = obj;
                    }
                    let curIndex = blocked_content_container.getAttribute('data-placeholder_class_index');
                    //if the blocked content container class is already added, don't add it again
                    if ( curIndex == null ) {
                        cmplz_placeholder_class_index++;
                        blocked_content_container.classList.add('cmplz-placeholder-' + cmplz_placeholder_class_index);
                        blocked_content_container.classList.add('cmplz-blocked-content-container');
                        blocked_content_container.setAttribute('data-placeholder_class_index', cmplz_placeholder_class_index);
                        /**
                         * Use below if you want a placeholder text on your screen capture.
                         */
						<?php if (CMPLZ_ELEMENTOR_BACKGROUND_PLACEHOLDER_BUTTON) {?>
                        cmplz_insert_placeholder_text(blocked_content_container, category, service);
						<?php  } ?>
                        //handle image size for video
                        let src = obj.getAttribute('data-placeholder-image');
                        if (src && typeof src !== 'undefined' && src.length ) {
                            src = src.replace('url(', '').replace(')', '').replace(/\"/gi, "");
                            cmplz_append_css('.cmplz-placeholder-' + cmplz_placeholder_class_index + ' {background-image: url(' + src + ') !important;}');
                            cmplz_set_blocked_content_container_aspect_ratio(obj, src, cmplz_placeholder_class_index);
                        }
                    }
                });

            });
			<?php } ?>
            /**
             * After enabling the category, consent is handled here
             */
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
                        obj.removeAttribute('data-cmplz_elementor_widget_type');
                        obj.setAttribute('data-widget_type', attr);
                    }

                    obj.setAttribute('data-settings', obj.getAttribute('data-cmplz-elementor-settings'));
                    blockedContentContainers.push(obj);
                });

                document.querySelectorAll(selectorVideo).forEach(obj => {
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
				if ( isset($matches[1][$key]) && cmplz_use_placeholder('youtube') ) {
					$youtube_url = $matches[1][$key];
					$placeholder = 'data-placeholder-image="'.cmplz_placeholder( false, stripcslashes($youtube_url) ).'" ';
				}

				$new_match = str_replace('data-settings', $placeholder.' data-category="marketing" data-service="youtube" data-cmplz-elementor-settings', $total_match);
				$new_match = str_replace('data-widget_type', 'data-cmplz_elementor_widget_type', $new_match);
				$new_match = str_replace('class="', 'class="cmplz-elementor-video_background ', $new_match);
				$output = str_replace($total_match, $new_match, $output);
			}
		}
	}

	if ( cmplz_uses_thirdparty('vimeo') ) {
		/**
		 * Video background
		 */
		$iframe_pattern = '/[^>]section class=.*?data-settings="[^"]+?background_video_link[^;]*?&quot;:&quot;(https:.*?player.vimeo.com.+?(?=&quot))&quot;/is';
		if ( preg_match_all( $iframe_pattern, $output, $matches, PREG_PATTERN_ORDER ) ) {
			foreach ( $matches[0] as $key => $total_match ) {
				$placeholder = '';
				if ( isset($matches[1][$key]) && cmplz_use_placeholder('vimeo') ) {
					$url = $matches[1][$key];
					$placeholder = 'data-placeholder-image="'.cmplz_placeholder( false, stripcslashes($url) ).'" ';
				}
				$new_match = str_replace('data-settings', $placeholder.' data-category="marketing" data-service="vimeo" data-cmplz-elementor-settings', $total_match);
				$new_match = str_replace('data-widget_type', 'data-cmplz_elementor_widget_type', $new_match);
				$new_match = str_replace('class="', 'class="cmplz-elementor-video_background ', $new_match);
				$output = str_replace($total_match, $new_match, $output);
			}
		}
	}

	return $output;
}
add_filter('cmplz_cookie_blocker_output', 'cmplz_elementor_cookieblocker_backgroundvideo');
