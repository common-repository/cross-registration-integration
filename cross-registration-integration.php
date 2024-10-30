<?php
/*
Plugin Name: Cross Registration Integration
Plugin URI: http://www.gkauten.com/cross-registration-integration
Description: Integrates with the WordPress registration process to assist with the registration process for other systems. Meaning, this plugin will simultaneously transmit the user's information entered in to your WordPress registration page to a URL you specify which can then handle creating a duplicate user account within your other systems on your website.
Version: 1.2
Author: GKauten
Author URI: http://www.gkauten.com

Special thanks to Ewart at OneSportEvent.com for the inspiration.

Copyright (c) 2010 - GKauten (www.GKauten.com)
  
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Used to Define WordPress or BuddyPress in Certain  Functions
global $cri_system;

/************************************/
/* Plugin Deactivation              */
/************************************/

function cross_registration_deactivate() {
  // Remove Installed Options
  delete_option("cri_transurl");
  delete_option("cri_encrypt");
  delete_option("cri_special_params");
  // Remove WordPress Related Options
  delete_option("cri_wp_username");
  delete_option("cri_wp_username_as");
  delete_option("cri_wp_email");
  delete_option("cri_wp_email_as");
  delete_option("cri_wp_password");
  delete_option("cri_wp_password_as");
  // Remove BuddyPress Related Options
  delete_option("cri_bp_username");
  delete_option("cri_bp_username_as");
  delete_option("cri_bp_email");
  delete_option("cri_bp_email_as");
  delete_option("cri_bp_password");
  delete_option("cri_bp_password_as");
}
register_deactivation_hook(__FILE__, 'cross_registration_deactivate');

/************************************/
/* Plugin Init Load                 */
/************************************/

function cross_registration_load() {
  // Install Options if not present
  if(get_option("cri_transurl") === false) {
    add_option("cri_transurl", "", "", true);
  }
  if(get_option("cri_encrypt") === false) {
    add_option("cri_encrypt", "Base64", "", true);
  }
  if(get_option("cri_special_params") === false) {
    add_option("cri_special_params", "", "", true);
  }
  // Install Options for WordPress Installations
  if(get_option("cri_wp_username") === false) {
    add_option("cri_wp_username", "true", "", true);
  }
  if(get_option("cri_wp_username_as") === false) {
    add_option("cri_wp_username_as", "username", "", true);
  }
  if(get_option("cri_wp_email") === false) {
    add_option("cri_wp_email", "true", "", true);
  }
  if(get_option("cri_wp_email_as") === false) {
    add_option("cri_wp_email_as", "email", "", true);
  }
  if(get_option("cri_wp_password") === false) {
	add_option("cri_wp_password", "true", "", true);
  }
  if(get_option("cri_wp_password_as") === false) {
	add_option("cri_wp_password_as", "password", "", true);
  }
  // Install Options for BuddyPress Installations
  if(function_exists("bp_core_check_installed")) {
    if(get_option("cri_bp_username") === false) {
	  add_option("cri_bp_username", "true", "", true);
	}
    if(get_option("cri_bp_username_as") === false) {
      add_option("cri_bp_username_as", "username", "", true);
    }
	if(get_option("cri_bp_email") === false) {
	  add_option("cri_bp_email", "true", "", true);
	}
	if(get_option("cri_bp_email_as") === false) {
      add_option("cri_bp_email_as", "email", "", true);
    }
	if(get_option("cri_bp_password") === false) {
	  add_option("cri_bp_password", "true", "", true);
	}
	if(get_option("cri_bp_password_as") === false) {
      add_option("cri_bp_password_as", "password", "", true);
    }
  }
}
add_action("admin_init", "cross_registration_load");

/************************************/
/* Administration Menu              */
/************************************/

function cross_registration_admin_init() {
  add_submenu_page("options-general.php", "Cross Registration Integration", "Cross Integration", 8, __FILE__, "cross_registration_admin_page");
}
add_action("admin_menu", "cross_registration_admin_init");

