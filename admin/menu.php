<?php

// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2006, Ashley Kitson                                        //
// URL:       http://xoobs.net			                                     //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)                                          //
// ------------------------------------------------------------------------- //
/**
* Admin menu declaration
*
* This script conforms to the Xoops standard for admin/menu.php
*
* @author Ashley Kitson http://xoobs.net
* @copyright 2005 Ashley Kitson, UK
* @package XBSLOG
* @subpackage Admin
* @version 1
* @access private
*/

/**
 * @global Xoop Configuration
 */
global $xoopsConfig;

/**
 * make sure we have the admin menu language constants loaded
 */
if (file_exists(XOOPS_ROOT_PATH."/modules/xbs_log/language/".$xoopsConfig['language']."/admin.php")) {
	include_once(XOOPS_ROOT_PATH."/modules/xbs_log/language/".$xoopsConfig['language']."/admin.php");
} else {
	include_once(XOOPS_ROOT_PATH."/modules/xbs_log/language/english/admin.php");
}

/**
* Whilst you can link your menu options to a single file, typically admin/index.php
* and use a switch statement on a variable passed to it from here, to keep things
* simple, use one script per menu option;
*/
$adminmenu[1]['title'] = _AM_XBSLOG_ADMENU1;
$adminmenu[1]['link'] = "admin/index.php";

?>