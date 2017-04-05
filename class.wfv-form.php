<?php defined( 'ABSPATH' ) or die();

/**
 * Form_Validation validate a form
 *
 * Validates a form against an array of rules using Valitron
 *
 * @since 0.1.0
 * @since 0.5.2 Renamed from Form_Validation
 */
// class Form_Validation {
class WFV_Form extends WFV_Validate {

  /**
   * Class constructor
   *
   * @since 0.1.0
   * @since 0.4.0 Reduced to single parameter
   * @param array $form Form configuration (rules, action)
   *
   */
  function __construct( $form ) {
    $this->set_properties( $form );
  }

  /**
   * Assign $form config to properties
   *
   * @since 0.4.0
   * @since 0.5.1 Renamed from set_config
   * @param array $form Form configuration
   * @access private
   */
  private function set_properties( $form ) {
    foreach( $form as $property => $value ) {
      $this->$property = $value;
    }
    $this->create_nonce_field();
  }

  /**
   * Create a wp_nonce_field
   * Assign to $nonce_field property
   *
   * @since 0.3.0
   * @access private
   */
  private function create_nonce_field() {
    $nonce_action = $this->action;
    $nonce_name = $this->action . '_token';
    $this->nonce_field = wp_nonce_field( $nonce_action, $nonce_name, false, false );
  }

  /**
   * If $_POST, check if action attr matches $action property
   * Sanitize and assign $_POST to $input property
   *
   * @since 0.2.1
   * @since 0.6.0 Renamed from is_retry
   * @access private
   *
   */
  public function catch_post() {
    if ( $_POST && $_POST['action'] === $this->action ) {
      $this->sanitize_post();
      $this->trigger_post_action();
    }
  }

  /**
   * Executes function(s) hooked into validate_form action
   * Passes this class as parameter
   *
   * @since 0.1.0
   * @since 0.2.0 POST logic moved to Form_Validation_Post
   */
  private function trigger_post_action() {
    do_action( FORM_VALIDATION__ACTION_POST, $this );
  }
}