function cross_registration_admin_page() {
  // Credentials Form Submit
  if(isset($_POST["Cross_Submit"])) {
    // Update Settings
	if(isset($_POST["cri_transurl"]) && $_POST["cri_transurl"] != "") {
      update_option("cri_transurl", $_POST["cri_transurl"]);
	} else {
	  update_option("cri_transurl", "");
	}
	  
	if(isset($_POST["cri_encrypt"]) && $_POST["cri_encrypt"] != "") {
      update_option("cri_encrypt", $_POST["cri_encrypt"]);
	} else {
	  update_option("cri_encrypt", "");
	}
	
	// Update WordPress Settings
	if(isset($_POST["cri_wp_username"]) && $_POST["cri_wp_username"] != "") {
      update_option("cri_wp_username", "true");
	} else {
	  update_option("cri_wp_username", "false");
	}
	if(isset($_POST["cri_wp_username_as"]) && $_POST["cri_wp_username_as"] != "") {
      update_option("cri_wp_username_as", $_POST["cri_wp_username_as"]);
	} else {
	  update_option("cri_wp_username_as", "username");
	}
	
	if(isset($_POST["cri_wp_email"]) && $_POST["cri_wp_email"] != "") {
      update_option("cri_wp_email", "true");
	} else {
	  update_option("cri_wp_email", "false");
	}
	if(isset($_POST["cri_wp_email_as"]) && $_POST["cri_wp_email_as"] != "") {
      update_option("cri_wp_email_as", $_POST["cri_wp_email_as"]);
	} else {
	  update_option("cri_wp_email_as", "email");
	}
	
	if(isset($_POST["cri_wp_password"]) && $_POST["cri_wp_password"] != "") {
      update_option("cri_wp_password", "true");
	} else {
	  update_option("cri_wp_password", "false");
	}
	if(isset($_POST["cri_wp_password_as"]) && $_POST["cri_wp_password_as"] != "") {
      update_option("cri_wp_password_as", $_POST["cri_wp_password_as"]);
	} else {
	  update_option("cri_wp_password_as", "password");
	}
	
	// Update BuddyPress Settings
	if(isset($_POST["cri_bp_username"]) && $_POST["cri_bp_username"] != "") {
      update_option("cri_bp_username", "true");
	} else {
	  update_option("cri_bp_username", "false");
	}
	if(isset($_POST["cri_bp_username_as"]) && $_POST["cri_bp_username_as"] != "") {
      update_option("cri_bp_username_as", $_POST["cri_bp_username_as"]);
	} else {
	  update_option("cri_bp_username_as", "username");
	}
	
	if(isset($_POST["cri_bp_email"]) && $_POST["cri_bp_email"] != "") {
      update_option("cri_bp_email", "true");
	} else {
	  update_option("cri_bp_email", "false");
	}
	if(isset($_POST["cri_bp_email_as"]) && $_POST["cri_bp_email_as"] != "") {
      update_option("cri_bp_email_as", $_POST["cri_bp_email_as"]);
	} else {
	  update_option("cri_bp_email_as", "email");
	}
	
	if(isset($_POST["cri_bp_password"]) && $_POST["cri_bp_password"] != "") {
      update_option("cri_bp_password", "true");
	} else {
	  update_option("cri_bp_password", "false");
	}
	if(isset($_POST["cri_bp_password_as"]) && $_POST["cri_bp_password_as"] != "") {
      update_option("cri_bp_password_as", $_POST["cri_bp_password_as"]);
	} else {
	  update_option("cri_bp_password_as", "password");
	}
	
	// Update Special Parameters
	if(isset($_POST["cri_special_params"]) && $_POST["cri_special_params"] != "") {
      update_option("cri_special_params", $_POST["cri_special_params"]);
	} else {
	  update_option("cri_special_params", "");
	}
	  
	$message = "Your settings have been saved!";
  }
  ?>
  
  <!-- Remove Other Admin Notices -->
  <script type="text/javascript" language="javascript">
	jQuery("#message").hide();
  </script>
  
  <!-- Override Standard Styling -->
  <style type="text/css">
    #cri_message {
      background-color: #ffffe0;
	  border-color: #e6db55;
	  border-width: 1px;
	  border-style: solid;
	  padding: 0px 0px 0px 15px;
	  margin: 0px;
	  -moz-border-radius: 8px;
	  -khtml-border-radius: 8px;
	  -webkit-border-radius: 8px;
 	  border-radius: 8px;
    }
  </style>

  <div class="wrap">
    <h2 style="display: block; float: left;"><?php _e("Cross Registration Integration", "cross_registration"); ?></h2>
    <span style="display: block; float: left; padding-top: 15px; margin-bottom: 10px;">
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="ZL3FGJFL8YZ34">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to send money online!">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
      </form>
    </span>
    <form method="post" name="cross_registration_integration" target="_self" style="clear: both;">
      <?php if($message) { ?>
        <div id="cri_message" class="fade"><p><?php echo $message; ?></p></div>
      <?php } ?>
      <p style="width: 750px;">In order to enable the Cross Registration Integration system with the WordPress registration process you need to enter in the transaction URL information below. This is the URL of the page which will handle the user's information that is sent to it.</p>
      <p style="width: 750px;">The encryption type determines how the user's password will be transmitted to your Transaction URL. By default this is set to Base64 encryption which means the receiving page will need to use Base64 decryption before handling the password information.</p>
      <table class="form-table" style="width: 750px; margin-left: 10px;">
        <tr>
          <td style="width: 150px;" valign="top"><?php _e("Transaction URL:", "cross_registration"); ?></td>
          <td style="width: 500px;"><input type="text" name="cri_transurl" style="width: 400px;" value="<?php if (get_option("cri_transurl")) echo get_option("cri_transurl"); ?>" /></td>
        </tr>
        <tr>
          <td valign="top"><?php _e("Encryption Type:", "cross_registration"); ?></td>
          <td>
            <input type="radio" name="cri_encrypt" value="Base64" <?php if(get_option("cri_encrypt") == "Base64") echo "checked=\"checked\""; ?> /> Base64<br />
            <input type="radio" name="cri_encrypt" value="" <?php if(get_option("cri_encrypt") == "") echo "checked=\"checked\""; ?> /> None <i>(not recommended)</i>
          </td>
        </tr>
      </table>

      <h3>WordPress Integration</h3>
      <p style="width: 750px;">When a user registers for your WordPress site, they enter their username and email address and the site generates their password. You have the option to receive any of these three details submitted to your Transaction URL above. Please select which fields you would like to have sent over. If the receiving system requires the "key" value to be different than the default "username / password / email" values, simply specify the value it needs to be in the respective field.</p>
      <table class="form-table" style="width: 750px; margin-left: 10px;">
        <tr>
          <td valign="top" style="width: 100px;"><?php _e("Transmit:", "cross_registration"); ?></td>
          <td>Username</td>
          <td><input type="checkbox" name="cri_wp_username" <?php if(get_option("cri_wp_username") == "true") echo "checked=\"checked\""; ?> /></td>
          <td>as <input type="text" name="cri_wp_username_as" style="width: 400px;" value="<?php if (get_option("cri_wp_username_as")) echo get_option("cri_wp_username_as"); ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Email Address</td>
          <td><input type="checkbox" name="cri_wp_email" <?php if(get_option("cri_wp_email") == "true") echo "checked=\"checked\""; ?> /></td>
          <td>as <input type="text" name="cri_wp_email_as" style="width: 400px;" value="<?php if (get_option("cri_wp_email_as")) echo get_option("cri_wp_email_as"); ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Password</td>
          <td><input type="checkbox" name="cri_wp_password" <?php if(get_option("cri_wp_password") == "true") echo "checked=\"checked\""; ?> /></td>
          <td>as <input type="text" name="cri_wp_password_as" style="width: 400px;" value="<?php if (get_option("cri_wp_password_as")) echo get_option("cri_wp_password_as"); ?>" /></td>
        </tr>
      </table>

      <?php // Check for Active BuddyPress Installation // ?>
	  <?php if(function_exists("bp_core_check_installed")) : ?>
        <h3>BuddyPress Integration</h3>
        <p style="width: 750px;">When a user registers for your BuddyPress site, they enter their username and email address and a password of their choice. You have the option to receive any of these three details submitted to your Transaction URL above. Please select which fields you would like to have sent over. If the receiving system requires the "key" value to be different than the default "username / password / email" values, simply specify the value it needs to be in the respective field.</p>
        <table class="form-table" style="width: 750px; margin-left: 10px;">
          <tr>
            <td valign="top" style="width: 100px;"><?php _e("Transmit:", "cross_registration"); ?></td>
            <td>Username</td>
            <td><input type="checkbox" name="cri_bp_username" <?php if(get_option("cri_bp_username") == "true") echo "checked=\"checked\""; ?> /></td>
            <td>as <input type="text" name="cri_bp_username_as" style="width: 400px;" value="<?php if (get_option("cri_bp_username_as")) echo get_option("cri_bp_username_as"); ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Email Address</td>
            <td><input type="checkbox" name="cri_bp_email" <?php if(get_option("cri_bp_email") == "true") echo "checked=\"checked\""; ?> /></td>
            <td>as <input type="text" name="cri_bp_email_as" style="width: 400px;" value="<?php if (get_option("cri_bp_email_as")) echo get_option("cri_bp_email_as"); ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Password</td>
            <td><input type="checkbox" name="cri_bp_password" <?php if(get_option("cri_bp_password") == "true") echo "checked=\"checked\""; ?> /></td>
            <td>as <input type="text" name="cri_bp_password_as" style="width: 400px;" value="<?php if (get_option("cri_bp_password_as")) echo get_option("cri_bp_password_as"); ?>" /></td>
          </tr>
        </table>
      <?php endif; ?>
      
      <h3>Special Parameters</h3>
      <p style="width: 750px;">Depending on where you are sending the user registration information to, you may require the use of special parameters. These special parameters may specify your identity on the receiving system such as API key, user token, or some other identifying information. You may also wish to use special parameters to specify the referrer or some other information the receiving system may need to use. Just make sure you <strong>DO NOT</strong> include the "&amp;" before the first "key=value" pair.</p>
      <table class="form-table" style="width: 750px; margin-left: 10px;">
        <tr>
          <td valign="top" style="width: 150px;"><?php _e("Special Parameters:", "cross_registration"); ?></td>
          <td>
            <input type="text" name="cri_special_params" style="width: 400px;" value="<?php if (get_option("cri_special_params")) echo get_option("cri_special_params"); ?>" /><br />
            <i>Example: "RegKey=123456789&amp;Referrer=mywebsite.com"</i>
          </td>
        </tr>
      </table>
      
      <h3>Example Transaction</h3>
      <p><?php echo get_option("cri_transurl")."?".get_option("cri_special_params"); ?></p>

      <p style="padding: 20px;">
        <input type="submit" name="Cross_Submit" value="<?php _e("Save Settings", "cross_registration"); ?> &raquo;" />
      </p>

    </form>
  </div>
  
