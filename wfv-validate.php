<?php defined( 'ABSPATH' ) or die();
/*
Plugin Name: WFV - Form Validation
Plugin URI:  https://github.com/macder/wp-form-validation
Description: See README.md
Version:     0.7.6
Author:      Maciej Derulski
Author URI:  https://derulski.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

define( 'WFV_VALIDATE_VERSION', '0.7.6' );
define( 'WFV_VALIDATE__MINIMUM_WP_VERSION', '4.7' ); // not tested with other versions
define( 'WFV_VALIDATE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'WFV_VALIDATE__ACTION_POST', 'validate_form' );

require_once( WFV_VALIDATE__PLUGIN_DIR . '/vendor/vlucas/valitron/src/Valitron/Validator.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/interface/Validation.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/trait/Accessor.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/trait/Mutator.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Errors.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Form.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Input.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Messages.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Rules.php' );
require_once( WFV_VALIDATE__PLUGIN_DIR . 'src/class/Validator.php' );

/**
 * Instantiate and return a new WFV_VALIDATE
 * Specific to the form defined in $name
 *
 * @since 0.3.0
 * @since 0.4.0 reduced to single array parameter
 * @since 0.5.0 $form parameter creates reference
 *
 * @param array $form Form configuration (rules, action)
 */
function wfv_create( &$validation ) {
  // TODO: make a factory for this...
  $action = $validation['action'];
  $rules = new WFV\Rules();
  $rules->set( $validation['rules'] );
  $input = new WFV\Input( $action );
  $messages = new WFV\Messages( $validation['messages'] );
  $errors = new WFV\Errors();
  $validation = new WFV\Validator( $action, $rules, $input, $messages, $errors );
  // action or like this?
  if ( $validation->is_safe() ) {
    $validation->validate();
  }
}
