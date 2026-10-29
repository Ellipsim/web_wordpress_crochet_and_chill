<?php
// ===============================================================//
// NinjaFirewall's loader.                                        //
// DO NOT alter or remove it as long as NinjaFirewall is running. //
// If this file is corrupted or wrong, you can re-generate it     //
// by deactivating and reactivating NinjaFirewall from your       //
// WordPress dashboard.                                           //
// ===============================================================//
$nfw_exclude_waf_list = array('wp-admin','wp-content','wp-includes');
foreach( $nfw_exclude_waf_list as $nfw_exclude_waf_folder ) {
	if (strpos($_SERVER['SCRIPT_FILENAME'], "/usr/home/scgc.es.joserdugr.net/web/$nfw_exclude_waf_folder/") === 0) {
		return;
	}
}
if ( is_file('/usr/home/scgc.es.joserdugr.net/web/wp-content/plugins/ninjafirewall/lib/firewall.php') ) {
	@include_once '/usr/home/scgc.es.joserdugr.net/web/wp-content/plugins/ninjafirewall/lib/firewall.php';
}
// EOF
