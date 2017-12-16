<?php
// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2006, Ashley Kitson                                        //
// URL:       http://xoobs.net			                                     //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)
// ------------------------------------------------------------------------- //
/**
* Admin index page
*
* Display log
*
* @author Ashley Kitson http://xoobs.net
* @copyright 2006 Ashley Kitson, UK
* @package XBSLOG
* @subpackage Admin
* @version 1
* @access private
*/

/**
* Do all the declarations etc needed by an admin page
*/
include_once "adminheader.php";

//Display the admin menu
xoops_module_admin_menu(1,_AM_XBSLOG_ADMENU1);

/**
* To use this as a template you need to write page to display
* whatever it is you want displaying between here...
*/

/**
* @global array Form Post variables
*/
global $_POST;
/**
* @global array Get variables
*/
global $_GET;

//First process any GETs
if (isset($_GET)) extract($_GET);
if (isset($start)) { //review the log starting at
	adminViewLog($start); 
} elseif (isset($delete)) { //clear the log
	adminClearLog();
} elseif (isset($_POST['doDel'])) {
	adminClearLog(true);
} else  { //review log from beginning
 	adminViewLog(0);
} //end if

/**
* and here.
*/

//And put footer in
xoops_cp_footer();

?>