<?php
   /*
   Plugin Name: Post Mailer
   Plugin URI: https://github.com/finnbear/wp-post-mailer
   Version: 1.0
   Author: Finn Bear
   Author URI: https://www.finnbear.com
   */

   defined( 'ABSPATH' ) or die( 'Post Mailer not loaded by WordPress.' );

   function post_mailer_activate() {

   }

   function post_mailer_deactivate() {

   }

   function post_mailer_uninstall() {

   }

   function post_mailer_form_shortcode() {
    ob_start();

    if (isset($_POST['submit'])) {
      echo "<p>Recieved.</p>";
    }

    return ob_get_clean();
   }

   register_activation_hook(__FILE__, 'post_mailer_activate');
   register_deactivation_hook(__FILE__, 'post_mailer_deactivate');
   register_uninstall_hook(__FILE__, 'post_mailer_uninstall');

   add_shortcode('post_mailer_form', 'post_mailer_form_shortcode');
?>