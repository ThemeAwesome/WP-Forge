<?php
/**
 * Creates minified css via PHP.
 *
 * @author  Carlos Rios
 * @package  PHP_CSS
 * @version  1.1
 */

class WP_FORGE_INLINE_CSS {

	/**
	 * The css selector that you're currently adding rules to
	 *
	 * @access protected
	 * @var string
	 */
	protected $_selector = '';

	/**
	 * Stores the final css output with all of its rules for the current selector.
	 *
	 * @access protected
	 * @var string
	 */
	protected $_selector_output = '';

	/**
	 * Can store a list of additional selector states which can be added and removed.
	 *
	 * @access protected
	 * @var array
	 */
	protected $_selector_states = array();

	/**
	 * Stores a list of css properties that require more formating
	 *
	 * @access private
	 * @var array
	 */
	private $_special_properties_list = array(
		'border-radius',
		'border-top-left-radius',
		'border-top-right-radius',
		'border-bottom-left-radius',
		'border-bottom-right-radius',
		'box-shadow',
		'transition',
		'transition-delay',
		'transition-duration',
		'transition-property',
		'transition-timing-function',
		'background-image',
	);

	/**
	 * Stores all of the rules that will be added to the selector
	 *
	 * @access protected
	 * @var string
	 */
	protected $_css = '';

	/**
	 * The string that holds all of the css to output
	 *
	 * @access protected
	 * @var string
	 */
	protected $_output = '';

	/**
	 * Stores media queries
	 * 
	 * @var null
	 */
	protected $_media_query = null;

	/**
	 * The string that holds all of the css to output inside of the media query
	 *
	 * @access protected
	 * @var string
	 */
	protected $_media_query_output = '';

	/**
	 * Sets a selector to the object and changes the current selector to a new one
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  string $selector - the css identifier of the html that you wish to target
	 * @return $this
	 */
	public function set_selector( $selector = '' )
	{
		// Render the css in the output string everytime the selector changes
		if( $this->_selector !== '' ){
			$this->add_selector_rules_to_output();
		}
		$this->_selector = $selector;
		return $this;
	}

	/**
	 * Wrapper for the set_selector method, changes the selector to add new rules
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @see    set_selector()
	 * @param  string $selector
	 * @return $this
	 */
	public function change_selector( $selector = '' )
	{
		return $this->set_selector( $selector );
	}

	/**
	 * Adds a pseudo class to the selector ex. :hover, :active, :focus
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  $state - the selector state
	 * @param  $reset - if true the $_selector_states variable will be reset
	 * @return $this
	 */
	public function add_selector_state( $state, $reset = true )
	{
		if( $reset ){
			$this->reset_selector_states();
		}
		$this->_selector_states[] = $state;
		return $this;
	}

	/**
	 * Adds multiple pseudo classes to the selector
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  array $states - the states you would like to add
	 * @return $this
	 */
	public function add_selector_states( $states = array() )
	{
		$this->reset_selector_states();
		foreach( $states as $state )
		{
			$this->add_selector_state( $state, false );
		}
		return $this;
	}

	/**
	 * Removes the selector's pseudo classes
	 * 
	 * @access public
	 * @since  1.0
	 * 
	 * @return $this
	 */
	public function reset_selector_states()
	{
		$this->add_selector_rules_to_output();
		if( !empty( $this->_selector_states ) ){
			$this->_selector_states = array();
		}
		return $this;
	}

	/**
	 * Adds a new rule to the css output
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  string $property - the css property
	 * @param  string $value - the value to be placed with the property
	 * @param  string $prefix - not required, but allows for the creation of a browser prefixed property
	 * @return $this
	 */
	public function add_rule( $property, $value, $prefix = null )
	{
		$format = is_null( $prefix ) ? '%1$s:%2$s;' : '%3$s%1$s:%2$s;';
		$this->_css .= sprintf( $format, $property, $value, $prefix );
		return $this;
	}

	/**
	 * Adds browser prefixed rules, and other special rules to the css output
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  string $property - the css property
	 * @param  string $value - the value to be placed with the property
	 * @return $this
	 */
	public function add_special_rules( $property, $value )
	{
		// Switch through the property types and add prefixed rules
		switch ( $property ) {
			case 'border-top-left-radius':
				$this->add_rule( $property, $value );
				$this->add_rule( $property, $value, '-webkit-' );
				$this->add_rule( 'border-radius-topleft', $value, '-moz-' );
			break;
			case 'border-top-right-radius':
				$this->add_rule( $property, $value );
				$this->add_rule( $property, $value, '-webkit-' );
				$this->add_rule( 'border-radius-topright', $value, '-moz-' );
			break;
			case 'border-bottom-left-radius':
				$this->add_rule( $property, $value );
				$this->add_rule( $property, $value, '-webkit-' );
				$this->add_rule( 'border-radius-bottomleft', $value, '-moz-' );
			break;
			case 'border-bottom-right-radius':
				$this->add_rule( $property, $value );
				$this->add_rule( $property, $value, '-webkit-' );
				$this->add_rule( 'border-radius-bottomright', $value, '-moz-' );
			break;
			case 'background-image':
				$this->add_rule( $property, sprintf( "url('%s')", $value ) );
			break;
			default:
				$this->add_rule( $property, $value );
				$this->add_rule( $property, $value, '-webkit-' );
				$this->add_rule( $property, $value, '-moz-' );
			break;
		}

		return $this;
	}

