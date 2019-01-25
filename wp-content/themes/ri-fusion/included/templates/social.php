<?php
/**
 * Socail template
 * @package WordPress
 * @subpackage Ri fusion
 * @since Ri fusion 1.0
 */
?>
<div class="rit-social">
    <ul class="social-share">
        <?php
        if (get_theme_mod('rit_social_facebook', '') != '') { ?>
            <li class="facebook"><a href="<?php echo esc_url(get_theme_mod('rit_social_facebook', '')) ?>"
                                    class="socail-item" title="<?php echo esc_attr('Facebook', 'ri-fusion') ?>"><i
                        class="fa fa-facebook"></i> </a></li>
        <?php }
        if (get_theme_mod('rit_social_twitter', '') != '') { ?>
            <li class="twitter"><a href="<?php echo esc_url(get_theme_mod('rit_social_twitter', '')) ?>"
                                   class="socail-item" title="<?php echo esc_attr('Twitter', 'ri-fusion') ?>"><i
                        class="fa fa-twitter"></i> </a></li>
        <?php }
        if (get_theme_mod('rit_social_googleplus', '') != '') { ?>
            <li class="googleplus"><a href="<?php echo esc_url(get_theme_mod('rit_social_googleplus', '')) ?>"
                                      class="socail-item"
                                      title="<?php echo esc_attr('Google plus', 'ri-fusion') ?>"><i
                        class="fa fa-google-plus"></i> </a></li>
        <?php }
        if (get_theme_mod('rit_social_dribbble', '') != '') { ?>
            <li class="dribbble"><a href="<?php echo esc_url(get_theme_mod('rit_social_dribbble', '')) ?>"
                                    class="socail-item"
                                    title="<?php echo esc_attr('Dribble', 'ri-fusion') ?>"><i
                        class="fa fa-dribbble"></i> </a></li>
        <?php }
        if (get_theme_mod('rit_social_vimeo', '') != '') { ?>
            <li class="vimeo"><a href="<?php echo esc_url(get_theme_mod('rit_social_vimeo', '')) ?>" class="socail-item"
                                 title="<?php echo esc_attr('Vimeo', 'ri-fusion') ?>"><i class="fa fa-vimeo"></i> </a>
            </li><?php
        }
        if (get_theme_mod('rit_social_tumblr', '') != '') { ?>
            <li class="tumblr"><a href="<?php echo esc_url(get_theme_mod('rit_social_tumblr', '')) ?>"
                                  class="socail-item"
                                  title="<?php echo esc_attr('Tumblr', 'ri-fusion') ?>"><i class="fa fa-tumblr"></i>
            </a></li><?php
        }
        if (get_theme_mod('rit_social_skype', '') != '') { ?>
            <li class="skype"><a href="<?php echo esc_url(get_theme_mod('rit_social_skype', '')) ?>" class="socail-item"
                                 title="<?php echo esc_attr('Skype', 'ri-fusion') ?>"><i class="fa fa-skype"></i> </a>
            </li><?php
        }
        if (get_theme_mod('rit_social_linkedin', '') != '') { ?>
            <li class="linkedin"><a href="<?php echo esc_url(get_theme_mod('rit_social_linkedin', '')) ?>"
                                    class="socail-item"
                                    title="<?php echo esc_attr('Linkin', 'ri-fusion') ?>"><i class="fa fa-linkedin"></i>
            </a></li><?php
        }
        if (get_theme_mod('rit_social_flickr', '') != '') { ?>
            <li class="flickr"><a href="<?php echo esc_url(get_theme_mod('rit_social_flickr', '')) ?>"
                                  class="socail-item"
                                  title="<?php echo esc_attr('Flick', 'ri-fusion') ?>"><i class="fa fa-flickr"></i> </a>
            </li><?php
        }
        if (get_theme_mod('rit_social_youTube', '') != '') { ?>
            <li class="youTube"><a href="<?php echo esc_url(get_theme_mod('rit_social_youTube', '')) ?>"
                                   class="socail-item"
                                   title="<?php echo esc_attr('YouTube', 'ri-fusion') ?>"><i class="fa fa-youtube"></i>
            </a></li><?php
        }
        if (get_theme_mod('rit_social_foursquare', '') != '') { ?>
            <li class="foursquare"><a href="<?php echo esc_url(get_theme_mod('rit_social_foursquare', '')) ?>"
                                      class="socail-item" title="<?php echo esc_attr('Foursquare', 'ri-fusion') ?>"><i
                    class="fa fa-foursquare"></i> </a>
            </li><?php
        }
        if (get_theme_mod('rit_social_instagram', '') != '') { ?>
            <li class="instagram"><a href="<?php echo esc_url(get_theme_mod('rit_social_instagram', '')) ?>"
                                     class="socail-item" title="<?php echo esc_attr('Instagram', 'ri-fusion') ?>"><i
                class="fa fa-instagram"></i> </a>
            </li><?php
        }
        if (get_theme_mod('rit_social_github', '') != '') { ?>
            <li class="github"><a href="<?php echo esc_url(get_theme_mod('rit_social_github', '')) ?>"
                                  class="socail-item"
                                  title="<?php echo esc_attr('Github', 'ri-fusion') ?>"><i class="fa fa-github"></i>
            </a></li><?php
        }
        if (get_theme_mod('rit_social_xing', '') != '') { ?>
            <li class="xing"><a href="<?php echo esc_url(get_theme_mod('rit_social_xing', '')) ?>" class="socail-item"
                                title="<?php echo esc_attr('Xing', 'ri-fusion') ?>"><i class="fa fa-xing"></i> </a>
            </li><?php
        }
        ?>
    </ul>
</div>