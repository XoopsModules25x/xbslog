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
 * Put some test entries into the log
 *
 * @copyright     Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBSLOG
 * @subpackage    Test_Script
 */

/**
 * MUST include module page header
 *
 * It includes mainfile, module definitions and xoops header
 */

use XoopsModules\Xbslog\Helper;

require __DIR__ . '/header.php';

$myLogger = Helper::getInstance()->getHandler('Logger');
$myLogger->setLogName('mylog');             //NB limited to 10 characters
$stage = 'test';                            //NB stage tag limited to 10 characters
for ($i = 0; $i < 75; $i++) {                     //shove some entries into log
    $processMsg = 'Test message : Iteration ' . $i;       //NB message limited to 255 characters
    $myLogger->log($stage, $processMsg);
}//end for

echo "<div align='center'><p><b>Now check the logger admin screen to see the entries</b><p>Thank you for using <a href='http://xoobs.net'>XBS software</a></div><br>";

/**
 * Do page footer
 */
require XOOPS_ROOT_PATH . '/footer.php';      //display the page!
