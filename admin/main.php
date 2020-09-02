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
 * Admin index page
 *
 * Display log
 *
 * @copyright     Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBSLOG
 * @subpackage    Admin
 * @version       1
 * @access        private
 */

/**
 * Do all the declarations etc needed by an admin page
 */
require_once __DIR__ . '/admin_header.php';
require_once __DIR__ . '/adminheader.php';

//Display the admin menu
//xoops_module_admin_menu(1, _AM_XBSLOG_ADMENU1);

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
if (isset($_GET)) {
    extract($_GET);
}
if (isset($start)) { //review the log starting at
    adminViewLog($start);
} elseif (isset($delete)) { //clear the log
    adminClearLog();
} elseif (isset($_POST['doDel'])) {
    adminClearLog(true);
} else { //review log from beginning
    adminViewLog(0);
} //end if

/**
 * and here.
 */

//And put footer in
xoops_cp_footer();
