<?php declare(strict_types=1);

// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2005, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)                                            //
// ------------------------------------------------------------------------- //
/**
 * Constant definitions that are programming specific rather than
 * module or language specific
 *
 * @package       XBSLOG
 * @subpackage    Definitions
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2006 Ashley Kitson, Great Britain
 */

/**
 * The XBSLOG module directory name
 *
 * cannot use dirname as it doesn't nest (i.e not correct if XBSLOG being used from within another module)
 * <code>
 * define('XBSLOG_DIR', $xoopsModule->dirname());
 * </code>
 */
define('XBSLOG_DIR', 'xbslog');

/**#@+
 * Constants for xbslog objects
 */

/**
 * Full file path to XBSLOG directory
 */
define('XBSLOG_PATH', XOOPS_ROOT_PATH . '/modules/' . XBSLOG_DIR);
/**
 * URL to XBSLOG
 */
define('XBSLOG_URL', XOOPS_URL . '/modules/' . XBSLOG_DIR);

/**
 * path to log file
 */
define('XBSLOG_LOG_PATH', XOOPS_ROOT_PATH . '/log');
/**
 * log filename
 */
define('XBSLOG_LOG_FILE', 'xbs_logger.log');
/**
 * Log table
 */
define('XBSLOG_TBL_LOG', 'xbslog_log');
/**
 * date format string for outputting date info on screen
 */
define('XBSLOG_DATEFMT', 'D M j G:i:s');
/**#@-*/

require_once XBSLOG_PATH . '/include/xbsnotice.php';

/**
 * Function: Get the current module's configuration options
 *
 * Because XBSLOG can be nested inside other modules the $xoopsModuleConfig
 * variable will be pointing to whatever module is currently in scope
 * We therefore need to retrieve the XBSLOG options
 *
 * @return array Module config options
 * @internal
 * @version 1
 */
function getXBSLOGModConfigs()
{
    static $XBSLOGModuleConfig;

    if (isset($XBSLOGModuleConfig)) {
        return $XBSLOGModuleConfig;
    }

    $moduleHandler = xoops_getHandler('module');

    if ($Module = $moduleHandler->getByDirname(XBSLOG_DIR)) {
        $configHandler = xoops_getHandler('config');

        $XBSLOGModuleConfig = $configHandler->getConfigsByCat(0, $Module->getVar('mid'));
    }

    return $XBSLOGModuleConfig;
}
