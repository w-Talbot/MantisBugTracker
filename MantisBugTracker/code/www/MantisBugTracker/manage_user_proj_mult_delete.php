<?php
# MantisBT - A PHP based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A user to Project
 *
 * @package MantisBT
 * @copyright Copyright 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright 2002  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 *
 * @uses core.php
 * @uses access_api.php
 * @uses authentication_api.php
 * @uses config_api.php
 * @uses form_api.php
 * @uses gpc_api.php
 * @uses print_api.php
 * @uses project_api.php
 */

require_once( 'core.php' );
require_api( 'access_api.php' );
require_api( 'authentication_api.php' );
require_api( 'config_api.php' );
require_api( 'form_api.php' );
require_api( 'gpc_api.php' );
require_api( 'print_api.php' );
require_api( 'project_api.php' );

form_security_validate( 'manage_user_proj_mult_delete' );

auth_reauthenticate();

$f_user_id		= gpc_get_int( 'user_id' );
$f_project_id	= gpc_get_int_array( 'mult_project_id', array() );
$t_manage_user_threshold = config_get( 'manage_user_threshold' );

user_ensure_exists( $f_user_id );

# Confirm with the user
helper_ensure_confirmed(
    sprintf( lang_get( 'remove_user_mult_sure_msg' ),
        string_attribute( user_get_name( $f_user_id ) )
    ),
    lang_get( 'remove_user_button' )
);

foreach ( $f_project_id as $t_proj_id ) {
    project_remove_user( $t_proj_id, $f_user_id );
}

form_security_purge( 'manage_user_proj_mult_delete' );

print_header_redirect( 'manage_user_edit_page.php?user_id=' . $f_user_id );
