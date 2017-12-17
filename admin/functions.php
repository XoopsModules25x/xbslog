<?php
/**
 * Admin page functions
 *
 * @author     Ashley Kitson http://xoobs.net
 * @copyright  2006 Ashley Kitson, UK
 * @package    XBSLOG
 * @subpackage Admin
 * @access     private
 * @version    1
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
    $logHandler = xoops_getModuleHandler('Logger', XBSLOG_DIR);
    //transfer any disk file entries to database
    $logHandler->readLogToDB();
    //initiate the form
    $cols    = [_AM_XBSLOGFRM1_COL1, _AM_XBSLOGFRM1_COL2, _AM_XBSLOGFRM1_COL3, _AM_XBSLOGFRM1_COL4];
    $table   = new logTableForm($cols, _AM_XBSLOGFRM1_TITLE);
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
 * @version 1
 * @param bool $doIt
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
        $ftray  = new XoopsFormElementTray('');
        $submit = new XoopsFormButton('', 'doDel', _AM_XBSLOG_DEL, 'submit');
        $cancel = new XoopsFormButton('', 'cancel', _AM_XBSLOG_CANCEL, 'submit');
        $ftray->addElement($submit);
        $ftray->addElement($cancel);

        $fmessage    = new XoopsFormLabel('', _AM_XBSLOGFRM1_CONFIRMDEL);
        $confirmForm = new XoopsThemeForm(_AM_XBSLOG_ACTIONCONFIRM, 'confirmform', 'index.php');
        $confirmForm->addElement($fmessage);
        $confirmForm->addElement($ftray);
        $confirmForm->display();
    }
} //end function adminClearLog
