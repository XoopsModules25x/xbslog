<?php declare(strict_types=1);

/**
 * Constant definitions that are module specific.
 *
 * Definitions in this file conform to the Xoops standard for the modinfo.php file
 *
 * @package       XBSLOG
 * @subpackage    Definitions
 * @version       1
 * @access        private
 * @copyright     Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 */

/**
 * The name of this module
 */
define('_MI_XBSLOG_NAME', 'XBS Logger');

/**
 *  A brief description of this module
 */
define('_MI_XBSLOG_DESC', 'Provides logging for Xoops');

/**#@+
 * Configuration item names and descriptions
 */
define('_MI_XBSLOG_PATHNAME', 'Log file path');
define('_MI_XBSLOG_PATHDESC', 'Path to disk log file.  If you change this from default you will need to create it first');
define('_MI_XBSLOG_FILENAME', 'Log file name');
define('_MI_XBSLOG_FILEDESC', 'Name of disk log file');
define('_MI_XBSLOG_DATENAME', 'Date format string');
define('_MI_XBSLOG_DATEDESC', 'Date formatting string used for log output to screen');

/**#@-*/

/**#@+
 * Block naming and descriptions
 */
/**#@-*/

//Menu
define('_MI_XBSLOG_MENU_HOME', 'Home');
define('_MI_XBSLOG_MENU_01', 'Admin');
define('_MI_XBSLOG_MENU_ABOUT', 'About');
define('_AM_XBSLOG_MENU_DOCS', 'Docu');

//Help
define('_MI_XBSLOG_DIRNAME', basename(dirname(__DIR__, 2)));
define('_MI_XBSLOG_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_XBSLOG_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_XBSLOG_OVERVIEW', 'Overview');

//define('_MI_XBSLOG_HELP_DIR', __DIR__);

//help multi-page
define('_MI_XBSLOG_DISCLAIMER', 'Disclaimer');
define('_MI_XBSLOG_LICENSE', 'License');
define('_MI_XBSLOG_SUPPORT', 'Support');
