<?php
defined( 'ABSPATH' ) or die();
/**
 * props @Idan-noiza
 * https://github.com/Really-Simple-Plugins/complianz-gdpr/issues/348
 */

/**
 * Add a script to the blocked list
 * @param array $tags
 *
 * @return array
 */
function cmplz_facetwp_script( $tags ) {
	$wait_for = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? 'facetwp-map-facet/assets/js/front.js' : 'facetwp/assets/js/dist/front.min.js';
	$tags[] = array(
		'name' => 'FacetWP',
		'category' => 'marketing',
		'urls' => array(
			'maps.googleapis.com',
			'facetwp/assets/js/dist/front.min.js',
			'facetwp-map-facet/assets/js/front.js',
		),
		'enable_placeholder' => '1',
		'placeholder' => 'google-maps',
		'placeholder_class' => 'custom-css-class-for-embed-google-map',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'. This should reflect the order in which it should load.
			'maps.googleapis.com' => $wait_for,
		],
	);

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_facetwp_script' );
/**
 * Re Initialize Map
 *
 */

function cmplz_facetwp_map_initDomContentLoaded() {
	ob_start();
	?>
	<script>
        /**
         * Make functions await for 'ms' milliseconds
         * https://stackoverflow.com/questions/951021/what-is-the-javascript-version-of-sleep
         *
         */
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        /**
         * Wait for 'map-html-id' to be initialized
         *
         */
        const checkIfMapIsInitialized = () => {
            const map = document.getElementById('map-html-id');
            return map.children.length > 0 && FWP_MAP.markersArray.length > 0;
        }

        /**
         * Wait for 'FWP', 'FWP_MAP' and 'FWP_MAP.map' to be set
         *
         */
        const checkIfFWPExists = async () => {
            if (typeof FWP !== 'undefined' && typeof FWP_MAP !== 'undefined' && typeof FWP_MAP.map !== 'undefined') {
                return true;
            }
            await sleep(1000);
            checkIfFWPExists();
        }

        /**
         * Reinitialize FacetWP Google Maps' map
         *
         */
        const reinitiliazeMap = async () => {
            FWP.loaded = false;
            delete FWP.frozen_facets.map_facet;
            FWP.refresh();
            await sleep(6000);
            if (checkIfMapIsInitialized() !== true) {
                reinitiliazeMap();
            }
        }

        const fixMap = async (event) => {
            if (!cmplz_has_consent("marketing")) {
                return;
            }
            if (event.type === "cmplz_enable_category") {
                document.removeEventListener('cmplz_enable_category', fixMap);
                window.removeEventListener('load', fixMap);
            }
            await checkIfFWPExists();

            if (checkIfMapIsInitialized() !== true) {
                await reinitiliazeMap();
            }
        }

        document.addEventListener('cmplz_enable_category', fixMap);
        window.addEventListener('load', fixMap);
	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_facetwp_map_initDomContentLoaded',PHP_INT_MAX );


