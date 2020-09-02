<?php declare(strict_types=1);

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Admin menu declaration
 *
 * This script conforms to the Xoops standard for admin/menu.php
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBSLOG
 * @subpackage    Admin
 * @version       1
 * @access        private
 */

use Xmf\Module\Admin;
use XoopsModules\Xbslog\Helper;

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
/** @var \XoopsModules\Xbslog\Helper $helper */
$helper = Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');
$helper->loadLanguage('admin');

$pathIcon32 = Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}

$adminmenu[] = [
    'title' => _MI_XBSLOG_MENU_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _AM_XBSLOG_ADMENU1,
    'link'  => 'admin/main.php',
    'icon'  => $pathIcon32 . '/manage.png',
];

$adminmenu[] = [
    'title' => _MI_XBSLOG_MENU_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png',
];


//$adminmenu[] = [
//    'title' => _AM_XBSLOG_MENU_DOCS,
//    'link' => 'admin/help.php',
//    'icon' => $pathIcon32 . '/help.png',
//];
