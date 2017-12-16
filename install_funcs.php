<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
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
// Copyright: (c) 2005, Ashley Kitson										 //
// URL:       http://xoobs.net                                      //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    XBS Logger (SBSLOG)                                         //
// ------------------------------------------------------------------------- //

/**
* Installation callback functions 
*
* Functions called during the module installation, update or delete process
*
* @author Ashley Kitson http://xoobs.net
* @copyright 2006 Ashley Kitson, UK
* @package XBSLOG
* @subpackage Installation
* @access private
* @version 1
*/

/**
 * Must have module defines
 */
require_once(XOOPS_ROOT_PATH."/modules/xbs_log/include/defines.php");

/**
* Function: Module Update callback 
*
* Called during update process to alter data table structure or values in tables	
*
* @version 1
* @param xoopsModule &$module handle to the module object being updated
* @param int $oldVersion version * 100 prior to update
* @return boolean True if successful else False 
*/
function xoops_module_update_xbs_log(&$module,$oldVersion) {
  global $xoopsDB;
  /*
  if ($oldVersion < 110) { //upgrading from version 1.00
  }
  */
  //notify xoobs.net of update
  xbsNotify('Updated');
  return true;
}//end function

/**
*
* admin make a directory
* 
* Thanks to the NewBB2 Development Team
* http://www.php.net/manual/en/function.mkdir.php
* saint at corenova.com
* bart at cdasites dot com
* 
* @param string $target directory to make
*/
function admin_mkdir($target) {
	if (is_dir($target) || empty($target)) {
		return true; // best case check first
	}
	 
	if (file_exists($target) && !is_dir($target)) {
		return false;
	}

	if (admin_mkdir(substr($target,0,strrpos($target,'/')))) {
		if (!file_exists($target)) {
			$res = mkdir($target, 0700); // crawl back up & create dir tree
			admin_chmod($target);
	  	    return $res;
	  }
	}
    $res = is_dir($target);
	return $res;
}

/**
* Thanks to the NewBB2 Development Team
* 
* @param string $target directory to set permission on
* @param octal $mode directory permission
*/
function admin_chmod($target, $mode = 0700)
{
	return @chmod($target, $mode);
}

/**
* Function: Module Install callback 
*
* @version 1
* @param xoopsModule &$module Handle to module object being installed
* @return boolean True if successful else False 
*/
function xoops_module_install_xbs_log(&$module) {
  #global $xoopsDB;
  //create the log directory
  if (!admin_mkdir(XBSLOG_LOG_PATH)) {
  	$module->setErrors('Unable to create logging directory: '.XBSLOG_LOG_PATH." Please create it yourself");
    return false;
  }
  //notify xoobs.net of install
  xbsNotify('Installed');
  return true;
}//end function

/**
* Function: Module Pre Install callback 
*
* This will only work for Xoops at version 2.2+
*
* @version 1
* @param xoopsModule &$module Handle to module object being installed
* @return boolean True if successful else False 
*/
function xoops_module_pre_install_xbs_log(&$module) {
  #global $xoopsDB;
  return true;
}//end function

 /**
 * remove and empty a directory
 * 
 * Contact information:
 *   Dao Gottwald  <dao at design-noir.de>
 *   Herltestraße 12
 *   D-01307, Germany
 *
 * @version  1.0
 */
function rmdirr ($dir) {
	if (is_dir ($dir)) {
		if (cleardir ($dir)) {
			return rmdir ($dir);
		}
		return false;
	}
	return unlink ($dir);
}

 /**
 * empty a directory
 * 
 * Contact information:
 *   Dao Gottwald  <dao at design-noir.de>
 *   Herltestraße 12
 *   D-01307, Germany
 *
 * @version  1.0
 */
function cleardir ($dir) {
	if (!($dir = dir ($dir))) {
		return false;
	}
	while (false !== $item = $dir->read()) {
		if ($item != '.' && $item != '..' && !rmdirr ($dir->path . DIRECTORY_SEPARATOR . $item)) {
			$dir->close();
			return false;
		}
	}
	$dir->close();
	return true;
}

/**
* Function: Module deletion callback 
*
* XBSLOG tables are deleted via the Xoops uninstaller
*
* @version 1
* @param xoopsModule &$module Handle to module object being installed
* @return boolean True if successful else False 
*/
function xoops_module_uninstall_xbs_log(&$module) {
  #global $xoopsDB;
  //Notify Xoobs.net of uninstall
  xbsNotify('Uninstall');
  //remove the log directory
  $cfg = getXBSLOGModConfigs();
  if (isset($cfg['def_logpath'])) {
  	$logpath = $cfg['def_logpath'];
  } else {
  	$logpath = XBSLOG_LOG_PATH;
  }
	if (rmdirr($logpath)) {
		return true;
    } else {
    	$module->setErrors('Unable to remove logging directory: '.XBSLOG_LOG_PATH);
    	return false;
    }
    
}//end function




?>