<?php } 

/************************************/
/* WP Registration Form Post Hook   */
/************************************/

function cri_register_new_wp_user($user_login, $user_email, $errors) {
  global $cri_system;
  $cri_system = "word";
  $errors = apply_filters('registration_errors', $errors);
  
  if(!$errors->get_error_code()) {
    // Create New User
    $user_pass = wp_generate_password();
    $user_id = wp_create_user( $user_login, $user_pass, $user_email );
    if ( !$user_id ) {
	  $errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
	  return $errors;
    }

    // Check for Administrative Settings
	if(get_option("cri_wp_username") == "false") {
	  $user_name = "";
	}
	if(get_option("cri_wp_email") == "false") {
	  $user_email = "";
	}
	if(get_option("cri_wp_password") == "false") {
	  $user_pass = "";
	}	
    // Transmit Information
    cri_cross_register($user_login, $user_email, $user_pass);

    // Send User Registration Email
    wp_new_user_notification($user_id, $user_pass);

    // Fake Error to Cease Normal WordPress Registration
    $errors->add('cri_register_complete', __('Registration complete! Check your email for your password.'));
	return $errors;
  }
}

add_action('register_post', 'cri_register_new_wp_user', 10, 3);

/************************************/
/* BP Registration Form Post Hook   */
/************************************/

