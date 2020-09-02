<?php declare(strict_types=1);

use XoopsModules\Xbslog;
use XoopsModules\Xbslog\Helper;

/**
 * Admin page functions
 *
 * @param mixed $start
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBSLOG
 * @subpackage    Admin
 * @access        private
 * @version       1
 * @copyright     Ashley Kitson
 */

/**
 * Function: Display log 50 rows at a time
 *
 * @param int $start start record to display
 * @version 1
 */
function adminViewLog($start = 0)
{
    //initiate the log handler

    $logHandler = Helper::getInstance()->getHandler('Logger');

    //transfer any disk file entries to database

    $logHandler->readLogToDB();

    //initiate the form

    $cols = [_AM_XBSLOGFRM1_COL1, _AM_XBSLOGFRM1_COL2, _AM_XBSLOGFRM1_COL3, _AM_XBSLOGFRM1_COL4];

    $table = new Xbslog\Form\LogTableForm($cols, _AM_XBSLOGFRM1_TITLE);

    $numRows = $logHandler->getRowsNum();

    if ($numRows > 0) {
        //get data to display

        $rows = $logHandler->getLogEntries($start, 50);

        $table->addRows($rows);

        //construct header and tail lines

        $line = "<div align='center'>";

        if (0 != $start) {
            $line .= "<a href='index.php?start=" . ($start - 50) . "'>" . _AM_XBSLOGFRM1_PREV . '</a>';
        }

        $isMore = ($numRows > $start);

        if ($isMore) {
            $line .= " - <a href='index.php?start=" . ($start + 50) . "'>" . _AM_XBSLOGFRM1_NEXT . '</a>';
        }

        if (count($rows) > 0) {
            $line .= " - <a href='index.php?delete=1'>" . _AM_XBSLOGFRM1_DEL . '</a>';
        }

        $line .= '</div><br>';

        //and output

        echo $line;

        $table->display();

        echo $line;
    } else {
        echo "<div align='center'><b>" . _AM_XBSLOG_NOLOGS . '</b></div><br>';
    }
}//end function

/**
 * Function: clear the log
 *
 * @param bool $doIt
 * @version 1
 */
function adminClearLog($doIt = false)
{
    global $xoopsDB;

    if ($doIt) {
        //use truncate to reset any auto incrementing counters

        $sql = 'truncate table ' . $xoopsDB->prefix(XBSLOG_TBL_LOG);

        if ($result = $xoopsDB->queryF($sql)) {
            redirect_header(XBSLOG_URL . '/admin/index.php', 1, _AM_XBSLOG_LOGDELETED);
        } else {
            redirect_header(XBSLOG_URL . '/admin/index.php', 10, sprintf(_AM_XBSLOG_DBERROR, $xoopsDB->errno(), $xoopsDB->error(), $sql));
        }
    } else {
        //confirm user intention

        //regular submit/cancel buttons tray

        $ftray = new \XoopsFormElementTray('');

        $submit = new \XoopsFormButton('', 'doDel', _AM_XBSLOG_DEL, 'submit');

        $cancel = new \XoopsFormButton('', 'cancel', _AM_XBSLOG_CANCEL, 'submit');

        $ftray->addElement($submit);

        $ftray->addElement($cancel);

        $fmessage = new \XoopsFormLabel('', _AM_XBSLOGFRM1_CONFIRMDEL);

        $confirmForm = new \XoopsThemeForm(_AM_XBSLOG_ACTIONCONFIRM, 'confirmform', 'index.php');

        $confirmForm->addElement($fmessage);

        $confirmForm->addElement($ftray);

        $confirmForm->display();
    }
} //end function adminClearLog
