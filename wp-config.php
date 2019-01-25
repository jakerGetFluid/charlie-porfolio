<?php
# Database Configuration

// local
define( 'DB_NAME', 'wp_charlesstemen' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );

// wpengine
// define( 'DB_NAME', 'wp_charlesstemen' );
// define( 'DB_USER', 'charlesstemen' );
// define( 'DB_PASSWORD', '6Dh91g5RqFKxJ2E9saW1' );

define( 'DB_HOST', 'localhost' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
define( 'WP_DEBUG', false );
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '@c` jMC7NPldq[3<h_LR[^i(}^`?VyqUplvu8${YdI*.Of1}q4hKy|2~rmJv9cku');
define('SECURE_AUTH_KEY',  'XuVqZq~YV=<)?ZFjhF-G-~R^/q0]((-dk+3zie+ASu 5Nn05dLj:=(gDhT.++wpJ');
define('LOGGED_IN_KEY',    'uZk78x^g)1|!!l@I(C@b6{>R;+2*&Y(aHZ}~;z7tFw&_Abrt6wq-<j)C{|lVRdgq');
define('NONCE_KEY',        'E-XgWBOH/N|>+d6U=XHqMMa9VsVCRc[lB_to.cj-53n7$5FWJx3@4MgASNBk[DWY');
define('AUTH_SALT',        'WTpx,hyMlR/-90,J3D-Ch}6)L8j^KN*0pYJgn@G+9-hM}JZ8PIY9^>aBf1JYR@a/');
define('SECURE_AUTH_SALT', 'av{*T)(9G|NdDA,:nptkp0xH ?Ewq+gHk0d,[Dv=[=U!-!|{1NPRr2rI|6a4]E.%');
define('LOGGED_IN_SALT',   'qaO*Y[Wq;`drs+hDINj8bYb9F?%|D*V[Y-{b-95}c{489[_{Yb_$V-`pY-O5KyHV');
define('NONCE_SALT',       'nI++|)2U|2t2hCz<}PZ<~9$tF+>VZbGvq CZbH-&=SVo0MXYebbFMy&/2k3j3F).');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'charlesstemen' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '7c8c4b9a906c9c508c335d2b4d41ffd057888c3c' );

define( 'WPE_CLUSTER_ID', '120254' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'charlesstemen.com', 1 => 'charlesstemen.wpengine.com', 2 => 'www.charlesstemen.com', );

$wpe_varnish_servers=array ( 0 => 'pod-120254', );

$wpe_special_ips=array ( 0 => '35.196.200.243', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );

define( 'WP_SITEURL', 'https://charlesstemen.test' );

define( 'WP_HOME', 'https://charlesstemen.test' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
