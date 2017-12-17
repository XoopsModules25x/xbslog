<?php

// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2006, Ashley Kitson                                        //
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)                                          //
// ------------------------------------------------------------------------- //
/**
 * Admin menu declaration
 *
 * This script conforms to the Xoops standard for admin/menu.php
 *
 * @author     Ashley Kitson http://xoobs.net
 * @copyright  2005 Ashley Kitson, UK
 * @package    XBSLOG
 * @subpackage Admin
 * @version    1
 * @access     private
 */

defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

//$path = dirname(dirname(dirname(__DIR__)));
//include_once $path . '/mainfile.php';

$moduleHandler = xoops_getHandler('module');
$module        = $moduleHandler->getByDirname(basename(dirname(__DIR__)));
$pathIcon32    = '../../' . $module->getInfo('icons32');
xoops_loadLanguage('modinfo', $module->dirname());

$pathModuleAdmin = XOOPS_ROOT_PATH . '/' . $module->getInfo('dirmoduleadmin') . '/moduleadmin';
if (!file_exists($fileinc = $pathModuleAdmin . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathModuleAdmin . '/language/english/main.php';
}
include_once $fileinc;

$adminmenu              = [];
$i                      = 0;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
$i++;
$adminmenu[$i]['title'] = _AM_XBSLOG_ADMENU1;
$adminmenu[$i]['link']  = 'admin/main.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

$i++;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';

/**
 * @global Xoop Configuration
 */
global $xoopsConfig;

/**
 * make sure we have the admin menu language constants loaded
 */
if (file_exists(XOOPS_ROOT_PATH . '/modules/xbs_log/language/' . $xoopsConfig['language'] . '/admin.php')) {
    include_once XOOPS_ROOT_PATH . '/modules/xbs_log/language/' . $xoopsConfig['language'] . '/admin.php';
} else {
    include_once XOOPS_ROOT_PATH . '/modules/xbs_log/language/english/admin.php';
}

/**
 * Whilst you can link your menu options to a single file, typically admin/index.php
 * and use a switch statement on a variable passed to it from here, to keep things
 * simple, use one script per menu option;
 */
