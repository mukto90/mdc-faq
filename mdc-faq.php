<?php
/*
Plugin Name: MDC FAQ
Description: MDC FAQ is an awesome plugin to create a Frequently Asked Questions for you website.
Plugin URI: https://wordpress.org/plugins/mdc-faq
Author: Nazmul Ahsan
Author URI: http://mukto.medhabi.com
Version: 1.0.0
*/

include "faq_custom_post_type.php";
include "faq_archives.php";
// include "faq_acf_custom_fields.php";
include "faq_option_page.php";
include "faq_enque_scripts.php";
if( !function_exists('acf') ){	//if ACF is not installed already
	include "acf/acf.php";
	// define('ACF_LITE', true);
}