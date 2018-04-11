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
      $wantFreeBook = sanitize_text_field($_POST['wantFreeBook']);
      $wantFreeConsultation = sanitize_text_field($_POST['wantFreeConsultation']);
      $wantFreeDemo = sanitize_text_field($_POST['wantFreeDemo']);
      $comment = sanitize_textarea_field($_POST['comment']);

      # Checkboxes
      if ($wantFreeConsultation != "yes") {
        $wantFreeConsultation = "Not applicable";
      }

      if ($wantFreeConsultation != "yes") {
        $wantFreeConsultation = "no";
      }

      if ($wantFreeDemo != "yes") {
        $wantFreeDemo = "no";
      }

      $from = "wordpress@pdpsolutions.com";
      $to = POST_MAILER_EMAIL;

      $message = "<html><body><h1>$formName</h1><p><strong>First Name:</strong> $firstName</p><p><strong>Last Name:</strong> $lastName</p><p><strong>Email Address:</strong> $emailAddress</p><p><strong>Phone Number:</strong> $phoneNumber</p><p><strong>Company Name:</strong> $companyName</p><p><strong>Free eBook:</strong> $wantFreeBook</p><p><strong>Free Consultation:</strong> $wantFreeConsultation</p><p><strong>Free Demo:</strong> $wantFreeDemo</p><p><strong>Comment:</strong> $comment</p><br><p>This is an automated message. Do not reply.</p></body></html>";

      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: '.$from."\r\n" . 'Reply-To: '.$from."\r\n" . 'X-Mailer: PHP/' . phpversion();

      if (!wp_mail($to, "Consultation Form Submission", $message, $headers)) {
        echo "<script type='text/javascript'>alert('Error, please try again later.');</script>";
      }
    }

    return ob_get_clean();
   }

   register_activation_hook(__FILE__, 'post_mailer_activate');
   register_deactivation_hook(__FILE__, 'post_mailer_deactivate');
   register_uninstall_hook(__FILE__, 'post_mailer_uninstall');

   add_shortcode('post_mailer_form', 'post_mailer_form_shortcode');
?>