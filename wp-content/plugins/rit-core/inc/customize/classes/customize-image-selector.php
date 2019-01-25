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
class WP_Customize_Layout_Control extends WP_Customize_Control {

/**
* The type of customize control being rendered.
*/

public $type = 'image-selector';

/**
* Displays the multiple select on the customize screen.
*/

public function render_content() {

	if ( empty( $this->choices ) )

	return;

	?>

	<label>
		<div class="customize-control-<?php echo esc_html( $this->type ); ?> ">
	    	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			
			<?php foreach ( $this->choices as $value => $label ) { ?>

				<?php $selected = $this->value(); ?>

				<label <?php echo( $value == $selected ) ? 'class="selected"' : ''; ?> >

					<input type="radio" name="rit_<?php echo esc_attr( $this->type ); ?>" value="<?php echo esc_attr( $value ); ?>" data-id="<?php echo $this->id; ?>"
						<?php echo ( $selected == $value ) ? 'checked="checked"' : '';?>
					>

					<?php if ( $label == 'none' ) { ?>

                    <img src="<?php echo RIT_PLUGIN_URL. 'rit-core/assets/images/c.png'; ?>" alt="<?php echo esc_attr('Image Selector','rit-core-language')?>" />

                    <?php } else { ?>

                    <img src="<?php echo esc_attr( $label ); ?>" alt="<?php echo esc_attr('Image Selector','rit-core-language')?>" />

                    <?php } ?>

				</label>

			<?php } ?>
		</div>
	</label>

	<?php }
}
