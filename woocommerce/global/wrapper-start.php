<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option( 'template' );

switch( $template ) {
	case 'bookbagbakers' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content bookbagbakers"><div class="tfwc">';
		break;
	default :
		echo '<div id="container"><div id="content" role="main">';
		break;
}