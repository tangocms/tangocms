<?php
// $Id: install.php 2768 2009-11-13 18:12:34Z alexc $

/**
 * Zula Framework installation specific
 * Does specific tasks that may be needed, such as adding new config values that previous
 * versions of Zula may not have had (If you are upgrading, for example).
 *
 * @patches submit all patches to patches@tangocms.org
 *
 * @author Alex Cartwright
 * @copyright Copyright (C) 2007, 2008, 2009 Alex Cartwright
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html GNU/LGPL 2.1
 * @package Zula_Install
 */

 	Registry::get( 'cache' )->purge();
 	Registry::unregister( 'cache' );
	Cache::factory( 'disabled' );

	$config->update( 'config/title', _PROJECT_NAME.' '._PROJECT_LATEST_VERSION.' Installation/Upgrade' );
	$config->update( 'acl/enable', 0 );

?>
