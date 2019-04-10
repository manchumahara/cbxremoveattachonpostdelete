<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://codeboxr.com
 * @since             1.0.0
 * @package           cbxremoveattachonpostdelete
 *
 * @wordpress-plugin
 * Plugin Name:       Remove Attachment on Post Delete
 * Plugin URI:        https://codeboxr.com/
 * Description:       On post delete remove all attached media to keep your wordpress clean
 * Version:           1.0.0
 * Author:            Sabuj Kundu
 * Author URI:        https://manchumahara.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cbxremoveattachonpostdelete
 * Domain Path:       /languages
 */

/**
 * Class CBXRemoveMediaONPostDelete
 *
 * Remove attached media on post delete
 *
 */
class CBXRemoveMediaONPostDelete{
	function __construct() {
		add_action( 'before_delete_post', array($this, 'remove_attachment_with_post'), 10 );
	}

	/**
	 * Before delete post hook
	 *
	 * Delete all attachments media post types before deleting a post
	 *
	 * @param $post_id
	 */
	public function remove_attachment_with_post($post_id){
		$attachments = get_attached_media( '', $post_id );

		if(is_array($attachments) && sizeof($attachments) > 0){
			foreach ($attachments as $attachment){
				$attachment_id = $attachment->ID;

				wp_delete_attachment($attachment_id, true);
			}
		}
	}//end method remove_attachment_with_post
}//end class CBXRemoveMediaONPostDelete


new CBXRemoveMediaONPostDelete();