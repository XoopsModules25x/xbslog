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
 * Xoops module Installation parameters
 *
 * This file conforms to the Xoops standard for the xoops_version.php file.
 * Constant declarations beginning _MI_ are contained in language/../modinfo.php
 *
 * @copyright     Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBSLOG
 * @version       1
 * @subpackage    Installation
 * @access        private
 * @global array Module Installation array as per Xoops
 */
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

global $modversion;

/**
 * Logger definitions
 */
require_once XOOPS_ROOT_PATH . '/modules/xbslog/include/defines.php';
$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$modversion['version']       = 2.01;
$modversion['module_status'] = 'Beta 1';
$modversion['release_date']  = '2020/08/30';
$modversion['name']          = _MI_XBSLOG_NAME;
$modversion['description']   = _MI_XBSLOG_DESC;
$modversion['credits']       = 'Ashley Kitson<br>( http://xoobs.net/ )';
$modversion['author']        = 'Ashley Kitson';
//$modversion['help']                = 'xbsloghelp.html';
$modversion['license']             = 'GNU GPL 2.0 or later';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']            = 0;
$modversion['dirname']             = $moduleDirName;
$modversion['modicons16']          = 'assets/images/icons/16';
$modversion['modicons32']          = 'assets/images/icons/32';
$modversion['image']               = 'assets/images/logoModule.png';
$modversion['module_website_url']  = 'https://xoops.org';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '7.1';
$modversion['min_xoops']           = '2.5.10';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = ['mysql' => '5.5'];
$modversion['system_menu']         = 1;
$modversion['adminindex']          = 'admin/index.php';
$modversion['adminmenu']           = 'admin/menu.php';

// ------------------- Help files ------------------- //
$modversion['help']        = 'page=help';
$modversion['helpsection'] = [
    ['name' => _MI_XBSLOG_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_XBSLOG_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_XBSLOG_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_XBSLOG_SUPPORT, 'link' => 'page=support'],
];

#$modversion['onUpdate'] = "install_funcs.php";
$modversion['onInstall']   = 'install_funcs.php';
$modversion['onUninstall'] = 'install_funcs.php';

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/xbslog_mysql.sql';
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = XBSLOG_TBL_LOG;

// Main Menu
$modversion['hasMain'] = 0;

// Templates
// Admin things
// Admin menu things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

$modversion['hasSearch']       = 0;
$modversion['hasComments']     = 0;
$modversion['hasNotification'] = 0;

//config things
$modversion['config'][1]['name']        = 'def_logpath';
$modversion['config'][1]['title']       = '_MI_XBSLOG_PATHNAME';
$modversion['config'][1]['description'] = '_MI_XBSLOG_PATHDESC';
$modversion['config'][1]['formtype']    = 'text';
$modversion['config'][1]['valuetype']   = 'text';
$modversion['config'][1]['default']     = XBSLOG_LOG_PATH;

$modversion['config'][2]['name']        = 'def_logfile';
$modversion['config'][2]['title']       = '_MI_XBSLOG_FILENAME';
$modversion['config'][2]['description'] = '_MI_XBSLOG_FILEDESC';
$modversion['config'][2]['formtype']    = 'text';
$modversion['config'][2]['valuetype']   = 'text';
$modversion['config'][2]['default']     = XBSLOG_LOG_FILE;

$modversion['config'][3]['name']        = 'def_datefmt';
$modversion['config'][3]['title']       = '_MI_XBSLOG_DATENAME';
$modversion['config'][3]['description'] = '_MI_XBSLOG_DATEDESC';
$modversion['config'][3]['formtype']    = 'text';
$modversion['config'][3]['valuetype']   = 'text';
$modversion['config'][3]['default']     = XBSLOG_DATEFMT;
