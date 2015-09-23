<?php
/**
 * switch Customizer Control.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'Kirki_Controls_Switch_Control' ) ) {
	return;
}

class Kirki_Controls_Switch_Control extends WP_Customize_Control {

	public $type = 'switch';

	public function enqueue() {
		wp_enqueue_script( 'kirki-switch', trailingslashit( kirki_url() ) . 'includes/controls/switch/script.js', array( 'jquery' ) );
	}

	public function to_json() {
		parent::to_json();
		$i18n = Kirki_Toolkit::i18n();
		$this->choices = ( empty( $this->choices ) || ! is_array( $this->choices ) ) ? array() : $this->choices;
		$this->choices['on']    = ( isset( $this->choices['on'] ) ) ? $this->choices['on'] : $i18n['on'];
		$this->choices['off']   = ( isset( $this->choices['off'] ) ) ? $this->choices['off'] : $i18n['off'];
		$this->choices['round'] = ( isset( $this->choices['round'] ) ) ? $this->choices['round'] : false;

		$this->json['id']      = $this->id;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
	}

	protected function content_template() { ?>
		<div class="switch<# if ( data.choices['round'] ) { #> round<# } #>">
			<span class="customize-control-title">
				{{{ data.label }}}
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</span>
			<input name="switch_{{ data.id }}" id="switch_{{ data.id }}" type="checkbox" value="{{ data.value }}" {{{ data.link }}}<# if ( '1' == data.value ) { #> checked<# } #> />
			<label class="switch-label" for="switch_{{ data.id }}">
				<span class="switch-on">{{ data.choices['on'] }}</span>
				<span class="switch-off">{{ data.choices['off'] }}</span>
			</label>
		</div>
		<?php
	}
}
