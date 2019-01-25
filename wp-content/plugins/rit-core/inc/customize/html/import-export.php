<span class="customize-control-title">
    <?php esc_html_e('Export', 'rit-core-language'); ?>
</span>
<span class="description customize-control-description">
    <?php esc_html_e('Click the button below to export the customization settings for this theme.', 'rit-core-language'); ?>
</span>
<input type="button" class="button" name="rit-export-button"
       value="<?php esc_attr(esc_html_e('Export', 'rit-core-language')); ?>"/>

<hr class="rit-hr"/>

<span class="customize-control-title">
    <?php esc_html_e('Import', 'rit-core-language'); ?>
</span>
<span class="description customize-control-description">
    <?php esc_html_e('Upload a file to import customization settings for this theme.', 'rit-core-language'); ?>
</span>
<div class="rit-import-controls">
    <input type="file" name="rit-import-file" class="rit-import-file"/>
    <label class="rit-import-images">
        <input type="checkbox" name="rit-import-images"
               value="1"/> <?php esc_html_e('Download and import image files?', 'rit-core-language'); ?>
    </label>
    <?php wp_nonce_field('rit-importing', 'rit-import'); ?>
</div>
<div class="rit-uploading"><?php esc_html_e('Uploading...', 'rit-core-language'); ?></div>
<input type="button" class="button" name="rit-import-button"
       value="<?php esc_attr(esc_html_e('Import', 'rit-core-language')); ?>"/>