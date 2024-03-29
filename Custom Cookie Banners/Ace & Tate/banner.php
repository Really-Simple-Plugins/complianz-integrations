<?php

/**
 * Override cookiebanner template html
 * @param string $html
 *
 * @return string
 */

function cmplz_custom_banner_file($path, $filename){
  if ($filename === 'cookiebanner.php' ) {
    error_log("change path to ".trailingslashit(WPMU_PLUGIN_DIR).'cookiebanner/cookiebanner.php');
    return trailingslashit(WPMU_PLUGIN_DIR).'cookiebanner/cookiebanner.php';
  }
  return $path;
}

add_filter('cmplz_template_file', 'cmplz_custom_banner_file', 10, 2);

/**
 * Completely override CSS generated by Complianz
 * @param string $css
 *
 * @return string
 */

 /**
  * Add custom css to banner css file
  * @return void
  */
 function add_my_custom_banner_css() {
 	?>


@media (min-width: 426px) {
  .cmplz-cookiebanner {
    width:426px;
  }
}
.cmplz-cookiebanner {
  filter: drop-shadow(rgba(0, 0, 0, 0.05) 0px 0px 15px);
  max-width:unset!important;
  bottom: 1em;
}


.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-category-header {
    display: flex;
    justify-content: space-between;
}

.cmplz-cookiebanner .cmplz-buttons .cmplz-btn.cmplz-view-preferences,
.cmplz-cookiebanner .cmplz-buttons .cmplz-btn.cmplz-save-preferences {
  background: white;
  text-decoration:underline;
  border:none;
}

.cmplz-categories-visible .cmplz-message,
.cmplz-categories-visible .cmplz-title,
.cmplz-categories-visible .cmplz-header
 {
    display: none!important;
}

.cmplz-categories-visible .cmplz-message-title {
    display: block!important;
}

.cmplz-message-title {
    display: none;
}

.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-category-header {
    grid-template-columns: 1fr auto 0px;
}

.cmplz-cookiebanner .cmplz-title:before,
#cmplz-manage-consent .cmplz-manage-consent:before {
    content: "🍪";
    margin-right: 10px;
}
.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-category-header .cmplz-category-title {
  font-weight:600;
}

.cmplz-cookiebanner a {
  cursor:pointer;
  text-decoration:underline;
}

.cmplz-cookiebanner .cmplz-header .cmplz-title {
    display: block;
}

.cmplz-cookiebanner .cmplz-links .cmplz-link {
    display:none;
}

details.cmplz-category.cmplz-functional {
    border-left: 2px solid green;
    opacity: 0.5;
}

.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-description, .cmplz-category-title {
    font-size: 18px!important;
    background: white;
}
.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-description {
    border: 1px solid #eee;
    border-top: none;
}

.cmplz-cookiebanner .cmplz-categories .cmplz-category .cmplz-category-header {
    border: 1px solid #eee;
    background: white;
    border-bottom:none;
}

.cmplz-cookiebanner .cmplz-header {
  display:flex;
}

.cmplz-cookiebanner .cmplz-body {
    line-height: 28px;
    font-weight:300;
    max-height: 67px;
    overflow-y:hidden;
    transition: max-height 0.15s ease-out;
}
.cmplz-categories-visible > .cmplz-body {
    line-height: 28px;
    transition: max-height 1.15s ease-in;    
    font-weight:300;
    max-height: 1000px;
    z-index:99;
}

.cmplz-cookiebanner:hover > .cmplz-body {
    line-height: 28px;
    transition: max-height 1.15s ease-in;    
    font-weight:300;
    max-height: 1000px;
    z-index:99;
}

.cmplz-cookiebanner .cmplz-body{overflow-y:hidden;}
  .cmplz-cookiebanner .cmplz-links {display:none;}
  .cmplz-custom-border {}
  .cmplz-cookiebanner .cmplz-buttons {
    display: flex;
    gap: var(--cmplz_banner_margin);
    flex-direction: row-reverse;
}

 	<?php
 }
 add_action( 'cmplz_banner_css', 'add_my_custom_banner_css' );

 /**
 * IMPORTANT! This function should not be used live. It is added so the css will be regenerated on each page load, so you don't have to save the banner settings to get the new css file.
 *
 * @return void
 */
function regenerate_banner(){
	$banners = cmplz_get_cookiebanners();
	if ( $banners ) {
		foreach ( $banners as $banner_item ) {
			$banner = new CMPLZ_COOKIEBANNER( $banner_item->ID );
			$banner->save();
		}
	}
}
add_action('init', 'regenerate_banner');
