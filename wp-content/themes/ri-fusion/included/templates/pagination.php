<?php
/**
 * Pagination template
 * @package WordPress
 * @subpackage ri-fusion
 * @since ri-fusion 1.0
 */
?>
<div class="wrap-pagination">
    <?php
    if (function_exists("rit_pagination")) :
        rit_pagination(3, '', '', esc_html__('Previous', 'ri-fusion'), esc_html__('Next', 'ri-fusion'));
    else:
        ?>
        <div class="rit-pagination-left pull-left primary-font default-pagination"><?php
            previous_posts_link(esc_html__('NEWER POST', 'ri-fusion'));
        ?>
        </div>
        <div class="rit-pagination-right pull-right primary-font default-pagination">
            <?php
            next_posts_link(esc_html__('OLDER POST', 'ri-fusion'));
            ?>
        </div>
        <?php
    endif;
    ?>
</div>