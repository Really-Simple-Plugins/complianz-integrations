<?php
/**
 *  To enable this template create a directories in your active theme:
 *  - free: complianz-gdpr/templates/
 *  - premium: complianz-gdpr-premium/templates
 *  - in this directory, save this file, and name it "cookiebanner.php".
 *  -
 */

?>
<style>
    .cmplz-square-checkbox:checked + .cc-check svg path {
        stroke-dashoffset: 60;
        transition: all 0.3s linear;
    }
    .cmplz-square-checkbox:checked + .cc-check svg polyline {
        stroke-dashoffset: 42;
        transition: all 0.2s linear;
        transition-delay: 0.15s;
    }
    .cmplz-square-checkbox:focus + .cc-check svg {
        outline: -webkit-focus-ring-color auto 1px;
    }
    input.cmplz-svg-checkbox,
    .cmplz-slider-checkbox input {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        border: 0;
        white-space: nowrap;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
        clip-path: inset(50%);
    }
    div.cc-check {
        display: inline-block;
        padding-bottom: 10px;
    }
    .cc-check,
    .cc-check svg {
        display: inherit;
        transform: translate3d(0, 0, 0);
    }
    label:not(.cc-check) {
        white-space: nowrap;
        margin-right: 15px;
        margin-left: 0;
        padding-left: 0;
    }
    .cmplz-categories .cmplz-consent-checkbox {
        margin-right: 15px;
    }
    .cmplz-categories label {
        box-sizing: initial;
    }
    .cmplz-categories .cc-check {
        cursor: pointer;
        position: relative;
        margin: auto 7px auto auto;
        width: 18px;
        height: 18px;
        -webkit-tap-highlight-color: transparent;
    }
    .cmplz-categories .cc-check:before {
        content: "";
        position: absolute;
        opacity: 0;
    }
    .cmplz-categories .cc-check:hover:before {
        opacity: 1;
    }
    .cmplz-categories .cc-check svg {
        position: relative;
        z-index: 1;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 3.5;
        transition: all 0.2s ease;
        stroke: #000;
    }
    .cmplz-categories .cc-check svg path {
        stroke-dasharray: 60;
        stroke-dashoffset: 0;
    }
    .cmplz-categories .cc-check svg polyline {
        stroke-dasharray: 22;
        stroke-dashoffset: 66;
    }

    .cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-banner-checkbox .cmplz-label:before,
    .cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-banner-checkbox .cmplz-label:after
    {
        display:none;
    }
