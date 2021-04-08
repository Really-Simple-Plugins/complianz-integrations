<?php
/* Force consent cookies on the roo as shown below, or choose a subfolder 
* Add subfolder between '' on line 6
*/
function my_cookie_path($path) {
    return '';
}
add_filter( 'cmplz_cookie_path', 'my_cookie_path'); 
