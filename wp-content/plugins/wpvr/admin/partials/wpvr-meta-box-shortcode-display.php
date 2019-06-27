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

<?php 
    $post = get_post();
    $id = $post->ID;
    $slug = $post->post_name;
?>
<p><?php echo __('For classic editor:', 'wpvr'); ?></p>
<p><?php echo __('To use this Wpvr tour in your posts or pages use the following shortcode:', 'wpvr'); ?></p>
<p><code>[wpvr id="<?php echo $id; ?>"]</code><?php ($slug ? 'or' : '') ?></p>
<p><?php echo __('For gutenberg:', 'wpvr'); ?></p>
<p>use id:<code><?php echo $id; ?></code>on wpvr block setting</p>
<p><?php echo __('Check how to use:', 'wpvr'); ?><a href="https://rextheme.com/docs/wp-vr/gutenberg-block/" target="blank">wpvr block</a></p>

