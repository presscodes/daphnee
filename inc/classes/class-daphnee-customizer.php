<?php

class Daphnee_Customizer extends Daphnee {

    /**
     * The class constructor
     */
    public function __construct() {
        add_action( 'customize_controls_print_styles', array( $this, 'custom_css' ) );
    }

    /**
     * Adds a wrapper to the input and allows us to use a proper "update" box.
     *
     * @param $title    string  the title of the info box
     * @param $content  string  the content of the info box
     * @return  string  the input wrapped properly.
     */
    public static function update_info_wrapper( $title = '', $content = '' ) {
        // Open wrapper div
        $html  = '<div class="plus-info-control">';
        // Add the title if one is defined
        $html .= ( '' == $title ) ? '' : '<h3>' . $title . '</h3>';
        // Add the upgrade button-link
        $html .= '<a class="daphnee-plus-link" target="_blank" href="' . Daphnee()->plus_link . '">' . __( 'Upgrade to Plus', 'daphnee' ) . '</a>';
        // Add the content
        $html .= $content;
        // Close the wrapper div
        $html .= '</div>';

        return $html;
    }

    /**
     * Add some custom CSS to the customizer screen.
     */
    public function custom_css() { ?>
    	<style>
    	#customize-control-layout.customize-control-radio-image .image.ui-buttonset label {
    		max-width: 29%;
    	}
    	#customize-control-layout.customize-control-radio-image .image.ui-buttonset label img {
    		width: 100%;
    		height: auto;
    	}
    	.customize-control-slider input[type="text"] {
    		background: transparent;
    	}
    	a.daphnee-plus-link {
    		font-size: 10px;
    		text-transform: uppercase;
    		color: #fff;
    		padding: 2px 10px;
    		background: red;
    		margin-left: 5px;
    	}
    	.plus-info-control {
    		border: 1px solid rgba(0,0,0,.2);
    		padding: 20px;
    	}
    	</style>
    	<?php
    }

    /**
     * Returns the initial value * 2.
     * Used to calculate the font-size of H1 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x2
     */
    public static function h1_sanitize_size( $value ) {
    	return ( 2 * $value );
    }

    /**
     * Returns the initial value * 1.5.
     * Used to calculate the font-size of H2 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x1.5
     */
    public static function h2_sanitize_size( $value ) {
    	return ( 1.5 * $value );
    }

    /**
     * Returns the initial value * 1.17.
     * Used to calculate the font-size of H3 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x1.17
     */
    public static function h3_sanitize_size( $value ) {
    	return ( 1.17 * $value );
    }

    /**
     * Returns the initial value * 1.
     * Used to calculate the font-size of H4 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x1
     */
    public static function h4_sanitize_size( $value ) {
    	return ( 1 * $value );
    }

    /**
     * Returns the initial value * 0.83.
     * Used to calculate the font-size of H5 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x0.83
     */
    public static function h5_sanitize_size( $value ) {
    	return ( .83 * $value );
    }

    /**
     * Returns the initial value * 0.67.
     * Used to calculate the font-size of H6 headers.
     *
     * @param   $value  int|float   the input font-size
     * @return  int|float           the input font-size x0.67
     */
    public static function h6_sanitize_size( $value ) {
    	return ( .67 * $value );
    }

    /**
     * Calculate a color that will be readable against a specific background-color.
     *
     * @param   $value  string  the background color in question
     * @return  string  a color that is readable against this background-color.
     */
    public static function max_readability( $value ) {
        /**
         * The lumosity difference between the background color and white
         */
    	$lumosity_difference_to_white = Kirki_Color::lumosity_difference( $value, '#ffffff' );
        /**
         * The lumosity difference between the background color and #333 (dark grey)
         */
    	$lumosity_difference_to_black = Kirki_Color::lumosity_difference( $value, '#333333' );
        /**
         * Return whitre or #333333 depending on which lumosity difference is greater.
         */
    	return ( $lumosity_difference_to_black > $lumosity_difference_to_white ) ? '#333333' : '#ffffff';
    }

}
