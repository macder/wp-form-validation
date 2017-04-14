<?php
namespace WFV;
defined( 'ABSPATH' ) or die();

/**
 * General class accessor methods
 *
 * @since 0.8.0
 */
trait AccessorTrait {

  /**
   * __get magic method
   *
   * @since 0.8.0
   * @param string $property
   *
   * @return
   */
  public function __get( $property ) {
    return ( true === $this->has( $property ) ) ? $this->$property : null;
  }

  /**
   * Get array of instance properties
   *
   *
   * @since 0.7.2
   *
   * @return array Associative array, key/value pairs of instance props.
   */
  public function get_array() {
    return get_object_vars( $this );
  }

  /**
   * Check if property exists
   *
   * @since 0.8.0
   * @param string $property
   *
   * @return bool
   */
  public function has( $property ) {
    return ( true === property_exists( $this, $property ) ) ? true : false;
  }

}