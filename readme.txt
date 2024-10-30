=== Cross Registration Integration ===
Contributors: GKauten
Donate link: http://www.gkauten.com/playground
Tags: User Registration, Registration Integration, BuddyPress Compatible, MailChimp Compatible
Requires at least: 2.8.6
Tested up to: 2.9.2
Stable tag: 1.2

Integrates with the WordPress registration process to assist with the registration process for other systems.

== Description ==

Integrates with the WordPress registration process to assist with the registration process for other systems.
Meaning, this plugin will simultaneously transmit the user's information entered in to your WordPress
registration page to a URL you specify which can then handle creating a duplicate user account within your
other systems on your website. This can be particularly useful when you use WordPress as your primary platform
however use other systems such as a forum or eCommerce solution which would require the user to create another
account before being able to use that system. You could also use this plugin to interface with third party email
marketing systems, utilizing a custom script to send your own welcome messages, initiating custom sessions, or
triggering external functions.

Version 1.0 is now enabled to work with BuddyPress sites allowing you to maintain the same functionality. Upon enabling
the plugin, there will be a new set of options within the plugin administration panel allowing you to choose which
fields are transmitted to the Transaction URL once a user completes the BuddyPress controlled registration page.

Version 1.1 introduced one new feature and an enhancement to an existing feature. The amount of delay that was
previously experienced while waiting for the call to the Transaction URL was optimized to only add an 
additional second or two to the overall load time. As for new features, on BuddyPress installations the profile
fields are also passed along. However, because of the dynamic nature of these fields there is not a 
feasible way to assign new names to them as they pass so they will maintain their original form names (i.e - 
field_1, field_2, etc... going down as an ordered list).

Version 1.2 further optimizes the methods by which the Transaction URL is called and respective form data passed.
Because the plugin uses a POST method, the receiving server should be expecting a POST as well. A later version 
is planned to allow for the selection of either a GET or POST transaction. This version also confirms the ability 
to work with the infamous MailChimp mailing system. For details regarding how to integrate with your MailChimp
list, please refer to http://www.gkauten.com/cross-registration-integration-meets-mailchimp.

If you find this plugin useful, please donate. Donations help pay for the massive amount of energy drinks
I consume and music I purchase on iTunes to keep the creative process going. It is also a good way of showing
support for my work which allows me to continue supporting and improving this plugin as WordPress continues
to evolve as one of the best known software systems out there.

Special thanks to Ewart at <a href="http://www.onesportevent.com">OneSportEvent.com</a> for the inspiration.

== Installation ==

1. Upload 'cross-registration-integration.php' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Visit the 'Cross Integration' sub-menu under the 'Settings' menu in WordPress
1. Enter the Transaction URL which is responsible for handling the User's registration information.
1. The plugin will now automatically integrate with the WordPress, or BuddyPress, registration process.

== Frequently Asked Questions ==

= If I deactivate the plugin will my settings remain? =

No. Deactivating the plugin through the WordPress Plugin menu will trigger a built in 'clean-up' 
function that will uninstall the plugin. If you wish to turn off the plugin temporarily, simply remove
the link you have entered into the Transaction URL field.

= Does this plugin work with other plugins that modify my registration form? =

At this time it is hard to say what effect this plugin has on other plugins, or vice versa. We do know
however, that the WP-Recaptcha interferes with the Cross Registration Integration plugin. We are hoping 
to resolve this soon in one of the next updates.

== Screenshots ==

1. Displays the administration panel for the plugin and available options.

== Changelog ==

= 1.2 =
* Improved transaction post method.
* Verified ability to integrate with the MailChimp email marketing system.

= 1.1 =
* Reduced the amount of time required to process the Transaction URL transmission on registration.
* Added BuddyPress Profile fields to the Transaction URL transmission on registration.

= 1.0 =
* Added support for the BuddyPress social networking plugin.
* Added Special Parameters field for higher level of customization.

= 0.9 =
* Added the ability to choose which user entered fields were transmitted to the Transaction URL.
* Added the ability to change the key name under which the fields were transmitted.

= 0.8 =
* Corrected duplicate "New Registration" email occurances.

= 0.7 =
* Encryption handling added.

= 0.6 =
* Initial stable release.

== Upgrade Notice ==

= 1.2 =
This version further enhanced the Transaction URL call methods and optimized field delivery. It also confirms integration with the MailChimp email marketing system.

= 1.1 =
This version reduces the amount of time required to process the Transaction URL transmission on registration and includes the Profile fields for BuddyPress installations.

= 1.0 =
This version added support for the BuddyPress social networking plugin and a new special parameters field.

= 0.9 =
This version added the ability to choose which user entered fields were transmitted to the Transaction URL and change the key name under which they were transmitted.

= 0.8 =
This version corrected a problem with the user receiving duplicate "New Registration" emails, each with different generated passwords.

= 0.7 =
This version adds the ability to apply encryption to the user's password as it is transmitted to the transaction URL.

= 0.6 =
This is the first stable version.

`<?php code(); // goes in backticks ?>`