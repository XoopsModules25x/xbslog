<?php declare(strict_types=1);

//%%%%%%        Module Name 'XBSLOG'        %%%%%
/**
 * Module administration language constant definitions
 *
 * This is the language specific file for UK English language
 *
 * @author     Ashley Kitson http://xoobs.net
 * @copyright  2006 Ashley Kitson, UK
 * @package    XBSLOG
 * @subpackage Definitions
 * @version    1
 * @access     private
 */

/**#@+
 * Constants for Admin menu - non language specific
 */

/**
 * Admin menu parameters
 *
 * These MUST follow the format _AM_<ModDir>_URL_DOCS etc
 * so that the xoops_module_admin_header functions can work.
 * The suffix after <modDir> is not optional!
 * Leave them commented out if you do not have the functionality for your module
 *
 * Relative url from module directory for documentation
 */
define('_AM_XBS_LOG_URL_DOCS', 'admin/help.php');
/**
 * Absolute url for module support site
 */
define('_AM_XBS_LOG_URL_SUPPORT', 'http://www.xoobs.net');
/**
 * absolute url for module donations site
 */
//define("_AM_XBS_LOG_URL_DONATIONS","");

/**
 * Module configuration option - MUST follow the format _AM_<ModDir>_MODCONFIG
 * Value MUST be "xoops", "module" or "none"
 */
define('_AM_XBS_LOG_MODCONFIG', 'xoops');

/**
 * If module configuration option = "module" then define the name of the script
 * to call for module configuration.  This relative to modDir/admin/
 * MUST follow the format _AM_<ModDir>_MODCONFIGURL
 * e.g. define("_AM_XBS_LOG_MODCONFIGURL","XBSLOGConfig.php");
 * and define a message that is shown to users prior to redirecting to the config page
 * e.g. define("_AM_XBS_LOG_MODCONFIGREDIRECT","Configuration is done via the CDM system. You will shortly be redirected there.")
 */
/**#@-*/

/**#@+
 * Admin menu titles
 */
define('_AM_XBSLOG_ADMENU1', 'Log');
/**#@-*/

/**#@+
 * Constants for Admin functionality - Language specific
 */

//Form strings
define('_AM_XBSLOG_LOGDELETED', 'XBS Log Deleted');
define('_AM_XBSLOG_DBERROR', 'Database Error %u : %s. Sql = %s');
define('_AM_XBSLOG_ACTIONCOL', 'Action');
define('_AM_XBSLOG_ACTIONCONFIRM', 'Confirm Action');
define('_AM_XBSLOG_NOLOGS', 'There are no log entries to display');

define('_AM_XBSLOGFRM1_TITLE', 'Event Log');
define('_AM_XBSLOGFRM1_COL1', 'Log Name');
define('_AM_XBSLOGFRM1_COL2', 'Stage');
define('_AM_XBSLOGFRM1_COL3', 'Time');
define('_AM_XBSLOGFRM1_COL4', 'Message');
define('_AM_XBSLOGFRM1_PREV', 'Previous 50 records');
define('_AM_XBSLOGFRM1_NEXT', 'Next 50 Records');
define('_AM_XBSLOGFRM1_DEL', 'Delete Log');
define('_AM_XBSLOGFRM1_CONFIRMDEL', 'Are you sure that you want to delete the log');

//buttons
define('_AM_XBSLOG_INSERT', 'Insert');
define('_AM_XBSLOG_BROWSE', 'Browse');
define('_AM_XBSLOG_SUBMIT', 'Submit');
define('_AM_XBSLOG_CANCEL', 'Cancel');
define('_AM_XBSLOG_RESET', 'Reset');
define('_AM_XBSLOG_EDIT', 'Edit');
define('_AM_XBSLOG_DEL', 'Delete');
define('_AM_XBSLOG_GO', 'Go');

//button labels
define('_AM_XBSLOG_INSERT_DESC', 'Create a new record');

/**#@-*/
