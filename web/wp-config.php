<?php
/**
 * Configuración base de WordPress.
 */

// ** Configuración de la base de datos ** //
define('DB_NAME','278038433wordpress20260306002535');
define('DB_USER','myscgc6759ed');
define('DB_PASSWORD','@Pg2CWJ53cpuPN@h');
define('DB_HOST','localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// ** Claves de autenticación ** //
define('AUTH_KEY','Q [Q~!|%`goj b&@i{F_5TiqGV/CuA0+Atjxf|PkiQ]q$oEC!1]0@T;L4{u.~s}c');
define('SECURE_AUTH_KEY','=}Z~R$gbTV*0/gK>{st=x1Jxl]-AmC(92$|-EuAG~6{y<Jcv:p_a1`-<6$]ft]2k');
define('LOGGED_IN_KEY','+JB3uGEihD2Fsr?>`Az-EfcQue UzP7+ul(2^GUK@Y7vK8o+i@j=GwmVAz*eC2GG');
define('NONCE_KEY','K]T|B]cJIcqwZ4!O {7$fZgJ|j`Xw9ZbP{BY}0+A(gS%nq~pi>pF>p:?gx2EyNUw');
define('AUTH_SALT','uYh<IWg,0i0W9+zUjuqk[E ]}SI%Ruh+-(nOrl7iOpiX9>4<9}s4n(aKp1-#uGW]');
define('SECURE_AUTH_SALT','3FUS9UBjWg.,XC.C,rL6Dd>~U8G[7%+USjw`ZH!W+L~l9rnYW~`c^_a4&E]w8n{;');
define('LOGGED_IN_SALT','IVt.l-q?k7TLU+cv0vuV-1O%_7Gzm+|4p}9(-BWUh-Nl$&>jT`xI$AY2)+7=PuK^');
define('NONCE_SALT','|E9-dR+zG-+WmBxI%)-~1IGPbZaQt*`q|1$7#>97d&[K]~l][j|Rf?ICRJ(Wlg%:');

/** Prefijo de la base de datos **/
$table_prefix = 'wp_';

/** Activar modo de depuración (true para desarrollo, false en producción) **/
define('WP_DEBUG', false);

/** Evitar editar archivos desde el panel de administración **/
define('DISALLOW_FILE_EDIT', true);

/** Configuración absoluta del directorio de WordPress. **/
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Configura WordPress. **/
require_once ABSPATH . 'wp-settings.php';

//Autoupdates enabled
define( 'WP_AUTO_UPDATE_CORE', true );

//Not populate themes/plugins by WordPress.
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

