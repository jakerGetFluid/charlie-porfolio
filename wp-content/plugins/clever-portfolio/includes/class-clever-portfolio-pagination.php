<?php
/**
 * Clever_Portfolio_Pagination
 *
 * @package    Clever_Portfolio
 */
final class Clever_Portfolio_Pagination
{
    /**
     * Settings
     *
     * @see    Clever_Portfolio::$settings
     *
     * @var    array
     */
    private static $settings;

    /**
     * Instance
     *
     * @var    object
     */
    private static $instance;

    /**
     * Singleton
     */
    static function getInstance()
    {
        if ( !isset( self::$instance ) ) {
            self::$settings = get_option( Clever_Portfolio::OPTION_NAME );
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * The load more pagination.
     *
     * @param    string    $tpl       Base template without `.php` suffix.
     * @param    array     $atts      An array of AJAX attributes.
     * @param    string    $type      Type of the current portfolio page (archive or shortcode).
     * @param    string    $wrap      Selector of portfolios' container.
     * @param    string    $target    Selector of target element used for appending new portfolios.
     */
    function the_load_more( $tpl, array $atts, \WP_Query $query, $type, $wrap, $target, $isotope = false )
    {
        if ( $isotope ) {
             wp_enqueue_script('isotope');
         }
        wp_enqueue_script('imagesloaded');
        $clever_settings=clever_portfolio_get_settings();
        $max   = $query->max_num_pages;
        $paged = $query->query_vars['paged'] ? : 1;
        $attr  = '';
        $more  = $clever_settings['archive_loadmore_button_text'];
        $icon  = $clever_settings['archive_paging_icon'];

        if ($paged >= $max) {
            $attr = 'no-load';
            $more = $clever_settings['archive_nomore_load_text'];
        } else {
            $atts['paged'] = ($paged >= 1) ? $paged + 1 : 2;
            $tax = !empty($query->query_vars['portfolio_category']) ? $query->query_vars['portfolio_category'] : get_query_var('portfolio_category');
            $atts['taxonomy'] = !empty($atts['taxonomy']) ? $atts['taxonomy'] : $tax;
        }

        ?><div class="clever-ajax-load-more">
            <a href="#" class="ajax-func <?php echo $attr ?>">
                <span class="btn-ajax-load"><?php echo esc_html($more) ?></span>
                <i class="clever-loading <?php echo esc_attr($icon)?>"></i>
            </a>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    "use strict";
                    $('.ajax-func').on('click', function(e) {
                        e.preventDefault();
                        if ($(this).not('.no-load')[0]) {
                            $(this).addClass('loading');
                            var $this = $(this),
                                $wrap = $this.parents('<?php echo esc_js($wrap) ?>').find('<?php echo esc_js($target) ?>');
                            $.ajax({
                                url: "<?php echo admin_url('admin-ajax.php') ?>",
                                data: {
                                    action: 'clever_ajax_load_more',
                                    tpl: '<?php echo esc_js($tpl) ?>',
                                    tpl_type: '<?php echo $type ?>',
                                    atts: '<?php echo json_encode($atts) ?>'
                                },
                                method: 'POST'
                            })
                            .done(function(response) {
                                $this.removeClass('loading');
                                var content = $(response).find('<?php echo esc_js($target) ?>').html(),
                                    ajax_page = $(response).find('.clever-ajax-load-more').html(),
                                    $newElems = $(content).css({opacity: 0});
                                if ($newElems.find('img.lazy-img')[0]) {
                                    $newElems.find('img.lazy-img').each(function () {
                                        $(this).attr('src',$(this).data('original'));
                                    })
                                }
                                <?php if ( $isotope ) echo '$wrap.isotope();' ?>
                                $wrap.append($newElems);
                                $newElems.imagesLoaded(function() {
                                    $newElems.animate({opacity: 1});
                                    <?php if ($isotope) { ?>
                                        $wrap.isotope('appended', $newElems);
                                        $wrap.isotope('reloadItems');
                                    <?php } ?>
                                });
                                $this.parent().html(ajax_page);
                            })
                            .fail(function(response) {
                                console.log(response);
                            });
                        }
                    });
                });
            </script>
        </div><?php
    }