	/**
	 * Adds a css property with value to the css output
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  string $property - the css property
	 * @param  string $value - the value to be placed with the property
	 * @return $this
	 */
	public function add_property( $property, $value )
	{
		if( in_array( $property, $this->_special_properties_list ) ) {
			$this->add_special_rules( $property, $value );
		} else {
			$this->add_rule( $property, $value );
		}
		return $this;
	}

	/**
	 * Adds multiple properties with their values to the css output
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @param  array $properties - a list of properties and values
	 * @return $this
	 */
	public function add_properties( $properties )
	{
		foreach( (array) $properties as $property => $value )
		{
			$this->add_property( $property, $value );
		}
		return $this;
	}

	/**
	 * Sets a media query in the class
	 *
	 * @since  1.1
	 * @param  string $value
	 * @return $this
	 */
	public function start_media_query( $value )
	{
		// Add the current rules to the output
		$this->add_selector_rules_to_output();

		// Add any previous media queries to the output
		if( $this->has_media_query() ) {
			$this->add_media_query_rules_to_output();
		}

		// Set the new media query
		$this->_media_query = $value;
		return $this;
	}

	/**
	 * Stops using a media query.
	 *
	 * @see start_media_query()
	 *
	 * @since 1.1
	 * @return $this
	 */
	public function stop_media_query()
	{
		return $this->start_media_query( null );
	}

	/**
	 * Gets the media query if it exists in the class
	 *
	 * @since  1.1
	 * @return string|int|null
	 */
	public function get_media_query()
	{
		return $this->_media_query;
	}

	/**
	 * Checks if there is a media query present in the class
	 *
	 * @since  1.1
	 * @return boolean
	 */
	public function has_media_query()
	{
		if( ! empty( $this->get_media_query() ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Adds the current media query's rules to the class' output variable
	 *
	 * @since  1.1
	 * @return $this
	 */
	private function add_media_query_rules_to_output()
	{
		if( !empty( $this->_media_query_output ) ) {
			$this->_output .= sprintf( '@media all and %1$s{%2$s}', $this->get_media_query(), $this->_media_query_output );

			// Reset the media query output string
			$this->_media_query_output = '';
		}

		return $this;
	}

	/**
	 * Adds the current selector rules to the output variable
	 *
	 * @access private
	 * @since  1.0
	 *
	 * @return $this
	 */
	private function add_selector_rules_to_output()
	{
		if( !empty( $this->_css ) ) {
			$this->prepare_selector_output();
			$selector_output = sprintf( '%1$s{%2$s}', $this->_selector_output, $this->_css );
			
			if( $this->has_media_query() ) {
				$this->_media_query_output .= $selector_output;
				$this->reset_css();
			} else {
				$this->_output .= $selector_output;
			}

			// Reset the css
			$this->reset_css();
		}

		return $this;
	}

	/**
	 * Prepares the $_selector_output variable for rendering
	 *
	 * @access private
	 * @since  1.0
	 *
	 * @return $this
	 */
	private function prepare_selector_output()
	{
		if( ! empty( $this->_selector_states ) ) {
			// Create a new variable to store all of the states
			$new_selector = '';

			foreach( (array) $this->_selector_states as $state ){
				$format = end($this->_selector_states) === $state ? '%1$s%2$s' : '%1$s%2$s,';
				$new_selector .= sprintf( $format, $this->_selector, $state );
			}
			$this->_selector_output = $new_selector;
		}else{
			$this->_selector_output = $this->_selector;
		}
		return $this;
	}

	/**
	 * Resets the css variable
	 *
	 * @access private
	 * @since  1.1
	 * 
	 * @return void
	 */
	private function reset_css()
	{
		$this->_css = '';
		return;
	}

	/**
	 * Returns the minified css in the $_output variable
	 *
	 * @access public
	 * @since  1.0
	 * 
	 * @return string
	 */
	public function css_output()
	{
		// Add current selector's rules to output
		$this->add_selector_rules_to_output();

		// Output minified css
		return $this->_output;
	}

}
