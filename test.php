<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org/>                             //
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
// Copyright: (c) 2005, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    XBS Logger (XBSLOG)                                     //
// ------------------------------------------------------------------------- //

/**
 * Put some test entries into the log
 *
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2006, Ashley Kitson
 * @package       XBSLOG
 * @subpackage    Test_Script
 */

/**
 * MUST include module page header
 *
 * It includes mainfile, module definitions and xoops header
 */
require __DIR__ . '/header.php';

$myLogger = xoops_getModuleHandler('Logger', XBSLOG_DIR);
$myLogger->setLogName('mylog');             //NB limited to 10 characters
$stage = 'test';                            //NB stage tag limited to 10 characters
for ($i = 0; $i < 75; $i++) {                     //shove some entries into log
    $processMsg = 'Test message : Iteration ' . (string)$i;       //NB message limited to 255 characters
    $myLogger->log($stage, $processMsg);
}//end for

echo "<div align='center'><p><b>Now check the logger admin screen to see the entries</b><p>Thank you for using <a href='http://xoobs.net'>XBS software</a></div><br>";

/**
 * Do page footer
 */
include XOOPS_ROOT_PATH . '/footer.php';      //display the page!
