<?php
/**
 * For each activate consenttype a banner is created
 * If A/B testing is enabled, each banner is rendered per consenttype as well.
 */
?>
<div class="cmplz-cookiebanner cmplz-hidden banner-{id} {consent_type} cmplz-{position} cmplz-categories-type-{use_categories}" aria-modal="true" data-nosnippet="true" role="dialog" aria-live="polite" aria-labelledby="cmplz-header-{id}-{consent_type}" aria-describedby="cmplz-message-{id}-{consent_type}">
	<div class="cmplz-header">
		<div class="cmplz-logo">{logo}</div>
		<div class="cmplz-title" id="cmplz-header-{id}-{consent_type}">{header}</div>
		<div class="cmplz-message-title">What can we use your data for?</div>
	</div>

	<div class="cmplz-divider cmplz-divider-header"></div>
	<div class="cmplz-body">
		<div class="cmplz-message" id="cmplz-message-{id}-{consent_type}">{message_{consent_type}}</div>
		<div class="cmplz-custom-border"></div>
		<!-- categories start -->
		<div class="cmplz-categories">
			<details class="cmplz-category cmplz-functional" open>
				<summary>
						<span class="cmplz-category-header">
							<span class="cmplz-category-title">{category_functional}</span>
							<span class='cmplz-always-active'>
								<span class="cmplz-banner-checkbox">
									<input type="checkbox"
									       aria-checked="true"
									       id="cmplz-functional-{consent_type}"
									       data-category="cmplz_functional"
									       class="cmplz-consent-checkbox cmplz-functional"
									       size="40"
									       value="1"/>
									<label class="cmplz-label" for="cmplz-functional-{consent_type}" tabindex="0"><span>{category_functional}</span></label>
								</span>
								<?php _e("Always active","complianz-gdpr")?>
							</span>
							
						</span>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-functional">{functional_text}</span>
				</div>
			</details>

			<details class="cmplz-category cmplz-preferences" open>
				<summary>
						<span class="cmplz-category-header">
							<span class="cmplz-category-title">{category_preferences}</span>
							<span class="cmplz-banner-checkbox">
								<input type="checkbox"
								       id="cmplz-preferences-{consent_type}"
								       data-category="cmplz_preferences"
								       class="cmplz-consent-checkbox cmplz-preferences"
								       size="40"
								       value="1"/>
								<label class="cmplz-label" for="cmplz-preferences-{consent_type}" tabindex="0"><span>{category_preferences}</span></label>
							</span>
						</span>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-preferences">{preferences_text}</span>
				</div>
			</details>

			<details class="cmplz-category cmplz-statistics" open>
				<summary>
						<span class="cmplz-category-header">
							<span class="cmplz-category-title">{category_statistics}</span>
							<span class="cmplz-banner-checkbox">
								<input type="checkbox"
								       id="cmplz-statistics-{consent_type}"
								       data-category="cmplz_statistics"
								       class="cmplz-consent-checkbox cmplz-statistics"
								       size="40"
								       value="1"/>
								<label class="cmplz-label" for="cmplz-statistics-{consent_type}" tabindex="0"><span>{category_statistics}</span></label>
							</span>
						</span>
				</summary>
				<div class="cmplz-description">
					<span class="cmplz-description-statistics">{statistics_text}</span>
					<span class="cmplz-description-statistics-anonymous">{statistics_text_anonymous}</span>
				</div>
			</details>
			<details class="cmplz-category cmplz-marketing" open>
				<summary>
						<span class="cmplz-category-header">
							<span class="cmplz-category-title">{category_marketing}</span>
								<span class="cmplz-banner-checkbox">
									<input type="checkbox"
									       id="cmplz-marketing-{consent_type}"
									       data-category="cmplz_marketing"
									       class="cmplz-consent-checkbox cmplz-marketing"
									       size="40"
									       value="1"/>
									<label class="cmplz-label" for="cmplz-marketing-{consent_type}" tabindex="0"><span>{category_marketing}</span></label>
								</span>
						</span>
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
		<a class="cmplz-link cmplz-manage-third-parties cookie-statement" href="#" data-relative_url="#cmplz-cookies-overview"><?php _e("Manage services","complianz-gdpr")?></a>
		<a class="cmplz-link cmplz-manage-vendors tcf cookie-statement" href="#" data-relative_url="#cmplz-tcf-wrapper"><?php _e("Manage vendors","complianz-gdpr")?></a>
		<a class="cmplz-link cmplz-external cmplz-read-more-purposes tcf" target="_blank" rel="noopener noreferrer nofollow" href="https://cookiedatabase.org/tcf/purposes/"><?php _e("Read more about these purposes","complianz-gdpr")?></a>
		<?php do_action("cmplz_after_links")?>
	</div>

	<div class="cmplz-divider cmplz-footer"></div>

	<div class="cmplz-buttons">
		<button class="cmplz-btn cmplz-accept">{accept_{consent_type}}</button>
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