    /**
     * Ajax load more
     */
    function clever_ajax_load_more()
    {
        $dir  = sanitize_title( $_POST['tpl_type'] );
        $atts = json_decode( stripslashes($_POST['atts']), true );
        $tpl  = sanitize_title( $_POST['tpl'] ) . '.php';

        if ( isset( $_POST['taxonomy'] ) ) {
            $atts['taxonomy'] = sanitize_title($_POST['taxonomy']);
        }
        if($dir!=''){
            $template = locate_template('clever-portfolio/' . $dir . '/' . $tpl, false, false);
        }else{
            $template = locate_template('clever-portfolio/'. $tpl, false, false);
        }
        ob_start();

        if ( !$template ) {
            if($dir!='') {
                include dirname(__DIR__) . '/templates/' . $dir . '/' . $tpl;
            }else{
                include dirname(__DIR__) . '/templates/' . $tpl;
            }
        } else {
            include $template;
        }

        $html = ob_get_contents();

        ob_end_clean();

        exit($html);
    }

    /**
     * The infinite pagination.
     *
     * @param    string    $item    Selector of each portfolio.
     * @param    string    $wrap    Selector of portfolios' container.
     */
    function the_infinite( \WP_Query $query, $wrap, $item, $isotope = false )
    {
        if ( $isotope ) {
            wp_enqueue_script('isotope');
        }
        wp_enqueue_script('imagesloaded');
        wp_enqueue_script('infinite-scroll');
        $clever_settings=clever_portfolio_get_settings();
        $icon  = $clever_settings['archive_paging_icon'];
        $no_load  = $clever_settings['archive_nomore_load_text'];
        ?><div class="nav-load-more hidden">
             <?php $this->the_default($query, 3) ?>
        </div>
        <script>
            jQuery(document).ready(function($){
                "use strict";
                var infiniteScroll = {
                    loading: {
                        finishedMsg: '<?php echo esc_js($no_load)?>',
                        msgText: '<i class="clever-loading <?php echo esc_attr($icon);?>"></i> ',
                        img: ""
                    },
                    navSelector: '.pagination',
                    nextSelector: '.pagination .pagination-next',
                    itemSelector: '<?php echo esc_js($item)?>',
                    contentSelector: '<?php echo esc_js($wrap) ?>'
                };
                var $target = $('<?php echo esc_js($wrap) ?>').find('<?php echo esc_js($item)?>').parent();

                <?php if ($isotope) : ?>
                    $('<?php echo esc_js($wrap) ?>').find($target).isotope();
                <?php endif ?>

                jQuery(infiniteScroll.contentSelector).infinitescroll(
                    infiniteScroll, function(data) {
                        var $newElems = $(data).css({opacity: 0});
                        $target.append($newElems);
                        $newElems.imagesLoaded(function() {
                            $newElems.animate({opacity: 1});
                            <?php if ($isotope) { ?>
                                $('<?php echo esc_js($wrap)?>').find($target).isotope('appended', $newElems);
                                $('<?php echo esc_js($wrap)?>').find($target).isotope('reloadItems');
                            <?php } ?>
                        });
                    }
                );
            });
        </script><?php
    }

    /**
     * The default pagination
     *
     * @param    int       $mid_size    Number of around pages of current page.
     * @param    string    $prev        Previous button text.
     * @param    string    $next        Next button text.
     */
    function the_default(\WP_Query $query, $mid_size = 2, $prev = '&larr;', $next = '&rarr;')
    {
        $items = ($mid_size * 2) + 1;
        $max   = intval($query->max_num_pages);
        $paged = $query->query_vars['paged'] ? : 1;

        ?><div class="pagination clearfix"><?php
            if ($paged > 1) :
                $prev_link = esc_url( get_pagenum_link($paged - 1) );
                ?><a class="pagination-prev" href="<?php echo $prev_link ?>">
                    <?php echo $prev ?>
                </a><?php
            endif;
            for ($i = 1; $i <= $max; $i++) :
                if (1 != $max && (!($i >= $paged + $mid_size + 1 || $i <= $paged - $mid_size - 1) || $max <= $items)) :
                    if ($paged === $i) :
                        ?><span class="current"><?php echo $i ?></span><?php
                    else :
                        $link = esc_url( get_pagenum_link($i) );
                        ?><a href="<?php echo $link ?>" class="inactive"><?php echo $i ?></a><?php
                   endif;
               endif;
            endfor;
            if ($paged < $max) :
                $next_link = esc_url( get_pagenum_link($paged + 1) );
                ?><a class="pagination-next" href="<?php echo $next_link ?>">
                    <?php echo $next ?>
                </a><?php
            endif;
        ?></div><?php
    }

    /**
     * No reconstruction
     */
    private function __construct()
    {

    }

    /**
     * No clone
     */
    private function __clone()
    {

    }

    /**
     * No unserialization
     */
    private function __wakeup()
    {

    }
}
