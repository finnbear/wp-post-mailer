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

      # Checkboxes
      if ($wantFreeConsultation != "yes") {
        $wantFreeConsultation = "no";
      }

      if ($wantFreeDemo != "yes") {
        $wantFreeDemo = "no";
      }

      $message = "<html><body><h1>Form Name:</h1> $formName\n<strong>First Name:</strong> $firstName\n<strong>Last Name:</strong> $lastName\n<strong>Email Address:</strong> $emailAddress\n<strong>Phone Number:</strong> $phoneNumber\n<strong>Company Name:</strong> $companyName\n<strong>Free Consultation:</strong> $wantFreeConsultation\n<strong>Free Demo:</strong> $wantFreeDemo<br><p>This is an automated message. Do not reply.</p></body></html>";

      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      if (wp_mail("odle6@finnbear.com", "Consultation Form Submission", $message, $headers)) {
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