function cri_register_new_bp_user() {
  global $bp, $cri_system;
  $cri_system = "buddy";
  // Check for User Registration Completion
  if ($bp->signup->step == "completed-confirmation") {
    // Check for Administrative Settings
	if(get_option("cri_bp_username") == "true") {
	  $user_login = $_POST['signup_username'];
	} else {
	  $user_login = "";
	}
	if(get_option("cri_bp_email") == "true") {
	  $user_email = $_POST['signup_email'];
	} else {
	  $user_email = "";
	}
	if(get_option("cri_bp_password") == "true") {
	  $user_pass = $_POST['signup_password']; 
	} else {
	  $user_pass = "";
	}
  }
  
  // Check for Extra Profile Fields
  if(!empty( $_POST['signup_profile_field_ids'])) {
	$profile_field_ids = explode( ',', $_POST['signup_profile_field_ids'] );
    // Loop through the posted fields formatting any datebox values then add to $data
	$data = array();
	foreach((array) $profile_field_ids as $field_id) {
	  if(!isset($_POST['field_' . $field_id])) {
	    if(isset($_POST['field_' . $field_id . '_day'])) {
		  $_POST['field_' . $field_id] = strtotime($_POST['field_' . $field_id . '_day'] . $_POST['field_' . $field_id . '_month'] . $_POST['field_' . $field_id . '_year']);
		}
	  }
	  $data["field_" . $field_id] = $_POST['field_' . $field_id];
	}
  }

  // Transmit Information
  cri_cross_register($user_login, $user_email, $user_pass, $data);
}

