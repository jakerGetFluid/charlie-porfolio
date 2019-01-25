<?php

/**
 * Multiple select customize control class.
 */
class WP_Customize_Info_Control extends WP_Customize_Control
{

    /**
     * The type of customize control being rendered.
     */
    public $type = 'info';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content()
    {
        ?> 
        <div class="rit-info-custom">
            <p><span><?php echo esc_html( $this->label ); ?></span><?php echo esc_html( $this->description ); ?></p>            
        </div>
        <?php
    }

}