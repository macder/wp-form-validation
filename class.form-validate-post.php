<?php defined( 'ABSPATH' ) or die();

/**
 * Summary
 *
 * Description
 *
 * @since 0.2.0
 */
class Form_Validate_Post {

  /**
   * Sanitized post data
   *
   * @since 0.2.0
   * @access protected
   * @var array Sanitized $_POST
   */
  protected $input = array();


  /**
   * Instance of Valitron\Validator
   *
   * @since 0.2.0
   * @access public
   * @var class $valitron Valitron\Validator.
   */
  public $valitron;


  /**
   * __construct
   *
   * @since 0.2.0
   * @param array $rules Validation rules
   *
   */
  function __construct($rules) {
    $this->rules = $rules;
    $this->sanitize_post();
    $this->create_valitron();

    print_r($this);
  }

  /**
   * Sanitize input and keys in $_POST
   * Assign the sanitized data to $sane_post property
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function sanitize_post() {
    foreach ( $_POST as $key => $value ) {
      $this->input[sanitize_key($key)] = sanitize_text_field($value);
    }
  }

  /**
   * Create an instance of Valitron\Validator, assign to $valitron property
   * Map $rules property Valitron
   *
   *
   * @since 0.2.0
   * @access private
   */
  private function create_valitron() {
    $this->valitron = new Valitron\Validator($this->sane_post);
    $this->valitron->mapFieldsRules($this->rules);
  }
}
