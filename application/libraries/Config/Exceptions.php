<?php
// $Id: Exceptions.php 2810 2009-11-29 11:42:29Z alexc $

/**
 * Zula Config exceptions
 *
 * @patches submit all patches to patches@tangocms.org
 *
 * @author Alex Cartwright
 * @copyright Copyright (C) 2007, 2008, 2009 Alex Cartwright
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html GNU/LGPL 2.1
 * @package Zula_Config
 */

	class Config_InvalidObject extends exception {}
	class Config_InvalidValue extends exception {}

	class Config_KeyNoExist extends exception {}

?>
