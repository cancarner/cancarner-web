<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin/partials
 */
?>

<!-- This file should display the admin pages -->
<div class="row">
    <div class="rex-onboarding">
        <div class="left">
            <div class="wrapper">
                <div class="col s12 no-pd">
                    <ul class="tabs tabs-icon rex-tabs">
                        <li class="tab col s3"><a href="#tab1"><i class="material-icons">settings</i><?php _e('General','wpvr'); ?></a></li>
                        <li class="tab col s3"><a href="#tab2"><i class="material-icons">perm_media</i><?php _e('Video Tutorials','wpvr'); ?></a></li>
                        <li class="tab col s3"><a href="#tab3"><i class="material-icons">thumb_up_alt</i><?php _e('Go Premium','wpvr'); ?></a></li>
                        <?php
                        if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
                            ?>
                                <li class="tab col s3"><a href="#tab4"><i class="material-icons">add</i><?php _e('Import','wpvr'); ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>

                <div id="tab1" class="block-wrapper">
                    <div class="single-block">
                        <div class="onboarding-block banner-block">
                            <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/banner.png'?>" alt="rex-banner">
                        </div>
                    </div>
                    <div class="single-block">
                        <div class="onboarding-block">

                            <div class="header">
                                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Document.png'?>" class="title-icon" alt="wpvr-documentation">
                                <h4><?php _e('Documentation','wpvr'); ?></h4>
                            </div>

                            <div class="body">
                                <p>
                                    <?php
                                    _e('Before You start, you can check our Documentation to get familiar with WP VR - 360 Panorama and virtual tour creator for WordPress.','wpvr');
                                    ?>
                                </p>

                                <a class="waves-effect waves-light btn wpvr-btn" href="https://rextheme.com/docs/wp-vr/" target="_blank"><?php _e('View Documentation','wpvr'); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="single-block">

                        <div class="onboarding-block">
                            <div class="header">
                                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Support.png'?>" class="title-icon" alt="wpvr-documentation">
                                <h4><?php _e('Support','wpvr'); ?></h4>
                            </div>

                            <div class="body">
                                <p>
                                    <?php
                                    _e('Can\'t find solution on with our documentation? Just Post a ticket on Support forum. We are to solve your issue.','wpvr');
                                    ?>
                                </p>

                                <a class="waves-effect waves-light btn wpvr-btn" href="https://wordpress.org/support/plugin/wpvr" target="_blank"><?php _e('Post a Ticket','wpvr'); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="single-block">
                        <div class="onboarding-block">
                            <div class="header">
                                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Feedback.png'?>" class="title-icon" alt="wpvr-documentation">
                                <h4><?php _e('Share Your Thoughts','wpvr'); ?></h4>
                            </div>

                            <div class="body">
                                <p>
                                    <?php
                                    _e('Your suggestions are valubale to us. It can help to make wpvr even better.','wpvr');
                                    ?>
                                </p>

                                <a class="waves-effect waves-light btn wpvr-btn" href="https://rextheme.com/wpvr/" target="_blank"><?php _e('Suggest','wpvr'); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="single-block">
                        <div class="onboarding-block">
                            <div class="header">
                                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Rating.png'?>" class="title-icon" alt="wpvr-documentation">
                                <h4><?php _e('Make WPVR Popular','wpvr'); ?></h4>
                            </div>

                            <div class="body">
                                <p>
                                    <?php
                                    _e('Your rating and feedback matters to us. If you are happy with WP VR - 360 Panorama and virtual tour creator for WordPress give us a rating.','wpvr');
                                    ?>
                                </p>

                                <a class="waves-effect waves-light btn wpvr-btn" href="https://wordpress.org/plugins/wpvr/#reviews" target="_blank"><?php _e('Rate Us! ','wpvr'); ?></a>
                            </div>
                        </div>
                    </div>


                    <div class="single-block">
                        <div class="onboarding-block">
                            <div class="header">
                                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Heart.png'?>" class="title-icon" alt="wpvr-documentation">
                                <h4><?php _e('Share On','wpvr'); ?></h4>
                            </div>

                            <div class="body">
                                <ul class="social">
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//wordpress.org/plugins/wpvr/" target="_blank"><?php _e('Share on Facebook','wpvr'); ?></a></li>
                                    <li><a href="https://twitter.com/home?status=https%3A//wordpress.org/plugins/wpvr/" target="_blank"><?php _e('Share on Twitter','wpvr'); ?></a></li>
                                    <li><a href="https://plus.google.com/share?url=https%3A//wordpress.org/plugins/wpvr/" target="_blank"><?php _e('Share on Google+','wpvr'); ?></a></li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//wordpress.org/plugins/wpvr/&title=&summary=&source=" target="_blank"><?php _e('Share on LinkedIn','wpvr'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="block-wrapper">
                    <div class="video-container">

                        <iframe src="https://www.youtube.com/embed/videoseries?list=PLelDqLncNWcVNqy7zoqtt8N-pyqy0-93z" width="640" height="360" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                    <div id="tab3" class="block-wrapper">
                        <div class="rex-upgrade">
                            <h4><?php _e('Why upgrade to Premium Version?','wpvr'); ?></h4>
                            <div class="parent">
                                <div class="item"><?php _e('Unlimited scenes','wpvr'); ?></div>
                                <div class="item"><?php _e('Unlimited hotspots','wpvr'); ?></div>
                                <div class="item"><?php _e('Customized hotspot icon','wpvr'); ?></div>
                                <div class="item"><?php _e('Dynamic Icon background color on hotspot','wpvr'); ?></div>
                                <div class="item"><?php _e('Compass Switch','wpvr'); ?></div>
                                <div class="item"><?php _e('Default zoom level','wpvr'); ?></div>
                                <div class="item"><?php _e('Maximum and minimum zoom range','wpvr'); ?></div>
                                <div class="item"><?php _e('Customize each scene\'s default face on load','wpvr'); ?></div>
                                <div class="item"><?php _e('Scene grab control and custom boundary for each scene','wpvr'); ?></div>
                                <div class="item"><?php _e('Scene title and author tag support','wpvr'); ?></div>
                                <div class="item"><?php _e('Hotspot based scene face support','wpvr'); ?></div>
                                <div class="item"><?php _e('Gyroscope support','wpvr'); ?></div>
                                <div class="item"><?php _e('Duplicate tour support','wpvr'); ?></div>
                                <div class="item"><?php _e('File import & export system','wpvr'); ?></div>
                                <div class="item"><?php _e('Custom scene gallery','wpvr'); ?></div>
                                <div class="item"><?php _e('Personalized support on both support forum and our support e-mail.','wpvr'); ?></div>
                            </div>
                            <a href="https://rextheme.com/wpvr/" target="_blank" class="waves-effect waves-light btn wpvr-btn"><?php _e('Get Premium Version','wpvr'); ?></a>
                        </div>
                    </div>
                    <?php
                    if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
                        ?>
                        <div id="tab4" class="block-wrapper">
                            <div class="rex-upgrade">
                                <h4><?php _e('Import tour file: ','wpvr'); ?></h4>
                                <p style="color: red;"><?php _e('Do not close or refresh the page during import process. It may take few minutes.','wpvr'); ?></p>
                                <div class="parent" style="width:100%;">
                                  <form id="wpvr_import_from">
                                      <a class="btn-floating btn-large waves-effect waves-light red" id="wpvr_button_upload"><i class="material-icons">add</i></a>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" id="wpvr_file_url" type="text" value="" data-value="" >
                                      </div>
                                      <div id="wpvr_progress" class="progress" style="display:none;">
                                          <div class="indeterminate"></div>
                                      </div>
                                      <button class="btn waves-effect waves-light" type="submit" id="wpvr_button_submit" >Submit
                                        <i class="material-icons right">send</i>
                                      </button>
                                  </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>

        <div class="right">
            <div class="rex-banner">
                <img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/icon-128x128.png'?>" class="banner-logo" alt="logo">
                <a href="https://rextheme.com/wpvr/" class="update-btn" target="_blank"><?php _e('Upgrade to Pro','wpvr');?></a>
                <a href="https://wordpress.org/plugins/social-booster/" target="_blank"><img src="<?php echo WPVR_PLUGIN_DIR_URL . 'admin/icon/Social_Booster_Banner.png'?>" alt="rex-banner"></a>
            </div>
        </div>
    </div>
</div>
