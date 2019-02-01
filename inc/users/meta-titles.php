<?php
/**
 * Gothamish User Functions.
 *
 * @package Gothamish
 */

/**
 * The field on the editing screens.
 *
 * @param WP_User $user User object.
 */
function gotham_user_meta_title( $user ) {
	?>
	<h3>Gothamish Staff Title</h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="gotham_user_title">Gothamish Staff Title</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" id="gotham_user_title" name="gotham_user_title" value="<?php echo esc_attr( get_user_meta( $user->ID, 'gotham_user_title', true ) ); ?>">
				<p class="description">
					Please add a Gothamish Staff Title if applicable.
				</p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * The save action.
 *
 * @param int $user_id The ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function gotham_user_meta_title_update( $user_id ) {
	// check that the current user have the capability to edit the $user_id.
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	// create/update user meta for the $user_id.
	return update_user_meta(
		$user_id,
		'gotham_user_title',
		$_POST['gotham_user_title']
	);
}

// Add the field to user's own profile editing screen.
add_action( 'edit_user_profile', 'gotham_user_meta_title' );

// Add the field to user profile editing screen.
add_action( 'show_user_profile', 'gotham_user_meta_title' );

// Add the save action to user's own profile editing screen update.
add_action( 'personal_options_update', 'gotham_user_meta_title_update' );

// Add the save action to user profile editing screen update.
add_action( 'edit_user_profile_update', 'gotham_user_meta_title_update' );