// Check for BuddyPress before Initiating Hook
if(function_exists("bp_core_check_installed")) {
  add_action('bp_complete_signup', 'cri_register_new_bp_user', 10);
}

/************************************/
/* Registration Process Hooks       */
/************************************/

function cri_cross_register($user_login, $user_email, $user_pass, $data = null) {
  global $cri_system;
  // Exit if Transaction URL is empty
  if(get_option("cri_transurl") == "" || get_option("cri_transurl") === false) return;
  // Encryption
  switch(get_option("cri_encrypt")) {
    case "Base64":
	  $user_pass = base64_encode($user_pass);
	  break;
	default:
	  break;
  }
  // Initiate Appropriate System Variables
  if($cri_system == "buddy") {
    $username_as = get_option("cri_bp_username_as");
	$email_as = get_option("cri_bp_email_as");
	$password_as = get_option("cri_bp_password_as");
  } else {
    $username_as = get_option("cri_wp_username_as");
	$email_as = get_option("cri_wp_email_as");
	$password_as = get_option("cri_wp_password_as");
  }
  // Begin Cross Registration
  $params = array();
  $params[$username_as] = $user_login;
  $params[$email_as] = $user_email;
  $params[$password_as] = $user_pass;
  // Add Extra Data Fields
  if($data) {
    $params = array_merge($params, $data);
  }
  // Add Special Parameters
  if(get_option("cri_special_params") != "") {
	$special = get_option("cri_special_params");
	if(strstr($special, "&")) {
	  // Assume Multiple Params
	  $temp_spec = array();
	  $temp_spec = explode("&", $special);
	  if(count($temp_spec)) {
	    foreach($temp_spec as $spec) {
		  $params[substr($spec, 0, strpos($spec, "="))] = substr($spec, strpos($spec, "=") + 1);
	    }
	  }
	} else {
	  $params[substr($special, 0, strpos($special, "="))] = substr($special, strpos($special, "=") + 1);
	}
  }
  $r = cri_http(get_option("cri_transurl"), $params);
}

/************************************/
/* Registration Post Process        */
/************************************/

function cri_http($url, $post_fields = "") {
  $postfields = array();
  if(count($post_fields)) {
	foreach($post_fields as $i => $f) {
	  $postfields[] = urlencode($i) . '=' . urlencode($f);
    }
  }
  $fields = implode('&', $postfields);
  $opts = array(
    'http'=>array(
      'method' => "POST",
      'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
				  "Content-Length: " . strlen($fields) . "\r\n\r\n" .
				  $fields
    )
  );
  $context = stream_context_create($opts);
  $fp = @fopen($url, 'rb', false, $context);
  @fclose($fp);
}

?>