<?php

  function cmplz_my_showbanner() {
    ?>
    <script>
          jQuery(document).ready(function ($) {
              $(document).on('click', '.cmplz-show-banner', function(){
                  $('.cc-revoke').click();
              });
          });
    </script>
    <?php
  }
  add_action( 'wp_footer', 'cmplz_my_showbanner' );