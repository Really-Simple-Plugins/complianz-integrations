/**
 * Script provided to improve backwards compatibility
 */


jQuery(document).ready(function ($) {
	$(document).on("cmplz_before_cookiebanner", cmplz_migrate_cmplzRunBeforeAllScripts);
	function cmplz_migrate_cmplzRunBeforeAllScripts() {
		var event = new CustomEvent('cmplzRunBeforeAllScripts');
		document.dispatchEvent(event);
	}

	$(document).on("cmplz_run_after_all_scripts", cmplz_migrate_cmplzRunBeforeAllScripts);
	function cmplz_migrate_cmplzRunBeforeAllScripts() {
		var event = new CustomEvent('cmplzRunAfterAllScripts');
		document.dispatchEvent(event);
	}

	$(document).on("cmplz_tag_manager_event", cmplz_migrate_cmplzRunBeforeAllScripts);
	function cmplz_migrate_cmplzRunBeforeAllScripts() {
		var event = new CustomEvent('cmplzTagManagerEvent');
		document.dispatchEvent(event);
	}

	$(document).on("cmplz_revoke", cmplz_migrate_cmplzRunBeforeAllScripts);
	function cmplz_migrate_cmplzRunBeforeAllScripts() {
		var event = new CustomEvent('cmplzRevoke');
		document.dispatchEvent(event);
	}

	/**
	 * Backward compatibility for the cmplzEnableScripts event
	 */

	$(document).on("cmplz_enable_category", cmplz_migrate_cmplzEnableScripts);
	function cmplz_migrate_cmplzEnableScripts(consentData) {
		var category = consentData.detail.category;
		var event = new CustomEvent('cmplzEnableScripts', { detail: category });
		document.dispatchEvent(event);

		if (category==='marketing'){
			var event = new CustomEvent('cmplzAcceptAll', { detail: consentData });
			document.dispatchEvent(event);
		}
	}

	$(document).on("cmplz_fire_categories", cmplz_migrate_cmplzEnableScripts);
	function cmplz_migrate_cmplzEnableScripts(details) {
		var category = consentData.detail;
		var event = new CustomEvent('cmplzFireCategories', { detail: details });
		document.dispatchEvent(event);
	}

	$(document).on("cmplz_cookie_warning_loaded", cmplz_migrate_cmplzEnableScripts);
	function cmplz_migrate_cmplzEnableScripts(details) {
		var category = consentData.detail;
		var event = new CustomEvent('cmplzCookieWarningLoaded', { detail: details });
		document.dispatchEvent(event);
	}

	var cmplzTMFiredEvents = [];

	$(document).on("cmplzTagManagerEvent", cmplz_migrate_tagmanager_event);
	function cmplz_migrate_tagmanager_event(data) {
		var category = data.detail;

		if (cmplzTMFiredEvents.indexOf(category) === -1) {
			var event;
			cmplzTMFiredEvents.push(category);
			if (category==='marketing') {
				event = complianz.prefix + 'event_marketing';
			} else if ( category === 'statistics' ){
				event = complianz.prefix + 'event_0';
			} else if ( category === 'functional' ){
				event = complianz.prefix + 'event_functional';
			}
			console.log('fire ' + event);
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				'event': event
			});

			//fire event 1 as marketing
			if (category==='marketing') {
				window.dataLayer = window.dataLayer || [];
				window.dataLayer.push({
					'event': complianz.prefix + 'event_1'
				});
			}
		}
	}

	/**
	 * set a body class as previously done
	 */

	$(document).on("cmplz_track_status", cmplz_migrate_bodyclass);
	function cmplz_migrate_bodyclass(data) {
		var category = cmplzHighestAcceptedCategory();
		document.body.classList.add('cmplz-status-' + category);
	}

	$(document).on('click', '.cc-revoke-custom',function(event){
		event.preventDefault();
		cmplzDenyAll();
	});

	/**
	 *  Accept all cookie categories by clicking any other link cookie acceptance from a custom link
	 */

	$(document).on('click', '.cmplz-accept-cookies', function (event) {
		event.preventDefault();
		cmplzAcceptAll();
	});

	$(document).on('click', '.cmplz-save-settings', function (event) {
		event.preventDefault();
		$('.cmplz-save-preferences').click();
	});

})
