<?php declare(strict_types=1);

namespace XoopsModules\Xbslog;

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2006, Ashley Kitson
// URL:       http://xoobs.net                                      //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)                                      //
// ------------------------------------------------------------------------- //
/**
 * Base class used by XBS Logger System
 *
 * @package       XBSLOG
 * @subpackage    Logger
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2006 Ashley Kitson, Great Britain
 */

/**
 * Load module definitions
 */
require_once XOOPS_ROOT_PATH . '/modules/xbslog/include/defines.php';

/**
 * Writes and reads log entries for any application
 *
 * To use this class do the following:<br><br>
 *  include_once(XOOPS_ROOT_PATH."/modules/xbslog/include/defines.php");<br>
 *  $myLogger = \XoopsModules\Xbslog\Helper::getInstance()->getHandler('Logger');<br>
 *  $myLogger->setLogName("<name of logger>"); //NB limited to 10 characters<br>
 *  $stage = "start"; //NB stage tag limited to 10 characters<br>
 *  $processMsg = "Some message" //NB message limited to 255 characters<br>
 *  $myLogger->log($stage,$processMsg);<br>
 *
 * @package       XBSLOG
 * @subpackage    Logger
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2006 Ashley Kitson, Great Britain
 */
class LoggerHandler extends \XoopsObjectHandler
{
    /**#@+
     * Private variables
     *
     * @access private
     */

    public $_logName = 'XBS';  //log name
    public $_logPath = XBSLOG_LOG_PATH;
    public $_logFile = XBSLOG_LOG_FILE;
    public $_dateFmt = XBSLOG_DATEFMT;
    /**#@-*/

    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $cfg = getXBSLOGModConfigs();

        if (isset($cfg['def_logpath'])) {
            $this->_logPath = $cfg['def_logpath'];
        }

        if (isset($cfg['def_logfile'])) {
            $this->_logFile = $cfg['def_logfile'];
        }

        if (isset($cfg['def_datefmt'])) {
            $this->_dateFmt = $cfg['def_datefmt'];
        }

        parent::__construct($db);
    }

    /**
     * Set the logger name
     *
     * @param string $logName arbitrary name for this logger
     */
    public function setLogName($logName = 'XBS')
    {
        $this->_logName = $logName;
    }

    /**
     * convert microtime string to formatted date-time-microtime
     *
     * @param string $mTimeStr microtime string "msec sec"
     * @return string date format string suffixed with .microseconds
     */
    public function mtimeToDate($mTimeStr)
    {
        $t = explode(' ', $mTimeStr);

        $t[0] = ltrim($t[0], '0.');

        return date($this->_dateFmt, (int)$t[1]) . ".$t[0]";
    }

    /**
     * convert a double (float) microtime to date-time-microtime  string
     *
     * @param float $mTime float in standard microtime(true) format
     * @return string date format string suffixed with .microseconds
     */
    public function floatMtimeToDate($mTime)
    {
        $m = (string)$mTime;

        $s = explode('.', $m);

        return $this->mtimeToDate("$s[1] $s[0]");
    }

    /**
     * convert microtime string value to real
     *
     * This is only required because php4 does not support microtime(true)
     * which isn't available until php5
     *
     * @param string $mTimeStr microtime string in 'msec sec' format
     * @return float (double) microtime as float (ie as per microtime(true))
     */
    public function mtimeToFloat($mTimeStr)
    {
        $m = (string)$mTimeStr;

        $t = explode(' ', $m);

        $t[0] = ltrim($t[0], '0.');

        return (float)"$t[1].$t[0]";
    }

    /**
     * return the full log file path and name
     *
     * @return string log file path and name
     */
    public function getFname()
    {
        return "$this->_logPath/$this->_logFile";
    }

    /**
     * Write an entry to the disk log
     *
     * @param string $stage      arbitrary string that denotes stage of process but typically 'start', 'end' etc
     * @param string $processMsg arbitrary message to put in log
     */
    public function log($stage, $processMsg)
    {
        $stage = mb_strtoupper($stage);

        $logstr = "$this->_logName|$stage|" . $this->mtimeToFloat(microtime()) . "|$processMsg\n";

        if ($fhandle = fopen($this->getFname(), 'ab')) {
            if (flock($fhandle, LOCK_EX)) {
                fwrite($fhandle, $logstr);

                flock($fhandle, LOCK_UN);
            }

            fclose($fhandle);
        }
    }

    //end function

    /**
     * Reads disk log into database table and clears disk log
     */
    public function readLogToDB()
    {
        //open file for reading

        if ($fhandle = fopen($this->getFname(), 'r+b')) {
            //and lock it

            if (flock($fhandle, LOCK_EX)) {
                $sqlStr = 'INSERT INTO ' . $this->db->prefix(XBSLOG_TBL_LOG) . ' (logname,stage,logtime,msg) VALUES (%s,%s,%F,%s)';

                while (!feof($fhandle)) { //read each line and store to database
                    $buffer = fgets($fhandle, 1024);

                    if ('' != $buffer) {
                        $row = explode('|', $buffer);

                        $sql = sprintf($sqlStr, $this->db->quoteString($row[0]), $this->db->quoteString($row[1]), $row[2], $this->db->quoteString($row[3]));

                        $result = $this->db->queryF($sql);
                    }
                }//end while

                //reset file length to 0

                ftruncate($fhandle, 0);

                fseek($fhandle, 0);

                //unlock file

                flock($fhandle, LOCK_UN);
            }//end if flock

            fclose($fhandle);
        }//end if fopen
    }

    //end function

    /**
     * get an array of log entries
     *
     * @param int $start start record number
     * @param int $limit number of rows to return
     * @return array an array of row arrays
     */
    public function getLogEntries($start, $limit)
    {
        $rows = [];

        $thisrow = [];

        $sql = 'select * from ' . $this->db->prefix(XBSLOG_TBL_LOG) . " order by logtime DESC LIMIT $start,$limit";

        $result = $this->db->query($sql);

        if ($result) {
            while (false !== ($row = $this->db->fetchArray($result))) {
                $row['logtime'] = $this->floatMtimeToDate($row['logtime']);

                foreach ($row as $key => $value) {
                    $thisrow[] = $value;
                }

                $rows[] = $thisrow;

                unset($thisrow);
            }
        }

        return $rows;
    }

    //end function

    /**
     * Get the number of log entries
     *
     * @return int
     */
    public function getRowsNum()
    {
        $sql = 'SELECT count(*) AS count FROM ' . $this->db->prefix(XBSLOG_TBL_LOG);

        $result = $this->db->query($sql);

        if ($result) {
            $row = $this->db->fetchArray($result);

            return (int)$row['count'];
        }

        return 0;
    }
    //end function
}//end class
