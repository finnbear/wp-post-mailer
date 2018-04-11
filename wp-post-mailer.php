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
      # Some infusionsoft fields
      $formName = sanitize_text_field($_POST['formName']);
      $firstName = sanitize_text_field($_POST['firstName']);
      $lastName = sanitize_text_field($_POST['lastName']);
      $emailAddress = sanitize_text_field($_POST['emailAddress']);
      $phoneNumber = sanitize_text_field($_POST['phoneNumber']);
      $companyName = sanitize_text_field($_POST['companyName']);
      $wantFreeConsultation = sanitize_text_field($_POST['wantFreeConsultation']);
      $wantFreeDemo = sanitize_textarea_field($_POST['wantFreeDemo']);

      $message = "Form Name: $formName
      First Name: $firstName
      Last Name: $lastName
      Email Address: $emailAddress
      Phone Number: $phoneNumber
      Company Name: $companyName
      Free Consultation: $wantFreeConsultation
      Free Demo: $wantFreeDemo";

      if (wp_mail("odle6@finnbear.com", "Consultation Form Submission", $message)) {
          echo "<script type='text/javascript'>alert('success');</script>";
      } else {
        echo "<script type='text/javascript'>alert('failure');</script>";
      }
    }

    return ob_get_clean();
   }

   register_activation_hook(__FILE__, 'post_mailer_activate');
   register_deactivation_hook(__FILE__, 'post_mailer_deactivate');
   register_uninstall_hook(__FILE__, 'post_mailer_uninstall');

   add_shortcode('post_mailer_form', 'post_mailer_form_shortcode');
?>