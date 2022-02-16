<?php
function cmplz_add_social_media_category($html){
	$pattern = '/<details class="cmplz-category cmplz-marketing.*?<\/details>/is';
	ob_start();
	?>
	<details class="cmplz-category cmplz-socialmedia">
		<summary>
			<div class="cmplz-category-header">
				<div class="cmplz-category-title"><?php _e("Social media", "complianz-gdpr")?></div>
				<div class="cmplz-banner-checkbox">
					<input type="checkbox" id="cmplz-socialmedia-optin" data-category="cmplz_socialmedia" class="cmplz-consent-checkbox cmplz-socialmedia" size="40" value="1">
					<label class="cmplz-label" for="cmplz-socialmedia-optin" tabindex="0"><span>
						
					// Social Media descriptive text
					<?php _e("Social media", "complianz-gdpr")?></span></label>
					
				</div>
				<div class="cmplz-icon cmplz-open"></div>
			</div>
		</summary>
		<div class="cmplz-description">
			<span class="cmplz-description-socialmedia"><?php _e("Social media", "complianz-gdpr")?></span>
		</div>
	</details>

	<?php
	$social = ob_get_clean();
	if ( preg_match( $pattern, $html, $matches ) ) {
		$marketing = $matches[0];
		$html = str_replace($marketing, $social.$marketing, $html);
	}

	return $html;
}
add_filter('cmplz_banner_html', 'cmplz_add_social_media_category');


function cmplz_social_media_script() {
	ob_start();
	?>
	<script>
        document.addEventListener('click', e => {

            if ( e.target.closest('.cmplz-save-preferences') ) {
                let social_media_enabled = document.querySelector('input.cmplz-socialmedia').checked;
                if (social_media_enabled) {

		    // remove or add services below if needed
                    //if any service is enabled, allow the general services also, because some services are partially 'general'

                    let services = ['facebook', 'instagram', 'whatsapp', 'tiktok', 'pinterest', 'linkedin', 'twitter', 'disqus'];


                    cmplz_enable_category('', 'general');
                    for (let key in services) {
                        if (services.hasOwnProperty(key)) {
                            let service = services[key];
                            console.log("enable " + service);

                            if (service.length == 0) continue;
                            cmplz_set_service_consent(service, true);
                            cmplz_enable_category('', service);
                            document.querySelectorAll('.cmplz-accept-service[data-service=' + service + ']').forEach(obj => {
                                obj.checked = true;
                            });
                        }
                    }
                    cmplz_set_cookie('socialmedia', 'allow');
                }
            }
        });

        document.addEventListener("cmplz_before_cookiebanner", function(e) {
            if (cmplz_get_cookie('socialmedia') === 'allow'){
                document.querySelector('input.cmplz-socialmedia').checked = true;
            }
        });

        document.addEventListener("cmplz_revoke", function(e) {
            cmplz_set_cookie('socialmedia', 'deny');
        });
	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_social_media_script',PHP_INT_MAX );
