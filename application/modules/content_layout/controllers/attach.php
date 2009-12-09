<?php
// $Id: attach.php 2798 2009-11-24 12:15:41Z alexc $

/**
 * Zula Framework Module (content_layout)
 * --- Shows all of the template sectors and which modules are current
 * attached to it
 *
 * @patches submit all patches to patches@tangocms.org
 *
 * @author Alex Cartwright
 * @copyright Copyright (C) 2007, 2008, 2009 Alex Cartwright
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL 2
 * @package TangoCMS_Content_layout
 */

	class Content_layout_controller_attach extends Zula_ControllerBase {

		/**
		 * Constructor
		 *
		 * @return object
		 */
		public function __construct( $moduleDetails, $config, $sector ) {
			parent::__construct( $moduleDetails, $config, $sector );
			$this->setPageLinks( array(
										t('Manage Layouts')	=> $this->_router->makeUrl( 'content_layout' ),
										t('Add Layout')		=> $this->_router->makeUrl( 'content_layout', 'index', 'add' ),
										));
		}

		/**
		 * Displays form for attaching a module to the provied
		 * layout name.
		 *
		 * @param string $name
		 * @param array $args
		 * @return mixed
		 */
		public function __call( $name, $args ) {			
			$this->_locale->textDomain( $this->textDomain() );
			$this->setTitle( t('Attach New Module') );
			$this->setOutputType( self::_OT_CONFIG );
			if ( !$this->_acl->check( 'content_layout_attach_module' ) ) {
				throw new Module_NoPermission;
			}
			/**
			 * Create the layout to get needed sectors, then build
			 * the view form for validation.
			 */
			$layoutName = substr( $name, 0, -7 );
			$siteType = substr( $layoutName, 0, strpos($layoutName, '-') );
			$layout = new Theme_layout( $layoutName, Theme::getSiteTypeTheme( $siteType ) );
			$form = new View_form( 'attach/attach.html', 'content_layout' );
			$form->action( $this->_router->makeUrl( 'content_layout', 'attach', $layoutName ) );
			$form->addElement( 'content_layout/module', null, t('Module'), new Validator_InArray( Module::getModules() ) );
			$form->addElement( 'content_layout/sector', null, t('Sector'), new Validator_InArray( array_keys($layout->getSectors()) ) );
			if ( $form->hasInput() && $form->isValid() ) {
				$fd = $form->getValues( 'content_layout' );
				// Attach the new module to the correct sector
				try {
					$cntrlrId = $layout->addController( $fd['sector'], array('mod' => $fd['module']) );
					if ( $layout->save() ) {
						$this->_event->success( t('Successfully added module') );
						return zula_redirect( $this->_router->makeUrl( 'content_layout', 'edit', $layoutName, null, array('id' => $cntrlrId) ) );
					} else {
						$this->_event->error( t('Unable to save content layout file') );
					}
				} catch ( Theme_SectorNoExist $e ) {
					$this->_event->error( sprintf( t('Unable to attach module. Sector "%s" does not exist'), $fd['sector'] ) );
				}
			}
			// Assign additional data
			$form->assign( array(
								'SECTORS'	=> $layout->getSectors(),
								'LAYOUT'	=> $layoutName,
								));
			return $form->getOutput();
		}

	}

?>
