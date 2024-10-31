=== Pending Draft Alert ===
Contributors: (excalabyte)
Donate link: http://pariswells.com/blog/
Tags: drafts, reminder, email, email reminder, drafts post
Requires at least: 3.0
Tested up to: 5.4
Requires PHP: 5.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
== Description ==

This plugin allows for you to alert authors of your site via their registered user email address, that they have current draft posts pending to be published on the wordpress website. 

You can modify the frequency of the alerts from Daily, Weekly and Monthly.

== Installation ==
Download the zip-archive and extract it into your computer.
Upload the entire wp-pending-draft-alert folder to the /wp-content/plugins/ directory in your web site.
Activate the plugin through the ‘Plugins’ menu in your WordPress administration page.
You will find a new “Pending Draft Alert” sub-menu under the “Settings” to adjust frequency of emails

The Scheduled Task is run using WP-Cron which does not run constantly as the system cron does; it is only triggered on page load. For low traffic sites I recommend adding the file "wp-cron.php" which is usually in the root of your website to a System Cron Job on your hosting to run at least once a day
 
== Screenshots ==
1. Preview is the Plugin Settings
2. Preview of Plugin HTML Email
 
== Changelog ==
= 1.0 =
* Initial version
