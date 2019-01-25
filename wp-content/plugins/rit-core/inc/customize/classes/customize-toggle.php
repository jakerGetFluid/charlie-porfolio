<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.0.3
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */
class WP_Customize_Toggle_Control extends WP_Customize_Control {

/**
* The type of customize control being rendered.
*/

public $type = 'toggle';

/**
* Displays the multiple select on the customize screen.
*/

public function render_content() {

	?>

	<label>

	    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if($this->description!=''){?><span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span><?php }?>
	    <div class="customize-control-<?php echo esc_html( $this->type ); ?>-checkbox ">

			<input type="checkbox" class="rit-toggle" id="<?php echo esc_attr( $this->id ); ?>-checkbox" value="1"
			<?php $this->link(); checked( $this->value(), 1 ); ?> />
			<label for="<?php echo esc_attr( $this->id ); ?>-checkbox"></label>

	    </div>
	</label>

	<?php }
}
