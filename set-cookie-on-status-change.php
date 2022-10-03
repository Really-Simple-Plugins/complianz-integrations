<?php
function cmplz_add_rlx_category($html){
	$pattern = '/<details class="cmplz-category cmplz-marketing.*?<\/details>/is';
	ob_start();
	?>
    <details class="cmplz-category cmplz-rlx" >
        <summary>
						<span class="cmplz-category-header">
							<span class="cmplz-category-title"><?php _e("RLX category name", "complianz-gdpr")?></span>
							<span class="cmplz-banner-checkbox">
								<input type="checkbox"
                                       id="cmplz-rlx-optin"
                                       data-category="cmplz_rlx"
                                       class="cmplz-consent-checkbox cmplz-rlx"
                                       size="40"
                                       value="1"/>
								<label class="cmplz-label" for="cmplz-rlx-optin" tabindex="0"><span><?php _e("RLX label", "complianz-gdpr")?></span></label>
							</span>
							<span class="cmplz-icon cmplz-open">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  height="18" ><path d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"/></svg>
							</span>
						</span>
        </summary>
        <div class="cmplz-description">
            <span class="cmplz-description-rlx"><?php _e("RLX description", "complianz-gdpr")?></span>
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
add_filter('cmplz_banner_html', 'cmplz_add_rlx_category');

function cmplz_set_rlx() {
	ob_start();
	?>
    <script>
        function cmplz_set_rlx_cookie(value){
            let secure = ";secure";
            let date = new Date();
            let name = 'rlx-consent';
            date.setTime(date.getTime() + (complianz.cookie_expiry * 24 * 60 * 60 * 1000));
            let expires = ";expires=" + date.toGMTString();
            console.log("set cookie with string "+name + "=" + value + ";SameSite=Lax" + secure + expires);
            document.cookie = name + "=" + value + ";SameSite=Lax" + secure + expires;
        }
        
        //set a default false value, as workaround for rlx issue which checks for false cookie, instead of also checking for not-existing one.
        cmplz_set_rlx_cookie(false);

        /**
         * Set a complianz rlx cookie and the custom cookie on save preferences
         */
        document.addEventListener('click', e => {
            if (e.target.closest('.cmplz-save-preferences')) {
                let rlx_enabled = document.querySelector('input.cmplz-rlx').checked;
                if (rlx_enabled) {
                    console.log("save prefs, rlx enabled");
                    cmplz_set_cookie('rlx', 'allow');
                    cmplz_set_rlx_cookie(true);
                } else {
                    console.log("save prefs, rlx disabled");
                    cmplz_set_rlx_cookie(false);
                    cmplz_set_cookie('rlx', 'deny');
                }
            }
        });

        document.addEventListener("cmplz_fire_categories", function (e) {
            var consentedCategories = e.detail.categories;
            if ( cmplz_in_array( 'marketing', consentedCategories ) ) {
                cmplz_set_cookie('rlx', 'allow');
            }
            if ( cmplz_in_array( 'rlx', consentedCategories ) ) {
                cmplz_set_cookie('rlx', 'allow');
            }
        });

        document.addEventListener("cmplz_before_cookiebanner", function(e) {
            console.log("before cookie banner");
            if (cmplz_get_cookie('rlx') === 'allow'){
                console.log("set checkbox rlx to true");
                document.querySelector('input.cmplz-rlx').checked = true;
            }
        });

        /**
         * Handle revoke
         */
        document.addEventListener("cmplz_revoke", function(e) {
            console.log("revoke rlx cookie");
            cmplz_set_cookie('rlx', 'deny');
            cmplz_set_rlx_cookie(false);
        });
    </script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_set_rlx',PHP_INT_MAX );