</style>
<div class="cmplz-cookiebanner cmplz-hidden banner-{id} {consent_type} cmplz-{position} cmplz-categories-type-{use_categories}" aria-modal="true" data-nosnippet="true" role="dialog" aria-live="polite" aria-labelledby="cmplz-header-{id}-{consent_type}" aria-describedby="cmplz-message-{id}-{consent_type}">
	<div class="cmplz-header">
		<div class="cmplz-logo">{logo}</div>
		<div class="cmplz-title" id="cmplz-header-{id}-{consent_type}">{header}</div>
		<a class="cmplz-close" tabindex="0" role="button">
			<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><title>close</title><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
		</a>
	</div>

	<div class="cmplz-divider cmplz-divider-header"></div>
	<div class="cmplz-body">
		<div class="cmplz-message" id="cmplz-message-{id}-{consent_type}">{message_{consent_type}}</div>
		<!-- categories start -->
		<div class="cmplz-categories">
			<details class="cmplz-category cmplz-functional" >
				<summary>
					<div class="cmplz-category-header">
						<div class="cmplz-category-title">{category_functional}</div>
						<div class='cmplz-always-active'>
							<div class="cmplz-banner-checkbox">
								<label class="cmplz-label" for="cmplz-functional-{consent_type}" tabindex="0">
									<input type="checkbox"
									       id="cmplz-functional-{consent_type}"
									       data-category="cmplz_functional"
									       class="cmplz-consent-checkbox cmplz-functional cmplz-square-checkbox cmplz-svg-checkbox"
									       size="40"
									       value="1"/>
									<div class="cc-check">
										<svg width="16px" height="16px" viewBox="0 0 18 18" class="cmplz-square" aria-hidden="true"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path><polyline points="1 9 7 14 15 4"></polyline></svg></div>
								</label>
							</div>
							<?php _e("Always active","complianz-gdpr")?>
						</div>
						<div class="cmplz-icon cmplz-open"></div>
					</div>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-functional">{functional_text}</span>
				</div>
			</details>
			<details class="cmplz-category cmplz-preferences" >
				<summary>
					<div class="cmplz-category-header">
						<div class="cmplz-category-title">{category_preferences}</div>
						<div class="cmplz-banner-checkbox">
							<label class="cmplz-label" for="cmplz-preferences-{consent_type}" tabindex="0">
								<input type="checkbox"
								       id="cmplz-preferences-{consent_type}"
								       data-category="cmplz_preferences"
								       class="cmplz-consent-checkbox cmplz-preferences cmplz-square-checkbox cmplz-svg-checkbox"
								       size="40"
								       value="1"/>
								<div class="cc-check">
									<svg width="16px" height="16px" viewBox="0 0 18 18" class="cmplz-square" aria-hidden="true"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path><polyline points="1 9 7 14 15 4"></polyline></svg></div>
							</label>
						</div>
						<div class="cmplz-icon cmplz-open"></div>
					</div>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-preferences">{preferences_text}</span>
				</div>
			</details>

			<details class="cmplz-category cmplz-statistics" >
				<summary>
					<div class="cmplz-category-header">
						<div class="cmplz-category-title">{category_statistics}</div>
						<div class="cmplz-banner-checkbox">
							<label class="cmplz-label" for="cmplz-statistics-{consent_type}" tabindex="0">
								<input type="checkbox"
								       id="cmplz-statistics-{consent_type}"
								       data-category="cmplz_statistics"
								       class="cmplz-consent-checkbox cmplz-statistics cmplz-square-checkbox cmplz-svg-checkbox"
								       size="40"
								       value="1"/>
								<div class="cc-check">
									<svg width="16px" height="16px" viewBox="0 0 18 18" class="cmplz-square" aria-hidden="true"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path><polyline points="1 9 7 14 15 4"></polyline></svg></div>
							</label>
						</div>
						<div class="cmplz-icon cmplz-open"></div>
					</div>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-statistics">{statistics_text}</span>
					<span class="cmplz-description-statistics-anonymous">{statistics_text_anonymous}</span>
				</div>
			</details>

			<details class="cmplz-category cmplz-marketing" >
				<summary>
					<div class="cmplz-category-header">
						<div class="cmplz-category-title">{category_marketing}</div>
						<div class="cmplz-banner-checkbox">
							<label class="cmplz-label" for="cmplz-marketing-{consent_type}" tabindex="0">
								<input type="checkbox"
								       id="cmplz-marketing-{consent_type}"
								       data-category="cmplz_marketing"
								       class="cmplz-consent-checkbox cmplz-marketing cmplz-square-checkbox cmplz-svg-checkbox"
								       size="40"
								       value="1"/>
								<div class="cc-check">
									<svg width="16px" height="16px" viewBox="0 0 18 18" class="cmplz-square" aria-hidden="true"><path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path><polyline points="1 9 7 14 15 4"></polyline></svg></div>
							</label>
						</div>
						<div class="cmplz-icon cmplz-open"></div>
					</div>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-marketing">{marketing_text}</span>
				</div>
			</details>
		</div><!-- categories end -->
		<?php do_action('cmplz_banner_after_categories' ) ?>
	</div>

	<div class="cmplz-links cmplz-information">
		<a class="cmplz-link cmplz-manage-options cookie-statement" href="#" data-relative_url="#cmplz-manage-consent-container"><?php _e("Manage options","complianz-gdpr")?></a>
		<a class="cmplz-link cmplz-manage-third-parties cookie-statement" href="#" data-relative_url="#cmplz-manage-consent-container"><?php _e("Manage third parties","complianz-gdpr")?></a>
		<a class="cmplz-link cmplz-manage-vendors tcf cookie-statement" href="#" data-relative_url="#cmplz-tcf-wrapper"><?php _e("Manage vendors","complianz-gdpr")?></a>
		<a class="cmplz-link cmplz-external cmplz-read-more-purposes tcf" target="_blank" rel="noopener noreferrer nofollow" href="https://cookiedatabase.org/tcf/purposes/"><?php _e("Read more about these purposes","complianz-gdpr")?></a>
		<?php do_action("cmplz_after_links")?>
	</div>

	<div class="cmplz-divider cmplz-footer"></div>

	<div class="cmplz-buttons">
		<button class="cmplz-btn cmplz-accept">{accept_{consent_type}}</button>
		<button class="cmplz-btn cmplz-deny">{dismiss}</button>
		<button class="cmplz-btn cmplz-view-preferences">{manage_options}</button>
		<button class="cmplz-btn cmplz-save-preferences">{save_settings}</button>
		<a class="cmplz-btn cmplz-manage-options tcf cookie-statement" href="#" data-relative_url="#cmplz-manage-consent-container">{manage_options}</a>
		<?php do_action("cmplz_after_buttons")?>
	</div>

	<div class="cmplz-links cmplz-documents">
		<a class="cmplz-link cookie-statement" href="#" data-relative_url="">{title}</a>
		<a class="cmplz-link privacy-statement" href="#" data-relative_url="">{title}</a>
		<a class="cmplz-link impressum" href="#" data-relative_url="">{title}</a>
		<?php do_action("cmplz_after_documents")?>
	</div>
</div>


