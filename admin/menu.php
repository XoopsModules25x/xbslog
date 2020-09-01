<?php declare(strict_types=1);

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

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
/** @var \XoopsModules\Xbslog\Helper $helper */
$helper = \XoopsModules\Xbslog\Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');
$helper->loadLanguage('admin');

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}



$adminmenu[] = [
    'title' => _MI_XBSLOG_MENU_HOME,
    'link' => 'admin/index.php',
    'icon' => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _AM_XBSLOG_ADMENU1,
    'link' => 'admin/main.php',
    'icon' => $pathIcon32 . '/manage.png',
];


$adminmenu[] = [
    'title' => _MI_XBSLOG_MENU_ABOUT,
    'link' => 'admin/about.php',
    'icon' => $pathIcon32 . '/about.png',
];


//$adminmenu[] = [
//    'title' => _AM_XBSLOG_MENU_DOCS,
//    'link' => 'admin/help.php',
//    'icon' => $pathIcon32 . '/help.png',
//];
