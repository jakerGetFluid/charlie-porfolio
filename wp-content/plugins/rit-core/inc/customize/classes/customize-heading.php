<?php

/**
 * Multiple select customize control class.
 */
class WP_Customize_Heading_Control extends WP_Customize_Control
{

    /**
     * The type of customize control being rendered.
     */
    public $type = 'heading';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content()
    {
        ?>
        <div class="rit-heading-custom">
            <h4><?php echo esc_html( $this->label ); ?></h4>
        </div>
        <?php
    }

}