<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * WPSight_List_Agents_Admin class
 */
class WPSight_List_Agents_Admin {

	/**
	 *	Constructor
	 */
	public function __construct() {

		add_action( 'show_user_profile', array( $this, 'profile_agent_exclude' ) );
		add_action( 'edit_user_profile', array( $this, 'profile_agent_exclude' ) );
		
		add_action( 'personal_options_update', array( $this, 'profile_agent_exclude_save' ) );
		add_action( 'edit_user_profile_update', array( $this, 'profile_agent_exclude_save' ) );

	}
	
	/**
	 *	profile_agent_exclude()
	 *	
	 *	Add exclude agent from lists option to profile
	 *	
	 *	@param	object	$user	The WP_User object of the user being edited
	 *	@uses	current_user_can()
	 *	@uses	get_the_author_meta()
	 *	
	 *	@since 1.0.0
	 */
	public function profile_agent_exclude( $user ) {
		
		if ( ! current_user_can( 'listing_admin' ) && ! current_user_can( 'administrator' ) )
	        return false; ?>
	
	    <table class="form-table">
	        <tr>
	            <th><label for="agent_exclude"><?php _e( 'Agent Lists', 'wpcasa-list-agents' ); ?></label></th>
	            <td>
	                <input type="checkbox" value="1" name="agent_exclude" id="agent_exclude" style="margin-right:5px" <?php checked( get_the_author_meta( 'agent_exclude', $user->ID ), 1 ); ?>> <?php _e( 'Hide this user from agent lists', 'wpcasa-list-agents' ); ?>
	            </td>
	        </tr>
	    </table><?php
	    
	}
	
	/**
	 *	profile_agent_exclude_save()
	 *	
	 *	Save exclude agent option on profile pages
	 *	
	 *	@param	interger	$user_id	The user ID of the user being edited
	 *	@uses	current_user_can()
	 *	@uses	update_user_meta()
	 *	
	 *	@since 1.0.0
	 */
	public function profile_agent_exclude_save( $user_id ) {
	
	    if ( ! current_user_can( 'listing_admin' ) && ! current_user_can( 'administrator' ) )
	        return false;
	        
		$_POST['agent_exclude'] = isset( $_POST['agent_exclude'] ) ? $_POST['agent_exclude'] : false;
	
	    update_user_meta( $user_id, 'agent_exclude', $_POST['agent_exclude'] );
	
	}

}
