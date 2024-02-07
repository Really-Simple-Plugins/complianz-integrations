<?php
add_action( 'upgrader_process_complete', 'cmplz_remove_unused_translations', 10, 1);

//this hook can be removed after initial use, as the upgrader process complete runs after each update
add_action('plugins_loaded', 'cmplz_remove_unused_translations', 20);
function cmplz_remove_unused_translations(): void {
	if ( !defined('cmplz_path')){
		return;
	}

	//only if logged in or cron
	if ( !cmplz_admin_logged_in() ) {
		return;
	}

	$path = cmplz_path. "languages";
	$extensions = array( "po", "mo", "json" );
	$locales= ['en_US', 'nl_NL'];
	if ( $handle = opendir( $path ) ) {
		while ( false !== ( $file = readdir( $handle ) ) ) {
			if ( $file !== "." && $file !== ".." ) {
				$file = $path . '/' . $file;
				$ext  = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );

				if ( is_file( $file )
				     && in_array( $ext, $extensions )
				     && !cmplz_string_contains_locale( $file, $locales )
				) {
					unlink($file);
				}
			}
		}
		closedir( $handle );
	}
}

function cmplz_string_contains_locale($string, $locales): bool {
	foreach ($locales as $locale) {
		if ( str_contains( $string, $locale ) ) {
			return true;
		}
	}
	return false;
}